<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;


class TaskController extends Controller
{
	public function index()
	{
		$tasks = Task::where("iscompleted", false)->orderBy("id", "DEC")->get();

		$c_tasks = Task::where("iscompleted", true)->get();
		return response()->json(['tasks' => $tasks, 'c_tasks' => $c_tasks]);
	}
	public function store(Request $request)
	{
		$task = Task::create($request->all());
		return response()->json([
			"code" => 200,
			"message" => "Task added successfully"
		]);
	}
	public function complete($id)
	{
		$task = Task::find($id);
		$task->iscompleted = true;
		$task->save();
		return response()->json([
			"code" => 200,
			"message" => "Task listed as completed"
		]);
	}
	public function destroy($id)
	{
		$task = Task::find($id);
		$task = $task->delete();
		return response()->json([
			"code" => 200,
			"message" => "Task deleted successfully"
		]);
	}
}
