<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class NoteController extends Controller
{
    /**
     * Display a listing of the user's notes.
     */
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:255'],
            'pinned' => ['nullable', 'in:0,1'],
        ]);

        $notes = Note::query()
            ->whereBelongsTo($request->user())
            ->when(
                filled($filters['q'] ?? null),
                function ($query) use ($filters) {
                    $search = trim((string) $filters['q']);

                    $query->where(function ($query) use ($search) {
                        $query->where('title', 'like', "%{$search}%")
                            ->orWhere('content', 'like', "%{$search}%")
                            ->orWhere('tags', 'like', "%{$search}%");
                    });
                }
            )
            ->when(
                array_key_exists('pinned', $filters) && $filters['pinned'] !== null && $filters['pinned'] !== '',
                fn ($query) => $query->where('is_pinned', (bool) ((int) $filters['pinned']))
            )
            ->orderByRaw('CASE WHEN is_pinned = 1 THEN 0 ELSE 1 END')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('notes.index', [
            'notes' => $notes,
            'search' => $filters['q'] ?? null,
            'selectedPinned' => $filters['pinned'] ?? null,
        ]);
    }

    /**
     * Show the form for creating a new note.
     */
    public function create(): View
    {
        return view('notes.create', [
            'note' => new Note(),
        ]);
    }

    /**
     * Store a newly created note in storage.
     */
    public function store(StoreNoteRequest $request): RedirectResponse
    {
        $note = new Note($request->validated());
        $note->is_pinned = $request->boolean('is_pinned');
        $note->user()->associate($request->user());
        $note->save();

        return Redirect::route('notes.index')->with('status', 'note-created');
    }

    /**
     * Show the form for editing the specified note.
     */
    public function edit(Request $request, Note $note): View
    {
        $note = $this->ownedNote($request, $note);

        return view('notes.edit', [
            'note' => $note,
        ]);
    }

    /**
     * Update the specified note in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note): RedirectResponse
    {
        $note = $this->ownedNote($request, $note);

        $note->fill($request->validated());
        $note->is_pinned = $request->boolean('is_pinned');
        $note->save();

        return Redirect::route('notes.index')->with('status', 'note-updated');
    }

    /**
     * Remove the specified note from storage.
     */
    public function destroy(Request $request, Note $note): RedirectResponse
    {
        $note = $this->ownedNote($request, $note);
        $note->delete();

        return Redirect::route('notes.index')->with('status', 'note-deleted');
    }

    /**
     * Toggle pinned status for the specified note.
     */
    public function togglePin(Request $request, Note $note): RedirectResponse
    {
        $note = $this->ownedNote($request, $note);

        $note->is_pinned = ! $note->is_pinned;
        $note->save();

        return Redirect::route('notes.index')->with('status', 'note-pin-updated');
    }

    /**
     * Resolve note ownership for the current user.
     */
    protected function ownedNote(Request $request, Note $note): Note
    {
        abort_if($note->user_id !== $request->user()->id, 404);

        return $note;
    }
}
