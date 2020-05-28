<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use Auth;
Use App\Order;
Use App\Order_list;
Use App\Product;
Use App\Cart;
use Carbon\Carbon;
class StripePaymentController extends Controller
{

   public function stripe()
   {
       return view('stripe');
   }


   public function stripePost(Request $request)
   {
       Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
       Stripe\Charge::create ([
               "amount" => $request->total * 100,
               "currency" => "usd",
               "source" => $request->stripeToken,
               "description" => "Test Amount From Newton"
       ]);
       //insert in order table start

       $order_id = Order::insertGetId([
         'user_id' => Auth::id(),
         'full_name' => $request->full_name,
         'email_address' => $request->email_address,
         'phone_number' => $request->phone_number,
         'country_id' => $request->country_id,
         'city_id' => $request->city_id,
         'address' => $request->address,
         'note' =>$request->note ,
         'sub_total' =>$request->sub_total ,
         'total' => $request->total,
         'coupon_name' => $request->coupon_name,
         'payment_method' => 2,
         'paid_status' => 2,
         'created_at' => Carbon::now()
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
}
