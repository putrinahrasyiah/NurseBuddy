<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\DrugVote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ObatpediaController extends Controller
{
    /**
     * Display the Obatpedia list with search.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
        ]);

        $search = trim((string) ($filters['search'] ?? ''));

        $drugs = Drug::query()
            ->with([
                'aliases',
                'votes' => fn ($query) => $query->whereBelongsTo($user),
            ])
            ->withCount([
                'votes as upvotes_count' => fn ($query) => $query->where('vote', DrugVote::VOTE_UP),
                'votes as downvotes_count' => fn ($query) => $query->where('vote', DrugVote::VOTE_DOWN),
            ])
            ->when(
                $search !== '',
                fn ($query) => $query->where(function ($searchQuery) use ($search) {
                    $searchQuery
                        ->where('name', 'like', '%'.$search.'%')
                        ->orWhere('generic_name', 'like', '%'.$search.'%')
                        ->orWhere('description', 'like', '%'.$search.'%')
                        ->orWhereHas('aliases', fn ($aliasQuery) => $aliasQuery->where('alias', 'like', '%'.$search.'%'));
                })
            )
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        $drugs->getCollection()->transform(function (Drug $drug) {
            $drug->setAttribute('user_vote', $drug->votes->first()?->vote);

            return $drug;
        });

        return view('obatpedia.index', [
            'drugs' => $drugs,
            'search' => $search,
        ]);
    }

    /**
     * Display details for a specific drug.
     */
    public function show(Request $request, Drug $drug): View
    {
        $drug->load([
            'aliases',
            'votes' => fn ($query) => $query->whereBelongsTo($request->user()),
        ])->loadCount([
            'votes as upvotes_count' => fn ($query) => $query->where('vote', DrugVote::VOTE_UP),
            'votes as downvotes_count' => fn ($query) => $query->where('vote', DrugVote::VOTE_DOWN),
        ]);

        $userVote = $drug->votes->first()?->vote;

        return view('obatpedia.show', [
            'drug' => $drug,
            'userVote' => $userVote,
        ]);
    }

    /**
     * Upvote or downvote a drug.
     */
    public function vote(Request $request, Drug $drug): RedirectResponse
    {
        $validated = $request->validate([
            'vote' => ['required', Rule::in(['up', 'down'])],
        ]);

        $voteValue = $validated['vote'] === 'up' ? DrugVote::VOTE_UP : DrugVote::VOTE_DOWN;

        $currentVote = DrugVote::query()->whereBelongsTo($request->user())->whereBelongsTo($drug)->first();

        if ($currentVote && $currentVote->vote === $voteValue) {
            $currentVote->delete();
        } else {
            DrugVote::query()->updateOrCreate(
                [
                    'user_id' => $request->user()->id,
                    'drug_id' => $drug->id,
                ],
                [
                    'vote' => $voteValue,
                ]
            );
        }

        return Redirect::back()->with('status', 'drug-vote-updated');
    }
}
