<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StockOut;
use App\StockOutProduct;

class StockOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->get("discount")==''&&$request->get("discount")==NULL) {
            $discount=0;
        }else{
            $discount=$request->get("discount");
        }
        $stockout = new StockOut([
            'discount'=>$discount,
            'grand_total'=>$request->get("grandtotal"),
            'cash'=>$request->get("cash"),
        ]);
        $stockout->save();

        $id = $stockout->id;

        $stockoutproduct = new StockOutProduct;
        $item = array();
        foreach ($request['item'] as $value) {
            $stockoutproduct=[
                                'item_id'=>$value['item_id'],
                                'qty'=>$value['qty'],
                                'stock_out_id'=>$id,
                            ];   
            array_push($item,$stockoutproduct);
        }

        $result = StockOutProduct::insert($item);
        if ($result == 1) {
            $requests = $request->all();
            return $blade=view('Sales.invoice',['items'=>$requests,'invoice_id'=> $id]);
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
