<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\StockOut;
use App\StockOutProduct;
use Validator;

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
        $stockout = new StockOut([
            'discount'=>$request->get("discount"),
            'grand_total'=>$request->get("grandtotal"),
            'cash'=>$request->get("cash"),
            'invoice_name'=>$request->get("invoice_name"),
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
            $set_all_data = array();

            $requests = $request->all();

            foreach ($requests['item'] as $value) {
                if ($value['is_itemset'] == 1) {
                    $setitem_name = DB::table('itemssets__items')
                        ->leftJoin('items', 'itemssets__items.item_id', '=', 'items.id')
                        ->where('set_id',$value['item_id'])
                        ->get();
                }else{
                    $setitem_name= '0';
                }

                $setitem_arr = [
                    'set_item'=>$setitem_name,
                    'item'=>$value,
                ];
                array_push($set_all_data, $setitem_arr);
            }

            $item_total[] =[
                'grandtotal' => $requests['grandtotal'],
                'subtotal' => $requests['subtotal'],
                'discount'=>$requests['discount'],
                'cash'=>$requests['cash'],
            ];

            return $blade=view('Sales.invoice',['set_all_data'=>$set_all_data,'charges'=>$item_total,'invoice_id'=> $id]);
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
