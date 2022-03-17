<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Format;

class FormatsController extends Controller
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
            $formats = Format::where('format','LIKE','%'.$search.'%')->get();
	    
	    return view('formats.index', [
                'formats' => $formats
            ]);
        } else {

        	$formats = Format::all();

        	return view('formats.index', [
            		'formats' => $formats
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
        return view('formats.create');
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
            'format' => 'required|string',
            'capacity' => 'required|integer|gte:0'
        ]);

        $format = Format::create([
            'format' => $request->input('format'),
            'capacity' => $request->input('capacity'),
        ]);

        return redirect('/formats');
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
        $format = Format::find($id);
        return view('formats.edit')->with('format',$format);
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
        $request->validate([
            'format' => 'required|string',
            'capacity' => 'required|integer|gte:0'
        ]);
        
        $format = Format::where('id' , $id)
        ->update([
            'format' => $request->input('format'),
            'capacity' => $request->input('capacity'),
        ]);

        return redirect('/formats');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $format = Format::find($id);

        $format->delete();

        return redirect('/formats');
    }
}
