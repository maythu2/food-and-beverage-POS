<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Item;
use App\Itemssets_Items;

class ItemSetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = DB::table('items')->where('is_itemset', '0')->get();
      
        return response()->json($item);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('Item.set');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Item([
            'name'=>$request->get('name'),
            'price'=>$request->get('price'),
            'is_itemset'=>'1',
        ]);
        $item->save();

        $set_id = $item->id;

        $itemset_items = new Itemssets_Items;
        $itemset = array();
        foreach ($request['check_id'] as $value) {
            $id = (int)substr($value,0,1);
            $itemset_items = [
                'item_id'=>$id,
                'set_id'=>$set_id,
            ];
            array_push($itemset, $itemset_items);
        }
        $result = Itemssets_Items::insert($itemset);
        if ($result == 1) {
            $requests = $request->all();
            return $blade=view('Item.setlist',['set_items'=>$requests,'item_id'=> $id]);
        }
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
