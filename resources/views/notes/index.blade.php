<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Personal Notes') }}
            </h2>

            <a href="{{ route('notes.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                {{ __('Add Note') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status') === 'note-created')
                <div class="p-4 rounded-md bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-200">
                    {{ __('Note created successfully.') }}
                </div>
            @elseif (session('status') === 'note-updated')
                <div class="p-4 rounded-md bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-200">
                    {{ __('Note updated successfully.') }}
                </div>
            @elseif (session('status') === 'note-deleted')
                <div class="p-4 rounded-md bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-200">
                    {{ __('Note deleted successfully.') }}
                </div>
            @elseif (session('status') === 'note-pin-updated')
                <div class="p-4 rounded-md bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-200">
                    {{ __('Note pin status updated.') }}
                </div>
            @endif

            <div class="p-4 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form method="GET" action="{{ route('notes.index') }}" class="grid gap-4 sm:grid-cols-3 sm:items-end">
                    <div class="sm:col-span-2">
                        <x-input-label for="q" :value="__('Search Notes')" />
                        <x-text-input id="q" name="q" type="text" class="mt-1 block w-full" :value="old('q', $search)" placeholder="{{ __('Search by title, content, or tags') }}" />
                    </div>

                    <div>
                        <x-input-label for="pinned" :value="__('Pinned Filter')" />
                        <select id="pinned" name="pinned" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">{{ __('All notes') }}</option>
                            <option value="1" @selected(($selectedPinned ?? null) === '1')>{{ __('Pinned only') }}</option>
                            <option value="0" @selected(($selectedPinned ?? null) === '0')>{{ __('Unpinned only') }}</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-3 sm:col-span-3">
                        <x-primary-button>{{ __('Apply Filter') }}</x-primary-button>
                        <a href="{{ route('notes.index') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:underline">{{ __('Reset') }}</a>
                    </div>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden">
                @if ($notes->isEmpty())
                    <div class="p-6 text-gray-600 dark:text-gray-300">
                        {{ __('No notes yet. Create your first note to get started.') }}
                    </div>
                @else
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($notes as $note)
                            <div class="p-6 flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                                <div class="max-w-3xl">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $note->title }}</h3>

                                        @if ($note->is_pinned)
                                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-200">
                                                {{ __('Pinned') }}
                                            </span>
                                        @endif
                                    </div>

                                    <p class="mt-2 text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ str($note->content)->limit(220) }}</p>

                                    @if ($note->tags)
                                        <div class="mt-3 flex flex-wrap gap-2">
                                            @foreach (collect(explode(',', $note->tags))->map(fn ($tag) => trim($tag))->filter() as $tag)
                                                <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                                                    #{{ $tag }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif

                                    <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                                        {{ __('Updated') }} {{ $note->updated_at?->format('d M Y H:i') }}
                                    </p>
                                </div>

                                <div class="flex items-center gap-3 md:pt-1">
                                    <form method="POST" action="{{ route('notes.pin', $note) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-sm font-medium text-amber-600 dark:text-amber-400 hover:underline">
                                            {{ $note->is_pinned ? __('Unpin') : __('Pin') }}
                                        </button>
                                    </form>
                                    <a href="{{ route('notes.edit', $note) }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">{{ __('Edit') }}</a>
                                    <form method="POST" action="{{ route('notes.destroy', $note) }}" onsubmit="return confirm('{{ __('Delete this note?') }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm font-medium text-red-600 dark:text-red-400 hover:underline">{{ __('Delete') }}</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        {{ $notes->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
