<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker;
use App\Models\Task;

class WorkersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $workers = Worker::where('login','LIKE','%'.$search.'%')->get();
	    $tasks = [];

	    foreach($workers as $worker){
                if($worker->is_available != '1' ){
                    $task = Task::select('id')->where('assigned_to',$worker->id)->get()->toArray();
                    $tasks[$worker->id] = $task[0]['id'];
                }
            }
	    
            return view('workers.index', [
		    'workers' => $workers,
		    'tasks' => $tasks
            ]);
        } else {
		$workers = Worker::all();
		$tasks = [];
  

	    foreach($workers as $worker){
                if($worker->is_available != '1' ){
                    $task = Task::select('id')->where('assigned_to',$worker->id)->get()->toArray();
                    $tasks[$worker->id] = $task[0]['id'];
                }
            }
            return view('workers.index', [
		    'workers' => $workers,
		    'tasks' => $tasks
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	return view('workers.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
		'name' => 'required|string',
		'surname' => 'required|string'
        ]);
	
	$login = strtolower(substr($request->input('name'),0,1).substr($request->input('surname'),0,5));	
        $worker = Worker::create([
		'name' => $request->input('name'),
		'surname' => $request->input('surname'),
		'login' => $login,
		'is_available' => '1'
        ]);


        return redirect('/workers');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
