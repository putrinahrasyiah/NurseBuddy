@csrf

<div class="space-y-6">
    <div>
        <x-input-label for="title" :value="__('Title')" />
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $task->title)" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('title')" />
    </div>

    <div>
        <x-input-label for="description" :value="__('Description')" />
        <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description', $task->description) }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('description')" />
    </div>

    <div class="grid gap-6 sm:grid-cols-2">
        <div>
            <x-input-label for="priority" :value="__('Priority')" />
            <select id="priority" name="priority" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                @foreach ($priorities as $priority)
                    <option value="{{ $priority }}" @selected(old('priority', $task->priority ?? 'medium') === $priority)>
                        {{ str($priority)->headline() }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('priority')" />
        </div>

        <div>
            <x-input-label for="status" :value="__('Status')" />
            <select id="status" name="status" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" @selected(old('status', $task->status ?? 'pending') === $status)>
                        {{ str($status)->headline() }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('status')" />
        </div>
    </div>

    <div class="grid gap-6 sm:grid-cols-2 sm:items-end">
        <div>
            <x-input-label for="deadline" :value="__('Deadline')" />
            <x-text-input id="deadline" name="deadline" type="date" class="mt-1 block w-full" :value="old('deadline', optional($task->deadline)->format('Y-m-d'))" />
            <x-input-error class="mt-2" :messages="$errors->get('deadline')" />
        </div>

        <label for="is_urgent" class="inline-flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
            <input id="is_urgent" name="is_urgent" type="checkbox" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" @checked(old('is_urgent', $task->is_urgent))>
            <span>{{ __('Mark as urgent') }}</span>
        </label>
    </div>

    <div class="flex items-center gap-3">
        <x-primary-button>{{ $submitLabel }}</x-primary-button>
        <a href="{{ route('tasks.index') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:underline">{{ __('Cancel') }}</a>
    </div>
</div>
