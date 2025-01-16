<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All The Todos') }}
        </h2>
    </x-slot>

    <script>
        window.Echo.channel('todos')
            .listen('TodoCreated', (event) => {
                const todo = event.todo;

                // Ensure the todo object has all the necessary properties
                if (!todo || !todo.id || !todo.title || !todo.description || !todo.user) {
                    console.error("Received malformed todo event:", event);
                    return;
                }

                // Append the new todo to the list
                const todoList = document.getElementById('todo-list');
                const newTodoElement = document.createElement('div');
                newTodoElement.classList.add('mb-6', 'bg-gray-100', 'dark:bg-gray-700', 'rounded-lg', 'p-4');
                newTodoElement.innerHTML = `
                    <div class="flex items-center justify-between">
                        <a href="todos/${todo.id}" class="text-xl font-semibold text-gray-800 dark:text-gray-200 cursor-pointer">${todo.title}</a>
                        <span class="text-sm text-gray-500 dark:text-gray-400">${todo.user}</span>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">${todo.description}</p>
                `;
                todoList.prepend(newTodoElement);
            });
    </script>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <!-- Todo List -->
                    <div id="todo-list">
                        @foreach($todos as $todo)
                            <div class="mb-6 bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('todos.show', $todo->id) }}" class="text-xl font-semibold text-gray-800 dark:text-gray-200 cursor-pointer">
                                        {{ $todo->title }}
                                    </a>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $todo->user->name }}</span>
                                </div>
                                <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $todo->description }}</p>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination Links -->
                    <div class="mt-8">
                        {{ $todos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
