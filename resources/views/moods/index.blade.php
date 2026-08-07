<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Mood Tracker') }}
            </h2>

            <a href="{{ route('moods.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                {{ __('Add Mood Entry') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status') === 'mood-created')
                <div class="p-4 rounded-md bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-200">
                    {{ __('Mood entry saved successfully.') }}
                </div>
            @elseif (session('status') === 'mood-updated')
                <div class="p-4 rounded-md bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-200">
                    {{ __('Mood entry updated successfully.') }}
                </div>
            @endif

            <div class="grid gap-4 md:grid-cols-3">
                <div class="p-4 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg border-l-4 border-emerald-500 dark:border-emerald-400">
                    <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">{{ __('Total Entries') }}</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $totalEntries }}</p>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ __('Based on current filter.') }}</p>
                </div>

                <div class="p-4 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg border-l-4 border-cyan-500 dark:border-cyan-400 md:col-span-2">
                    <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">{{ __('Dominant Mood') }}</p>

                    @if ($dominantMood)
                        <div class="mt-3 flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <span class="inline-flex h-4 w-4 rounded-full" style="background-color: {{ $dominantMood['color'] }};"></span>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $dominantMood['label'] }}</p>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">{{ $dominantMood['count'] }} {{ __('entries') }}</p>
                        </div>
                    @else
                        <p class="mt-3 text-sm text-gray-600 dark:text-gray-300">{{ __('No mood entries yet to calculate trend.') }}</p>
                    @endif
                </div>
            </div>

            <div class="p-4 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Mood Trend') }}</h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ __('Color blocks show your recorded mood each day.') }}</p>
                        @if ($trendRangeLabel)
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ $trendRangeLabel }}</p>
                        @endif
                    </div>
                </div>

                @if ($trendDays->isEmpty())
                    <p class="mt-4 text-sm text-gray-600 dark:text-gray-300">{{ __('No days available for the selected period.') }}</p>
                @else
                    <div class="mt-5 grid grid-cols-7 gap-2">
                        @foreach ($trendDays as $day)
                            <div class="rounded-lg border p-2 text-center" style="border-color: {{ $day['color'] }}; background-color: {{ $day['color'] }}22;" title="{{ $day['date_label'] }} - {{ $day['mood_label'] }}">
                                <p class="text-[11px] font-semibold text-gray-700 dark:text-gray-200">{{ $day['short_label'] }}</p>
                                <p class="mt-1 text-[10px] text-gray-600 dark:text-gray-300 truncate">{{ $day['mood_label'] }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="mt-6">
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Mood Distribution') }}</h4>
                    @if ($distribution->isEmpty())
                        <p class="mt-3 text-sm text-gray-600 dark:text-gray-300">{{ __('No distribution data for the selected period.') }}</p>
                    @else
                        <div class="mt-3 space-y-3">
                            @foreach ($distribution as $item)
                                <div>
                                    <div class="flex items-center justify-between text-xs text-gray-600 dark:text-gray-300">
                                        <span>{{ $item['label'] }}</span>
                                        <span>{{ $item['count'] }}</span>
                                    </div>
                                    <div class="mt-1 h-2.5 rounded-full bg-gray-100 dark:bg-gray-700 overflow-hidden">
                                        <div class="h-full rounded-full" style="width: {{ $item['percentage'] }}%; background-color: {{ $item['color'] }};"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="p-4 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form method="GET" action="{{ route('moods.index') }}" class="grid gap-4 sm:grid-cols-3 sm:items-end">
                    <div>
                        <x-input-label for="month" :value="__('Month Filter')" />
                        <x-text-input id="month" name="month" type="month" class="mt-1 block w-full" :value="old('month', $selectedMonth)" />
                    </div>

                    <div class="flex items-center gap-3 sm:col-span-2">
                        <x-primary-button>{{ __('Apply Filter') }}</x-primary-button>
                        <a href="{{ route('moods.index') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:underline">{{ __('Reset') }}</a>
                    </div>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden">
                @if ($moods->isEmpty())
                    <div class="p-6 text-gray-600 dark:text-gray-300">
                        {{ __('No mood history yet. Start by adding your first mood entry.') }}
                    </div>
                @else
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($moods as $mood)
                            <div class="p-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                                <div>
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ str($mood->mood)->headline() }}</h3>
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                            {{ $mood->entry_date?->format('d M Y') }}
                                        </span>
                                    </div>

                                    @if ($mood->reflection)
                                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300 whitespace-pre-line">{{ $mood->reflection }}</p>
                                    @else
                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ __('No reflection added.') }}</p>
                                    @endif
                                </div>

                                <div>
                                    <a href="{{ route('moods.edit', $mood) }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">{{ __('Edit') }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        {{ $moods->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>