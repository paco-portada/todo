<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

use App\Models\User;

use Auth;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks();
        // $tasks = Task::where('user_id', auth()->user()->id)
        //       ->get();
        //$tasks = Task::all();
        // $id = auth()->user()->id;
        // $tasks = Task::where('user_id', $id)->get();

        // $tasks = User::getCasts();
        // return view('dashboard', compact('tasks'));
        return view('dashboard')->with('tasks', $tasks);
    }
    public function add()
    {
    	return view('add');
    }

    public function create(Request $request)
    {
        //$this->validate($request, [
        //    'description' => 'required'
        //]);
        // Validar los datos del formulario
        $request->validate([
            'description' => 'required'
        ]);
    	$task = new Task();
    	$task->description = $request->description;
    	$task->user_id = auth()->user()->id;
    	$task->save();
    	return redirect('/dashboard'); 
    }

    public function edit(Task $task)
    {

    	if (auth()->user()->id == $task->user_id)
        {            
                return view('edit', compact('task'));
        }           
        else {
             return redirect('/dashboard');
         }            	
    }

    public function update(Request $request, Task $task)
    {
    	if(isset($_POST['delete'])) {
    		$task->delete();
    		return redirect('/dashboard');
    	}
    	else
    	{
            //$this->validate($request, [
            //    'description' => 'required'
            //]);
            $request->validate([
                'description' => 'required'
            ]);
    		$task->description = $request->description;
	    	$task->save();
	    	return redirect('/dashboard'); 
    	}    	
    }
}

