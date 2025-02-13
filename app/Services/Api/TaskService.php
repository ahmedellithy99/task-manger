<?php

namespace App\Services\Api;

use App\Models\Task;

class TaskService
{
    public function getTasksForUser($user)
    {
        return Task::with('user')->get();
    }

    public function createTask(array $data)
    {
        return Task::create($data);
    }

    public function updateTask(Task $task, array $data)
    {
        $task->update($data);

        return $task;
    }

    public function deleteTask(Task $task)
    {
        $task->delete();
    }
}
