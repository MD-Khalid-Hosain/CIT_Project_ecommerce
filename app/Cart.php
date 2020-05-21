<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    function relationWithProductTable(){
      return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
