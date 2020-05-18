<?php

namespace App\Http\Controllers;
use App\Folder;
use App\Task;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;

class TaskController extends Controller
{
    public function index(int $folder_id)
    {
        $folders = Folder::all();

        $current_folder = Folder::find($folder_id);

        $tasks = $current_folder->tasks()->get();

        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $folder_id,
            'tasks' => $tasks,
        ]);
    }

    public function show(int $folder_id, int $task_id)
    {
        $task = Task::find($task_id);
        
        return view('tasks.show', [
            'task' => $task,
            'task_id' => $task->id,
        ]);
    }


    public function create(int $folder_id)
    {
        $users = User::all();

        return view('tasks.create', [
            'users' => $users,
            'folder_id' => $folder_id
        ]);
    }

    public function store(int $folder_id, CreateTask $request)
    {

        $current_folder = Folder::find($folder_id);

        $user = Auth::user();

        $task = new Task();
        $task->title = $request->title;
        $task->detail = $request->detail;
        $task->due_date = $request->due_date;
        $task->assigning_date = Carbon::now();
        $task->assigning_id = $user->id;
        $task->assigner_id = $request->assigner_id;
        $current_folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'folder_id' => $current_folder->id,
        ]);
    }

    public function edit(int $folder_id, int $task_id)
    {
        $task = Task::find($task_id);
        $users = User::all();

        return view('tasks.edit', [
            'task' => $task,
            'users' => $users,
        ]);
    }

    public function update(int $folder_id, int $task_id, EditTask $request)
    {
        $task = Task::find($task_id);

        $task->title = $request->title;
        $task->detail = $request->detail;
        $task->status = $request->status;
        $task->due_date = $request->due_date;

        if ($task->status == 2){
            $task->start_date = Carbon::now();
            $start_date = $task->start_date;
            $task->pending_time = $task->assigning_date->diffInHours($start_date);
        }

        if ($task->status == 3){
            $task->end_date = Carbon::now();
            $task->work_time = $task->start_date->diffInHours($task->end_date);
        }


        $task->save();

        return redirect()->route('tasks.index', [
            'folder_id' => $task->folder_id,
        ]);
    }

    public function delete(int $folder_id, int $task_id)
    {
        dd($task_id);
        $task = Task::find($task_id);
        $task->delete();
        return redirect();
    }


}
