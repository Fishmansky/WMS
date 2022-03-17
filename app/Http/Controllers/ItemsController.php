<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Format;

class ItemsController extends Controller
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
            $items = Item::where('SKU',$search)->get();

            return view('items.index', [
                'items' => $items
            ]);
        } else {
            $items = Item::all();

            return view('items.index', [
                'items' => $items
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
        $formats = Format::all();
        
        return view('items.create', [
            'formats' => $formats
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
            'description' => 'required|string',
            'SKU' => 'required|integer',
            'qty' => 'required|integer|gte:0'
        ]);

        $item = Item::create([
            'description' => $request->input('description'),
            'SKU' => $request->input('SKU'),
            'qty' => $request->input('qty')
        ]);


        return redirect('/items');
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
        $item = Item::find($id);
        return view('items.edit')->with('item',$item);
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
            'description' => 'required|string',
            'SKU' => 'required|integer',
            'qty' => 'required|integer|gte:0'
        ]);
        
        $item = Item::where('id' , $id)
        ->update([
            'description' => $request->input('description'),
            'SKU' => $request->input('SKU'),
            'qty' => $request->input('qty')
        ]);

        return redirect('/items');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);

        $item->delete();

        return redirect('/items');
    }

    public function lookup($id)
    {
        $item = Item::where('ID',$id)->firstOrFail();
        return view('index', [
            'item' => $item
        ]);
    }
}
