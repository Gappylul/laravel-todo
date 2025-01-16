<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('A Todo') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <h1 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $todo->title }}</h1>
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $todo->user->name }}</span>
                        </div>

                        <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $todo->description }}</p>
                    </div>

                    @if($todo->user_id === Auth::id())
                        <div class="mt-6 flex justify-end space-x-4">
                            <!-- Edit Button -->
                            <a href="{{ route('todos.edit', $todo->id) }}">
                                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
                                    Edit
                                </button>
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this todo?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-50">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
