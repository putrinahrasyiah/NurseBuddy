<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $greeting }}, {{ Auth::user()->name }}</p>
                    <h3 class="mt-1 text-2xl font-bold text-gray-900 dark:text-gray-100">{{ __('Ready for your next learning step?') }}</h3>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                        {{ __('Track what matters today: deadlines, learning progress, and personal well-being in one place.') }}
                    </p>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Today\'s Tasks') }}</h3>
                                <a href="{{ route('tasks.index') }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">
                                    {{ __('Open Tasks') }}
                                </a>
                            </div>

                            <div class="mt-4 grid gap-3 sm:grid-cols-3">
                                <div class="rounded-lg border border-gray-200 dark:border-gray-700 p-3">
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('Due Today') }}</p>
                                    <p class="mt-1 text-xl font-semibold text-gray-900 dark:text-gray-100">{{ $taskSummary['due_today'] }}</p>
                                </div>
                                <div class="rounded-lg border border-gray-200 dark:border-gray-700 p-3">
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('In Progress') }}</p>
                                    <p class="mt-1 text-xl font-semibold text-gray-900 dark:text-gray-100">{{ $taskSummary['in_progress'] }}</p>
                                </div>
                                <div class="rounded-lg border border-gray-200 dark:border-gray-700 p-3">
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('Overdue') }}</p>
                                    <p class="mt-1 text-xl font-semibold {{ $taskSummary['overdue'] > 0 ? 'text-rose-600 dark:text-rose-400' : 'text-gray-900 dark:text-gray-100' }}">{{ $taskSummary['overdue'] }}</p>
                                </div>
                            </div>

                            <div class="mt-4 space-y-3">
                                @forelse($todayTasks as $task)
                                    <div class="rounded-lg border border-gray-200 dark:border-gray-700 p-3 flex items-start justify-between gap-4">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ $task->title }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                {{ str($task->priority)->replace('_', ' ')->title() }}
                                                |
                                                {{ str($task->status)->replace('_', ' ')->title() }}
                                                @if($task->is_urgent)
                                                    | {{ __('Urgent') }}
                                                @endif
                                            </p>
                                        </div>
                                        <a href="{{ route('tasks.edit', $task) }}" class="text-xs font-medium text-indigo-600 dark:text-indigo-400 hover:underline">
                                            {{ __('Edit') }}
                                        </a>
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ __('No due tasks today. Great job staying on track.') }}</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Recent Notes') }}</h3>
                                <a href="{{ route('notes.index') }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">
                                    {{ __('Open Notes') }}
                                </a>
                            </div>

                            <div class="mt-4 space-y-3">
                                @forelse($recentNotes as $note)
                                    <div class="rounded-lg border border-gray-200 dark:border-gray-700 p-3">
                                        <div class="flex items-center justify-between">
                                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ $note->title }}</p>
                                            @if($note->is_pinned)
                                                <span class="text-xs px-2 py-1 rounded-full bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-300">{{ __('Pinned') }}</span>
                                            @endif
                                        </div>
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 line-clamp-2">{{ \Illuminate\Support\Str::limit($note->content, 120) }}</p>
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ __('No notes yet. Add your first learning note to build your personal knowledge base.') }}</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Mood Summary') }}</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                @if($todayMood)
                                    {{ __('Today\'s check-in:') }} <span class="font-medium">{{ str($todayMood->mood)->replace('_', ' ')->title() }}</span>
                                @else
                                    {{ __('You have not checked in today yet.') }}
                                @endif
                            </p>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                {{ __('Latest mood:') }} {{ $latestMood ? str($latestMood->mood)->replace('_', ' ')->title().' ('.$latestMood->entry_date->format('d M Y').')' : __('No entry yet') }}
                            </p>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                {{ __('Dominant mood (30 days):') }} {{ $dominantMood ? str($dominantMood->mood)->replace('_', ' ')->title() : __('N/A') }}
                            </p>
                            <a href="{{ route('moods.index') }}" class="mt-4 inline-flex text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">
                                {{ __('Open Mood Tracker') }}
                            </a>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Study Progress') }}</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                {{ $studyDoneCount }} / {{ $totalStudyMaterials }} {{ __('materials completed') }}
                            </p>
                            <div class="mt-3 h-2 w-full rounded-full bg-gray-100 dark:bg-gray-700 overflow-hidden">
                                <div class="h-full rounded-full bg-emerald-500" style="width: {{ $studyCompletionRate }}%"></div>
                            </div>
                            <div class="mt-2 flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                <span>{{ $studyCompletionRate }}% {{ __('completion') }}</span>
                                <span>{{ $studyStartedCount }} {{ __('started') }}</span>
                            </div>
                            <a href="{{ route('study-library.index') }}" class="mt-4 inline-flex text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">
                                {{ __('Open Study Library') }}
                            </a>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Reward Tree (V1 UI)') }}</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                {{ __('Growth stage:') }} <span class="font-medium">{{ $rewardTreeStage }}</span>
                            </p>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                {{ __('Daily consistency score:') }} {{ $dailyConsistencyPoints }} / 3
                            </p>
                            <div class="mt-4 rounded-xl border border-emerald-200 dark:border-emerald-700/50 bg-emerald-50 dark:bg-emerald-900/20 p-4 text-center">
                                <div class="text-base font-semibold text-emerald-700 dark:text-emerald-300">
                                    @if($rewardTreeStage === 'Flourishing')
                                        {{ __('Tree Stage: Flourishing') }}
                                    @elseif($rewardTreeStage === 'Growing')
                                        {{ __('Tree Stage: Growing') }}
                                    @elseif($rewardTreeStage === 'Sprout')
                                        {{ __('Tree Stage: Sprout') }}
                                    @else
                                        {{ __('Tree Stage: Seed') }}
                                    @endif
                                </div>
                                <p class="mt-2 text-xs text-emerald-700 dark:text-emerald-300">{{ __('Keep consistent habits to grow your tree.') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Quick Access') }}</h3>
                            <div class="mt-3 space-y-3">
                                @foreach($quickAccess as $item)
                                    <a href="{{ $item['route'] }}" class="block rounded-lg border border-gray-200 dark:border-gray-700 p-3 hover:border-indigo-300 dark:hover:border-indigo-500 transition">
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $item['title'] }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $item['description'] }}</p>
                                        <p class="text-xs text-indigo-600 dark:text-indigo-400 mt-2">{{ $item['metric'] }}</p>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
