<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Material Detail') }}
            </h2>
            <a href="{{ route('study-library.index') }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">{{ __('Back to Library') }}</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6 space-y-6">
                <div class="space-y-2">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $material->title }}</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ __('Category:') }} {{ $material->category->name }}</p>

                    <div class="flex flex-wrap gap-2 text-xs">
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                            {{ __('Type:') }} {{ str($material->resource_type)->headline() }}
                        </span>
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 {{ $status === 'done' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-200' }}">
                            {{ __('Status:') }} {{ str($status)->headline() }}
                        </span>
                    </div>
                </div>

                @if ($material->thumbnail)
                    <img src="{{ $material->thumbnail }}" alt="{{ $material->title }}" class="w-full max-h-80 object-cover rounded-md">
                @endif

                @if ($material->description)
                    <div class="prose max-w-none dark:prose-invert">
                        <p>{{ $material->description }}</p>
                    </div>
                @endif

                <div class="space-y-3">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Resource Access') }}</h3>
                    <a href="{{ $material->resource_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        {{ __('Open Resource') }}
                    </a>
                </div>

                <form method="POST" action="{{ route('study-library.status', $material) }}" class="flex items-center gap-3">
                    @csrf
                    @method('PATCH')
                    <label for="status" class="text-sm text-gray-700 dark:text-gray-300">{{ __('Learning Status') }}</label>
                    <select id="status" name="status" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @foreach ($statuses as $statusOption)
                            <option value="{{ $statusOption }}" @selected($status === $statusOption)>
                                {{ str($statusOption)->headline() }}
                            </option>
                        @endforeach
                    </select>
                    <x-primary-button>{{ __('Save Status') }}</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
