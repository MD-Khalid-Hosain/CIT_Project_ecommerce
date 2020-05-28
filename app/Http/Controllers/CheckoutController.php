<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Order_list;
use App\Product;
use App\City;
use App\Country;
use Auth;
use App\Cart;
use Carbon\Carbon;
class CheckoutController extends Controller
{
    function __construct()
  {
      $this->middleware('auth');
    }
    function index(Request $request){
      return view('cit.frontend.checkout',[
        'total_from_cart' => $request->total_from_cart,
        'coupon_name_from_cart' => $request->coupon_name_from_cart,
        'countries' => Country::all()
      ]);
    }
    function checkoutpost(Request $request){
      if($request->payment_method == 1){
        //insert in order table start
        $order_id = Order::insertGetId($request->except('_token')+[
              'user_id' => Auth::id(),
              'created_at' =>Carbon::now()
          ]);
            //insert in order table end

            //insert in order_list table start

          foreach (cart_product_show() as $cart_product) {

            Order_list::insert([
              'user_id' => Auth::id(),
              'order_id' => $order_id,
              'product_id' => $cart_product->product_id,
              'amount' => $cart_product->amount,
              'created_at' => Carbon::now()
            ]);
              //insert in order_list table end

              //decrement from product table start
            Product::find($cart_product->product_id)->decrement('quantity',$cart_product->amount);
            //decrement from product table end
            
            //delete from cart table
            Cart::find($cart_product->id)->delete();
          }
          return redirect('/');
      }
      else{

        return view('cit.frontend.online_payment',[
          'full_name' =>$request->full_name,
          'email_address' =>$request->email_address,
          'phone_number' =>$request->phone_number,
          'country_id' =>$request->country_id,
          'city_id' =>$request->city_id,
          'address' =>$request->address,
          'note' =>$request->note,
          'sub_total' =>$request->sub_total,
          'total' =>$request->total,
          'coupon_name' =>$request->coupon_name
        ]);
      }


    }



    function get_city_list(Request $request){
      // echo $request->country_id;
      $dropdown_to_send = "";

      $cities =  City::where('country_id', $request->country_id)->get();
      foreach ($cities as $city) {
        $dropdown_to_send .="<option value='".$city->id."'>".$city->city_name."</option>";
        // echo $city->city_name;
      }
      echo $dropdown_to_send;
    }
}
