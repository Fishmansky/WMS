<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Item;
use App\Models\Format;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_GET['search'])) {
            $by = $_GET['by'];
            $locations = [];
            switch($by){
                case 1:
                    $query = $_GET['search'];
                    $locations = Location::where('name','LIKE','%'.$query.'%')->get();
                    break;
                case 2:
			$query = $_GET['search'];
			if($format_id = Format::select('id')->where('format','LIKE','%'.$query.'%')->count() > 0){
		    		$format_id = Format::select('id')->where('format','LIKE','%'.$query.'%')->get();
		    		$locations = Location::where('format_id',$format_id[0]['id'])->get();
			}
                    break;
                case 3:
                    $query = $_GET['search'];
                    $item_id = Item::select('id')->where('SKU',$query)->get();
		    if(!empty($item_id[0])){
                        $locations = Location::where('item_id',$item_id[0]['id'])->get();
		    }
                    break;
                default:
                    break;
            }

            $formats = [];
            $items = [];
	    $formatqts = [];
	    $SKUs= [];

            foreach($locations as $location){
                if(!is_null($location->format_id)){
                    $format = Format::select('format')->where('id',$location->format_id)->get()->toArray();
                    $formats[$location->id] = $format[0]['format'];
                    $formatqt = Format::select('capacity')->where('id',$location->format_id)->get()->toArray();
                    $formatqts[$location->id] = $formatqt[0]['capacity'];
                } else {
                    continue;
                }
                if(!is_null($location->item_id)){
                    $item = Item::select('description')->where('id',$location->item_id)->get()->toArray();
		    $items[$location->id] = $item[0]['description'];
		    $SKU = Item::select('SKU')->where('id',$location->item_id)->get()->toArray();
		    $SKUs[$location->id] = $SKU[0]['SKU'];
                }
            }

            return view('locations.index', [
                'locations' => $locations,
                'formats' => $formats,
                'formatqts' => $formatqts,
		'items' => $items,
		'SKUs' => $SKUs
            ]);
        } else {
            $locations = Location::all();
            $formats = [];
            $items = [];
            $formatqts = [];
	    $SKUs = [];

            foreach($locations as $location){
                if(!is_null($location->format_id)){
                    $format = Format::select('format')->where('id',$location->format_id)->get()->toArray();
                    $formats[$location->id] = $format[0]['format'];
                    $formatqt = Format::select('capacity')->where('id',$location->format_id)->get()->toArray();
                    $formatqts[$location->id] = $formatqt[0]['capacity'];
                } else {
                    continue;
                }
                if(!is_null($location->item_id)){
                    $item = Item::select('description')->where('id',$location->item_id)->get()->toArray();
                    $items[$location->id] = $item[0]['description'];
		    $SKU = Item::select('SKU')->where('id',$location->item_id)->get()->toArray();
		    $SKUs[$location->id] = $SKU[0]['SKU'];	
		}
            }

            return view('locations.index', [
                'locations' => $locations,
                'formats' => $formats,
                'formatqts' => $formatqts,
		'items' => $items,
		'SKUs' => $SKUs
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
        return view('locations.create');
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
            'name' => 'required|string|unique:locations',
        ]);

        $location = Location::create([
            'name' => $request->input('name'),
            'item_id' => $request->input('item_id'),
            'format_id' => $request->input('format_id'),
            'qty' => $request->input('qty'),
        ]);


        return redirect('/locations');
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
        $location = Location::find($id);
        $formats = Format::all();
        $current_format = null;
        if (!is_null($location->format_id)){
            $for = Format::select('format')->where('id',$location->format_id)->get()->toArray();
            $current_format = $for[0]['format'];
        }

        return view('locations.edit', [
            'location' => $location,
            'formats' => $formats,
            'current_format' => $current_format
        ]);
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
            'name' => 'required|string',
            'format' => 'required|exists:formats,format',
        ]);

        $f_id = Format::select('id')->where('format',$request->input('format'))->get()->toArray();
        $format_id = $f_id[0]['id'];

        $Location = Location::where('id',$id)->update(([
            'name' => $request->input('name'),
            'item_id' => $request->input('item_id'),
            'format_id' => $format_id,
            'qty' => $request->input('qty'),
        ]));


        return redirect('/locations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Location::find($id);

        $location->delete();
        
        return redirect('/locations');
    }

    public function put($id) {
        $location = Location::find($id);

        return view('locations.put', [
            'location' => $location,
        ]);
    }

    public function putOn(Request $request, $id)
    {
        $request->validate([
		'SKU' => 'required|exists:items,SKU',
		'qty' => 'integer|required|gte:0'
        ]);
	
	$item = Item::select('id')->where('SKU',$request->input('SKU'))->get()->toArray();
        $item_id = $item[0]['id'];

        $Location = Location::where('id',$id)->update(([
		'item_id' => $item_id,
		'qty' => $request->input('qty')
	]));

        return redirect('/locations');
    }

    public function unsetFormat(Request $request, $id)
    {
        $Location = Location::where('id',$id)->update(([
            'format_id' => null,
        ]));


        return redirect('/locations');
    }

    public function search(Request $request, $id){

        $name = $_GET['name'];
        $locations = Location::where('name','LIKE','%.'.$name.'.%');
        $formats = [];
        $items = [];
        $formatqts = [];

        foreach($locations as $location){
            if(!is_null($location->format_id)){
                $format = Format::select('format')->where('id',$location->format_id)->get()->toArray();
                $formats[$location->id] = $format[0]['format'];
                $formatqt = Format::select('capacity')->where('id',$location->format_id)->get()->toArray();
                $formatqts[$location->id] = $formatqt[0]['capacity'];
            } else {
                continue;
            }
            if(!is_null($location->item_id)){
                $item = Item::select('description')->where('id',$location->item_id)->get()->toArray();
                $items[$location->id] = $item[0]['description'];
            }
        }

        return view('locations.index', [
            'locations' => $locations,
            'formats' => $formats,
            'formatqts' => $formatqts,
            'items' => $items
        ]);
    }

}
