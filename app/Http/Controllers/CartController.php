<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Cart;
use App\Coupon;
use DB;
class CartController extends Controller
{
  function cart($coupon_name = "" ){
  if ($coupon_name) {
    if(Coupon::where('coupon_name', $coupon_name)->exists()){
      if (Coupon::where('coupon_name', $coupon_name)->first()->validity_till >= Carbon::now()->format('Y-m-d')) {
        $coupon_discount =  Coupon::where('coupon_name', $coupon_name)->first()->coupon_discount;

          return view('cit.frontend.cart',[
            'coupon_name' => $coupon_name,
            'coupon_discount' =>$coupon_discount
          ]);
      }
      else{

        return redirect('cart')->withErrors('validity date over');
      }


    }
    else {

      return redirect('cart')->withErrors('you given invalid coupon');
    }
  }
  return view('cit.frontend.cart');

   }

    public function addtocart(Request $request){

      if(Cart::where('ip_address', $request->ip())->where('product_id', $request->product_id)->exists()){
        Cart::where('ip_address', $request->ip())->where('product_id', $request->product_id)->increment('amount', $request->amount);
      }
      else{
        DB::table('carts')->insert([
          'ip_address' => $request->ip(),
          'product_id' => $request->product_id,
          'amount' => $request->amount,
          'created_at' => Carbon::now()
        ]);
      }

      return back()->with('cart_status', 'Product added to cart !!');
    }

    function delete_from_cart($cart_id){
      Cart::find($cart_id)->delete();
      return back();
    }




    function update_cart(Request $request){
      foreach ($request->cart_id as $key => $id) {
        Cart::find($id)->update([
          'amount' => $request->cart_quantity[$key]
        ]);

      }
      return back();

    }
}
