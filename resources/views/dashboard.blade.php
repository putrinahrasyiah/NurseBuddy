<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-6 md:grid-cols-2">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Task Management') }}</h3>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">{{ __('Manage your academic and clinical tasks.') }}</p>
                        <a href="{{ route('tasks.index') }}" class="mt-4 inline-flex text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">
                            {{ __('Open Tasks') }}
                        </a>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-emerald-500 dark:border-emerald-400">
                    <div class="p-6">
                        <div class="flex items-center justify-between gap-3">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Study Library') }}</h3>
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-200">
                                {{ __('Phase 5 Ready') }}
                            </span>
                        </div>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">{{ __('Browse categories, open materials, and update learning status from pending to done.') }}</p>
                        <a href="{{ route('study-library.index') }}" class="mt-4 inline-flex text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">
                            {{ __('Open Study Library') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
