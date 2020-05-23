<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  protected $fillable = ['amount'];
    function relationWithProductTable(){
      return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
