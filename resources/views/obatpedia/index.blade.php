<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Obatpedia') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status') === 'drug-vote-updated')
                <div class="p-4 rounded-md bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-200">
                    {{ __('Vote updated.') }}
                </div>
            @endif

            <div class="p-4 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form method="GET" action="{{ route('obatpedia.index') }}" class="grid gap-4 sm:grid-cols-5 sm:items-end">
                    <div class="sm:col-span-4">
                        <x-input-label for="search" :value="__('Search Drug or Alias')" />
                        <x-text-input id="search" name="search" type="text" class="mt-1 block w-full" :value="$search" placeholder="{{ __('e.g. Paracetamol, Acetaminophen') }}" />
                    </div>

                    <div class="flex items-center gap-3">
                        <x-primary-button>{{ __('Search') }}</x-primary-button>
                        <a href="{{ route('obatpedia.index') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:underline">{{ __('Reset') }}</a>
                    </div>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden">
                @if ($drugs->isEmpty())
                    <div class="p-6 text-gray-600 dark:text-gray-300">
                        {{ __('No drugs found for this search.') }}
                    </div>
                @else
                    <div class="grid gap-4 p-6 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($drugs as $drug)
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 space-y-3">
                                <div>
                                    <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">{{ $drug->name }}</h3>
                                    @if ($drug->generic_name)
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ __('Generic:') }} {{ $drug->generic_name }}</p>
                                    @endif
                                </div>

                                @if ($drug->aliases->isNotEmpty())
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ __('Alias:') }} {{ $drug->aliases->pluck('alias')->join(', ') }}
                                    </p>
                                @endif

                                @if ($drug->description)
                                    <p class="text-sm text-gray-600 dark:text-gray-300 line-clamp-2">{{ $drug->description }}</p>
                                @endif

                                <div class="flex items-center gap-3 text-xs text-gray-700 dark:text-gray-300">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-200">
                                        {{ __('Upvote:') }} {{ $drug->upvotes_count }}
                                    </span>
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 bg-rose-100 text-rose-800 dark:bg-rose-900/30 dark:text-rose-200">
                                        {{ __('Downvote:') }} {{ $drug->downvotes_count }}
                                    </span>
                                </div>

                                <div class="flex items-center justify-between gap-3">
                                    <a href="{{ route('obatpedia.show', $drug) }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">{{ __('Open Detail') }}</a>

                                    <div class="flex items-center gap-3">
                                        <form method="POST" action="{{ route('obatpedia.vote', $drug) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="vote" value="up">
                                            <button type="submit" class="text-sm font-medium {{ ($drug->user_vote ?? null) === 1 ? 'text-green-700 dark:text-green-300 underline' : 'text-green-600 dark:text-green-400' }} hover:underline">
                                                {{ __('Upvote') }}
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('obatpedia.vote', $drug) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="vote" value="down">
                                            <button type="submit" class="text-sm font-medium {{ ($drug->user_vote ?? null) === -1 ? 'text-rose-700 dark:text-rose-300 underline' : 'text-rose-600 dark:text-rose-400' }} hover:underline">
                                                {{ __('Downvote') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        {{ $drugs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
