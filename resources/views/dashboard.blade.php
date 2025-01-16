<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Create Todo Button -->
            <div class="flex justify-between items-center bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Manage Your Todos</h3>
                <a class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-lg" href="{{ route('todos.create') }}">
                    {{ __('Create A Todo') }}
                </a>
            </div>

            @if( !empty($todos && $todos->count() > 0) )
            <!-- Todos Section -->
                <div class=" mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Todos Made By You</h2>

                        @foreach($todos as $todo)
                            <div class="mb-6 bg-gray-100 dark:bg-gray-700 rounded-lg p-4 transition-all duration-300 hover:shadow-lg">
                                <div class="flex items-center justify-between">
                                    <a href="todos/{{ $todo->id }}" class="text-xl font-semibold text-gray-800 dark:text-gray-200 cursor-pointer hover:text-blue-600">
                                        {{ $todo->title }}
                                    </a>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $todo->user->name }}</span>
                                </div>
                                <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $todo->description }}</p>
                            </div>
                        @endforeach

                        <div class="mt-8">
                            {{ $todos->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
