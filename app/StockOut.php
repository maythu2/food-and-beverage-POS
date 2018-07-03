<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    protected $table="stock_outs";
    protected $fillable = ['invoice_name','grand_total','discount', 'cash'];
    
}
