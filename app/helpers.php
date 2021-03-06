<?php
function cart_total_product(){
  echo App\Cart::where('ip_address', request()->ip())->count();
}
function cart_product_show(){
  return App\Cart::where('ip_address', request()->ip())->get();
}
function cart_subtotal(){
  $total_price = 0;
  foreach (cart_product_show() as $cart_product) {
    $total_price = $total_price + ($cart_product->amount * App\Product::find($cart_product->product_id)->product_price);
  }
  return $total_price;
}

function review_star($product_id){
  $count = App\Order_list::where('product_id', $product_id)->whereNotNull('star')->count();
if (empty($count)) {
  return 0;
}
else{

  $star_amount = (App\Order_list::where('product_id', $product_id)->whereNotNull('star')->sum('star'))/(App\Order_list::where('product_id', $product_id)->whereNotNull('star')->count());
  return floor($star_amount);
  }
}
