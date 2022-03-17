<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Item;
use App\Models\Location;
use App\Models\Worker;

class TasksController extends Controller
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
            $tasks = Task::where('id',$search)->get();
            $locations = [];
            $destinations = [];
	    $items = [];
	    $workers = [];
	    $statuses = [];
    
            foreach($tasks as $task){
                $location = Location::select('name')->where('id',$task->location_id)->get()->toArray();
                $locations[$task->id] = $location[0]['name'];
                $destination = Location::select('name')->where('id',$task->location_id)->get()->toArray();
                $destinations[$task->id] = $destination[0]['name'];
                $item = Item::select('description')->where('id',$task->item_id)->get()->toArray();
		$items[$task->id] = $item[0]['description'];
		if($task->assigned_to != '0'){
		$worker = Worker::select('login')->where('id',$task->assigned_to)->get()->toArray();
		$workers[$task->id] = $worker[0]['login'];
		}
		if($task->status == '1'){
			$statuses[$task->id] = "Awaiting";
		} else {
			$statuses[$task->id] = "Taken";
		}
            }
    
            return view('tasks.index', [
                'tasks' => $tasks,
                'locations' => $locations,
                'destinations' => $destinations,
		'items' => $items,
		'workers' => $workers,
		'statuses' => $statuses
            ]);
        } else {
            $tasks = Task::all();
            $locations = [];
            $destinations = [];
	    $items = [];
	    $workers = [];
	    $statuses = [];

            foreach($tasks as $task){
                $location = Location::select('name')->where('id',$task->location_id)->get()->toArray();
                $locations[$task->id] = $location[0]['name'];
                $destination = Location::select('name')->where('id',$task->location_id)->get()->toArray();
                $destinations[$task->id] = $destination[0]['name'];
                $item = Item::select('description')->where('id',$task->item_id)->get()->toArray();
		$items[$task->id] = $item[0]['description'];
		if($task->assigned_to != '0' && !is_null($task->assigned_to)){
	    	$worker = Worker::select('login')->where('id',$task->assigned_to)->get()->toArray();
		$workers[$task->id] = $worker[0]['login'];
		}
		if($task->status == '1'){
			$statuses[$task->id] = "Awaiting";
		} else {
			$statuses[$task->id] = "Taken";
		}
	    }
    
            return view('tasks.index', [
                'tasks' => $tasks,
                'locations' => $locations,
                'destinations' => $destinations,
		'items' => $items,
		'workers' => $workers,
		'statuses' => $statuses
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
	$tasks = Task::all();
   	$locations = Location::all();
        $items = Item::all();
	return view('tasks.create', [
		'tasks' => $tasks,
            'locations' => $locations,
            'items' => $items,
        ]);
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
		'type' => 'required|integer',
		'location' => 'exists:locations,name',
		'destination' => 'exists:locations,name',
		'item_SKU' => 'exists:items,SKU',
		'qty' => 'integer|gte:0'
        ]);
	
	$l_id = Location::select('id')->where('name',$request->input('location'))->get()->toArray();
        $location = $l_id[0]['id'];
	$d_id = Location::select('id')->where('name',$request->input('destination'))->get()->toArray();
	$destination = $d_id[0]['id'];
	$i_id = Item::select('id')->where('SKU',$request->input('SKU'))->get()->toArray();
	$i = $i_id[0]['id'];


        $task = Task::create([
		'type' => $request->input('type'),
		'location_id' => $location,
		'destination_id' => $destination,
            	'item_id' => $i,
		'qty' => $request->input('qty'),
		'status' => '1',
		'assigned_to' => null
        ]);


        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
	    $task = Task::find($id);
	    $workers = Worker::select('login')->where('is_available','1')->get();

	    return view('tasks.assign',[
		    'task'=> $task,
		    'workers' => $workers
	    ]);
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

    public function assign(Request $request, $id) {
	    
	$request->validate([
		'worker_login' => 'required|exists:workers,login',
        ]);
	
	$worker = Worker::select('id')->where('login',$request->input('worker_login'))->get()->toArray();
        $w_id = $worker[0]['id'];

        $task = Task::where('id',$id)->update([
		'assigned_to' => $w_id,
		'status' => '2'
        ]);
	
	$workerr = Worker::where('id',$w_id)->update([
		'is_available' => '0'
	]);

        return redirect('/tasks');

    }

    public function changeStatus(Request $request, $id) {
    
    }
}
