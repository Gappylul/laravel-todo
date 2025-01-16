<?php

namespace App\Events;

use App\Models\Todo;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class TodoCreated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public array $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo->toArray(); // Converts to array
        $this->todo['user'] = $todo->user->name; // Append user name if needed
    }

    public function broadcastOn(): Channel
    {
        return new Channel('todos');
    }

    public function broadcastAs(): string
    {
        return 'todo.created';
    }
}
