<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_thumbnail_photo'];

    function connect_to_category_table(){
      return $this->belongsTo('App\Category', 'category_id');
    }
    function get_multiple_photo(){
      return $this->hasMany('App\Product_multiple_photo', 'product_id', 'id');
    }
}
