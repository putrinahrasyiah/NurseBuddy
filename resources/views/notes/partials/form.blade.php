@csrf

<div class="space-y-6">
    <div>
        <x-input-label for="title" :value="__('Title')" />
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $note->title)" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('title')" />
    </div>

    <div>
        <x-input-label for="content" :value="__('Content')" />
        <textarea id="content" name="content" rows="10" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('content', $note->content) }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('content')" />
    </div>

    <div>
        <x-input-label for="tags" :value="__('Tags (comma separated)')" />
        <x-text-input id="tags" name="tags" type="text" class="mt-1 block w-full" :value="old('tags', $note->tags)" placeholder="{{ __('example: pharmacology, exam prep') }}" />
        <x-input-error class="mt-2" :messages="$errors->get('tags')" />
    </div>

    <div>
        <label for="is_pinned" class="inline-flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
            <input id="is_pinned" name="is_pinned" type="checkbox" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" @checked(old('is_pinned', $note->is_pinned))>
            <span>{{ __('Pin this note') }}</span>
        </label>
    </div>

    <div class="flex items-center gap-3">
        <x-primary-button>{{ $submitLabel }}</x-primary-button>
        <a href="{{ route('notes.index') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:underline">{{ __('Cancel') }}</a>
    </div>
</div>
