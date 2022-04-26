<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $tasks
     * @return void
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware(['auth', 'verified']);

        $this->tasks = $tasks;
    }

    /**
     * Display a list of all of the user's tasks.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('to-do', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }

    /**
     * Create a new task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'task' => 'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'title' => $request->title,
            'task' => $request->task,
        ]);

        return redirect('/to-do');
    }

    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);

        $task->delete();

        return redirect('/to-do');
    }
}
