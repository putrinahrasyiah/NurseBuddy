<?php

namespace App\Http\Controllers;

use App\Models\StudyCategory;
use App\Models\StudyMaterial;
use App\Models\StudyMaterialProgress;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StudyLibraryController extends Controller
{
    /**
     * Display the study library with filters.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        $filters = $request->validate([
            'category' => ['nullable', 'integer', 'exists:study_categories,id'],
            'resource_type' => ['nullable', Rule::in(StudyMaterial::RESOURCE_TYPES)],
            'status' => ['nullable', Rule::in(StudyMaterialProgress::STATUSES)],
            'search' => ['nullable', 'string', 'max:255'],
        ]);

        $materials = StudyMaterial::query()
            ->with(['category', 'progresses' => fn ($query) => $query->whereBelongsTo($user)])
            ->when(
                filled($filters['category'] ?? null),
                fn ($query) => $query->where('category_id', $filters['category'])
            )
            ->when(
                filled($filters['resource_type'] ?? null),
                fn ($query) => $query->where('resource_type', $filters['resource_type'])
            )
            ->when(
                filled($filters['search'] ?? null),
                fn ($query) => $query
                    ->where(function ($searchQuery) use ($filters) {
                        $searchQuery
                            ->where('title', 'like', '%'.$filters['search'].'%')
                            ->orWhere('description', 'like', '%'.$filters['search'].'%');
                    })
            )
            ->when(
                ($filters['status'] ?? null) === 'done',
                fn ($query) => $query->whereHas('progresses', function ($progressQuery) use ($user) {
                    $progressQuery
                        ->whereBelongsTo($user)
                        ->where('status', 'done');
                })
            )
            ->when(
                ($filters['status'] ?? null) === 'pending',
                fn ($query) => $query->where(function ($statusQuery) use ($user) {
                    $statusQuery
                        ->whereDoesntHave('progresses', fn ($progressQuery) => $progressQuery->whereBelongsTo($user))
                        ->orWhereHas('progresses', function ($progressQuery) use ($user) {
                            $progressQuery
                                ->whereBelongsTo($user)
                                ->where('status', 'pending');
                        });
                })
            )
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $materials->getCollection()->transform(function (StudyMaterial $material) {
            $material->setAttribute('user_status', $material->progresses->first()?->status ?? 'pending');

            return $material;
        });

        return view('study-library.index', [
            'materials' => $materials,
            'categories' => StudyCategory::query()->orderBy('name')->get(),
            'resourceTypes' => StudyMaterial::RESOURCE_TYPES,
            'statuses' => StudyMaterialProgress::STATUSES,
            'selectedCategory' => $filters['category'] ?? null,
            'selectedResourceType' => $filters['resource_type'] ?? null,
            'selectedStatus' => $filters['status'] ?? null,
            'search' => $filters['search'] ?? null,
        ]);
    }

    /**
     * Display a specific learning material.
     */
    public function show(Request $request, StudyMaterial $studyMaterial): View
    {
        $studyMaterial->load(['category', 'progresses' => fn ($query) => $query->whereBelongsTo($request->user())]);

        $status = $studyMaterial->progresses->first()?->status ?? 'pending';

        return view('study-library.show', [
            'material' => $studyMaterial,
            'status' => $status,
            'statuses' => StudyMaterialProgress::STATUSES,
        ]);
    }

    /**
     * Shortcut endpoint for filtering by category.
     */
    public function byCategory(Request $request, StudyCategory $studyCategory): View
    {
        $request->merge(['category' => $studyCategory->id]);

        return $this->index($request);
    }

    /**
     * Update the current user's learning status for a material.
     */
    public function updateStatus(Request $request, StudyMaterial $studyMaterial): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(StudyMaterialProgress::STATUSES)],
        ]);

        StudyMaterialProgress::query()->updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'study_material_id' => $studyMaterial->id,
            ],
            [
                'status' => $validated['status'],
            ]
        );

        return Redirect::back()->with('status', 'study-material-status-updated');
    }
}
