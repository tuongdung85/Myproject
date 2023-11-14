<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\StoretaskRequest;
use App\Http\Requests\UpdatetaskRequest;
use App\Models\task;
use App\Http\Controllers\Controller;
use App\Http\Resources\task as ResourcesTask;
use Illuminate\Console\View\Components\Task as ComponentsTask;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ResourcesTask::collection(Task::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoretaskRequest $request)
    {
        $task = Task::create($request->validated());
        return ResourcesTask::make($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetaskRequest $request, task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(task $task)
    {
        //
    }
}
