<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Task Management') }}
            </h2>

            <a href="{{ route('tasks.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                {{ __('Add Task') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status') === 'task-created')
                <div class="p-4 rounded-md bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-200">
                    {{ __('Task created successfully.') }}
                </div>
            @elseif (session('status') === 'task-updated')
                <div class="p-4 rounded-md bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-200">
                    {{ __('Task updated successfully.') }}
                </div>
            @elseif (session('status') === 'task-deleted')
                <div class="p-4 rounded-md bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-200">
                    {{ __('Task deleted successfully.') }}
                </div>
            @endif

            <div class="p-4 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form method="GET" action="{{ route('tasks.index') }}" class="grid gap-4 sm:grid-cols-3 sm:items-end">
                    <div>
                        <x-input-label for="status" :value="__('Status')" />
                        <select id="status" name="status" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">{{ __('All statuses') }}</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}" @selected(($selectedStatus ?? null) === $status)>
                                    {{ str($status)->headline() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="priority" :value="__('Priority')" />
                        <select id="priority" name="priority" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">{{ __('All priorities') }}</option>
                            @foreach ($priorities as $priority)
                                <option value="{{ $priority }}" @selected(($selectedPriority ?? null) === $priority)>
                                    {{ str($priority)->headline() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center gap-3">
                        <x-primary-button>{{ __('Apply Filter') }}</x-primary-button>
                        <a href="{{ route('tasks.index') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:underline">{{ __('Reset') }}</a>
                    </div>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden">
                @if ($tasks->isEmpty())
                    <div class="p-6 text-gray-600 dark:text-gray-300">
                        {{ __('No tasks yet. Create your first task to get started.') }}
                    </div>
                @else
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($tasks as $task)
                            <div class="p-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                                <div>
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $task->title }}</h3>
                                        @if ($task->is_urgent)
                                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-200">
                                                {{ __('Urgent') }}
                                            </span>
                                        @endif
                                    </div>

                                    @if ($task->description)
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ $task->description }}</p>
                                    @endif

                                    <div class="mt-3 flex gap-2 flex-wrap text-xs">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                            {{ __('Priority:') }} {{ str($task->priority)->headline() }}
                                        </span>
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                            {{ __('Status:') }} {{ str($task->status)->headline() }}
                                        </span>
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                            {{ __('Deadline:') }} {{ $task->deadline?->format('d M Y') ?? __('None') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3">
                                    <a href="{{ route('tasks.edit', $task) }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">{{ __('Edit') }}</a>
                                    <form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('{{ __('Delete this task?') }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm font-medium text-red-600 dark:text-red-400 hover:underline">{{ __('Delete') }}</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        {{ $tasks->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
