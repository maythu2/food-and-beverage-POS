<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itemssets_Items extends Model
{
    protected $table="itemssets__items";
    protected $fillable = ['item_id','set_id'];
}
