<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemsController extends Controller
{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
   	public function index()
    {
        $item= new Item();
     	$item=$item->where('is_itemset','==',0)->get();
        return response()->json($item);
    }

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
    public function create()
    {
       return view('Item.item');
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
                'name'=>'required',
                'price'=>'required',
        ]);
        $item=new Item([
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'is_itemset'=>'0',
        ]);
        $result=$item->save();
        return json_encode($result);
    }

	/**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
    public function show($id)
    {
        $item=Item::find($id);
        return json_encode($item);
    }

	 /**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
    public function edit($id){
       $item = Item::find($id);
       return response()->json($item);
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
        $item=([
            'name' => $request->get('name'),
            'price' => $request->get('price'),
        ]);
        $result = Item::where('id',$id)->update($item);
        return json_encode($result);
    }

	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
    public function destroy($id)
    {
        $item=Item::find($id);
        $result = $item->delete();
        return json_encode($result);
    }
    
    public function autocomplete(Request $request)
    {
    	$item= new Item();

    	if ($request->get('q') != '' && $request->get('q') != NULL) {
		  	$item = $item->where('name', 'like', '%'.$request->get('q').'%')->get();
    	}else{
    		$item = $item->all();
    	}
    	
        return response()->json($item);
    }
}
