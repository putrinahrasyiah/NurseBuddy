@csrf

<div class="space-y-6">
    <div class="grid gap-6 sm:grid-cols-2">
        <div>
            <x-input-label for="mood" :value="__('Mood')" />
            <select id="mood" name="mood" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                @foreach ($moodOptions as $mood)
                    <option value="{{ $mood }}" @selected(old('mood', $moodEntry->mood ?? 'calm') === $mood)>
                        {{ str($mood)->headline() }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('mood')" />
        </div>

        <div>
            <x-input-label for="entry_date" :value="__('Entry Date')" />
            <x-text-input id="entry_date" name="entry_date" type="date" class="mt-1 block w-full" :value="old('entry_date', optional($moodEntry->entry_date)->format('Y-m-d') ?? now()->format('Y-m-d'))" required />
            <x-input-error class="mt-2" :messages="$errors->get('entry_date')" />
        </div>
    </div>

    <div>
        <x-input-label for="reflection" :value="__('Reflection (Optional)')" />
        <textarea id="reflection" name="reflection" rows="6" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('reflection', $moodEntry->reflection) }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('reflection')" />
    </div>

    <div class="flex items-center gap-3">
        <x-primary-button>{{ $submitLabel }}</x-primary-button>
        <a href="{{ route('moods.index') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:underline">{{ __('Cancel') }}</a>
    </div>
</div>