<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Order_list;
use Auth;
use PDF;
use Carbon\Carbon;
class CustomerController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('verified');
      $this->middleware('checkrolecustomer');
  }
    function homecustomer(){
      $customer_orders = Order::where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(4);
      return view('cit.customer.home', compact('customer_orders'));
    }
    function order_download($order_id){
      $order_info =  Order::findOrFail($order_id);
      $get_product_details = Order_list::where('order_id',$order_id)->get();

      foreach ($get_product_details as $get_product_name) {
        $get_porduct_id = $get_product_name->product_id;
        $get_porduct_amount = $get_product_name->amount;
      }

      $order_pdf = PDF::loadView('cit.customer.customer_invoice_pdf', compact('order_info','get_porduct_id','get_porduct_amount'))->setPaper('a4', 'portrait');
      $invoice_name = "Order-".$order_info->id."-".Carbon::now()->format('d-m-Y').".pdf";
       return $order_pdf->download($invoice_name);
    }
    function sendsms($order_id){
      $order_info =  Order::findOrFail($order_id);
      // $order_info->phone_number
      // $order_info->id
      // $order_info->total
      $url = "http://66.45.237.70/api.php";
      $number="$order_info->phone_number";
      $text="Hello, Your Order ID: ".$order_info->id.". Total Payment Done: ".$order_info->total;
      $data= array(
      'username'=>"01762501345",
      'password'=>"4SFZEG75",
      'number'=>"$number",
      'message'=>"$text"
      );

      $ch = curl_init(); // Initialize cURL
      curl_setopt($ch, CURLOPT_URL,$url);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $smsresult = curl_exec($ch);
      $p = explode("|",$smsresult);
      $sendstatus = $p[0];
      if($sendstatus == 1101){
        echo "Your sms send successfully !!";
      }
    }
    function add_review(Request $request){
    $order_list = Order_list::where('user_id', Auth::id())->where('product_id', $request->product_id)->whereNull('review')->first();
    $order_list->review = $request->review;
    $order_list->star = $request->star;
    $order_list->save();
      return back();
    }
}
