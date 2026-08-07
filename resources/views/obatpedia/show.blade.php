<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Drug Detail') }}
            </h2>
            <a href="{{ route('obatpedia.index') }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">{{ __('Back to Obatpedia') }}</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status') === 'drug-vote-updated')
                <div class="p-4 rounded-md bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-200">
                    {{ __('Vote updated.') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6 space-y-6">
                <div class="space-y-2">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $drug->name }}</h1>
                    @if ($drug->generic_name)
                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ __('Generic Name:') }} {{ $drug->generic_name }}</p>
                    @endif

                    <div class="flex flex-wrap gap-2 text-xs">
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-200">
                            {{ __('Upvote:') }} {{ $drug->upvotes_count }}
                        </span>
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 bg-rose-100 text-rose-800 dark:bg-rose-900/30 dark:text-rose-200">
                            {{ __('Downvote:') }} {{ $drug->downvotes_count }}
                        </span>
                    </div>
                </div>

                @if ($drug->aliases->isNotEmpty())
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Aliases') }}</h3>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">{{ $drug->aliases->pluck('alias')->join(', ') }}</p>
                    </div>
                @endif

                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Description') }}</h3>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">{{ $drug->description ?: __('No description available yet.') }}</p>
                    </div>

                    <div class="rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Indication') }}</h3>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">{{ $drug->indication ?: __('No indication info available yet.') }}</p>
                    </div>

                    <div class="rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Dosage') }}</h3>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">{{ $drug->dosage ?: __('No dosage info available yet.') }}</p>
                    </div>

                    <div class="rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Route') }}</h3>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">{{ $drug->route ?: __('No route info available yet.') }}</p>
                    </div>

                    <div class="rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Contraindication') }}</h3>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">{{ $drug->contraindication ?: __('No contraindication info available yet.') }}</p>
                    </div>

                    <div class="rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Side Effects') }}</h3>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">{{ $drug->side_effects ?: __('No side effect info available yet.') }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <form method="POST" action="{{ route('obatpedia.vote', $drug) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="vote" value="up">
                        <button type="submit" class="inline-flex items-center px-4 py-2 rounded-md text-sm font-semibold {{ $userVote === 1 ? 'bg-green-700 text-white' : 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-200' }} hover:opacity-90">
                            {{ __('Upvote') }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('obatpedia.vote', $drug) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="vote" value="down">
                        <button type="submit" class="inline-flex items-center px-4 py-2 rounded-md text-sm font-semibold {{ $userVote === -1 ? 'bg-rose-700 text-white' : 'bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-200' }} hover:opacity-90">
                            {{ __('Downvote') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
