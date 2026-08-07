<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Study Library') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status') === 'study-material-status-updated')
                <div class="p-4 rounded-md bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-200">
                    {{ __('Material status updated.') }}
                </div>
            @endif

            <div class="p-4 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form method="GET" action="{{ route('study-library.index') }}" class="grid gap-4 sm:grid-cols-5 sm:items-end">
                    <div>
                        <x-input-label for="category" :value="__('Category')" />
                        <select id="category" name="category" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">{{ __('All categories') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected((string) ($selectedCategory ?? '') === (string) $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="resource_type" :value="__('Resource Type')" />
                        <select id="resource_type" name="resource_type" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">{{ __('All types') }}</option>
                            @foreach ($resourceTypes as $type)
                                <option value="{{ $type }}" @selected(($selectedResourceType ?? null) === $type)>
                                    {{ str($type)->headline() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="status" :value="__('Learning Status')" />
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
                        <x-input-label for="search" :value="__('Search')" />
                        <x-text-input id="search" name="search" type="text" class="mt-1 block w-full" :value="$search" placeholder="{{ __('Title or description') }}" />
                    </div>

                    <div class="flex items-center gap-3">
                        <x-primary-button>{{ __('Apply') }}</x-primary-button>
                        <a href="{{ route('study-library.index') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:underline">{{ __('Reset') }}</a>
                    </div>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden">
                @if ($materials->isEmpty())
                    <div class="p-6 text-gray-600 dark:text-gray-300">
                        {{ __('No materials found for this filter.') }}
                    </div>
                @else
                    <div class="grid gap-4 p-6 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($materials as $material)
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 space-y-3">
                                @if ($material->thumbnail)
                                    <img src="{{ $material->thumbnail }}" alt="{{ $material->title }}" class="h-40 w-full object-cover rounded-md">
                                @endif

                                <div>
                                    <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">{{ $material->title }}</h3>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ $material->category->name }}</p>
                                </div>

                                @if ($material->description)
                                    <p class="text-sm text-gray-600 dark:text-gray-300 line-clamp-2">{{ $material->description }}</p>
                                @endif

                                <div class="flex flex-wrap gap-2 text-xs">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                        {{ str($material->resource_type)->headline() }}
                                    </span>
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 {{ $material->user_status === 'done' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-200' }}">
                                        {{ __('Status:') }} {{ str($material->user_status)->headline() }}
                                    </span>
                                </div>

                                <div class="flex items-center justify-between gap-3">
                                    <a href="{{ route('study-library.show', $material) }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">{{ __('Open Detail') }}</a>

                                    <form method="POST" action="{{ route('study-library.status', $material) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="{{ $material->user_status === 'done' ? 'pending' : 'done' }}">
                                        <button type="submit" class="text-sm font-medium {{ $material->user_status === 'done' ? 'text-amber-600 dark:text-amber-400' : 'text-green-600 dark:text-green-400' }} hover:underline">
                                            {{ $material->user_status === 'done' ? __('Mark as Pending') : __('Mark as Done') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        {{ $materials->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
