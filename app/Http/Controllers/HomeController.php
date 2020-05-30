<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChangePasswordPost;
use Auth;
use Hash;
use Carbon\Carbon;
Use App\User;
Use App\Order;
use App\Charts\SevenDaysSaleChart;
use App\Charts\PaymentMethodChart;
Use App\FaqForm;
use App\Category;
use App\Http\Requests\Faq_Form_validate;
use App\Mail\ChangePasswordConfirm;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('checkrole')->except(['edit_profile','change_password']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        for ($i=1; $i <=7; $i++) {
          $date[] = Carbon::now()->subDays(7-$i)->format('Y-m-d');

          $sale[] = Order::whereDate('created_at', Carbon::now()->subDays(7-$i)->format('Y-m-d') )->sum('total');

        }


      //chart intregration start
      $seven_days_sale_chart = new SevenDaysSaleChart;
      $seven_days_sale_chart->labels($date);

      $seven_days_sale_chart->dataset('Sale Amount', 'bar', $sale)->options([
        'backgroundColor' =>[

          'red',
          'red',
          'red',
          'red',
          'red',
          'red',
          'red',

        ]
      ]);
      //chart intregration end

      //payment chart start
      $cash_on_delivery = Order::where('payment_method', 1)->count();
      $online_payment = Order::where('payment_method', 2)->count();
      //payment chart end

      //chart intregration start
      $payment_method_chart = new PaymentMethodChart;
      $payment_method_chart->labels(['Cash on Delevery', 'Online Payment']);

      $payment_method_chart->dataset('Payment History', 'bar', [$cash_on_delivery, $online_payment])->options([
        'backgroundColor' =>[

          'blue',
            'green',



        ]
      ]);
      //chart intregration end

      $loged_in_id = Auth::id();
      $user_lists = User::where('id', '!=', $loged_in_id)->orderBy('id', 'desc')->paginate(2);
        return view('cit.user_list', compact('user_lists', 'seven_days_sale_chart', 'payment_method_chart'));
    }

    /*======faq_form page======*/
  public function faq_form()
    {
      $user_info = FaqForm::all();
      return view('cit.faq_form',compact('user_info'));
    }
    public function faq_form_post(Faq_Form_validate $request){
      // $request->validate([
      //   'email' => 'required',
      //   'number'=> 'required'
      // ],
      // [
      //   'email.required'=> 'Please enter your email'
      //   'number.required'=> 'Please enter your number'
      // ]);
      // FaqForm::insert([
      //   'email'=>$request->email,
      //   'number'=>$request->number,
      //   'created_at'=>Carbon::now()
      // ]);
      // return back()->with('status', 'Your data submited successfully!!');

      /*===short code====*/

      FaqForm::insert($request->except('_token') + ['created_at'=>Carbon::now()]);
       return back()->with('status', 'Your data submited successfully!!');
    }

    public function user_list(){
      $loged_in_id = Auth::id();
      $user_lists = User::where('id', '!=', $loged_in_id)->orderBy('id', 'desc')->paginate(2);
      return view('cit.user_list', compact('user_lists'));
    }

    public function faq_form_delete($faq_id){
      FaqForm::find($faq_id)->delete();
      return back()->with('DeleteStatus','Deleted successfully');
    }
    public function faq_form_edit($faq_id){
      $faq_lists = FaqForm::find($faq_id);
      return view('cit.edit_faq', [
        'faq_lists'=> $faq_lists //alternative way of compact
      ]);

    }
    public function faq_form_update(Request $request){
      FaqForm::find($request->faq_id)->update([
        'email'=>$request->email,
        'number'=>$request->number
      ]);
      return redirect('/faq/form');

    }

    public function faq_soft_delete(){
      $trash_lists = FaqForm::onlyTrashed()->get();

      return view('cit.trash', [
        'trash_lists'=>$trash_lists
      ]);
    }
    public function faq_undo($faq_id){
      FaqForm::withTrashed()->where('id', $faq_id)->restore();
      return back();
    }

    public function faq_force_delete($faq_id){
        FaqForm::withTrashed()->where('id', $faq_id)->forceDelete();
        return back();
    }

    public function edit_profile(){
      return view('cit.edit_profile');
    }
    public function change_password(ChangePasswordPost $request){
      if($request->old_password == $request->password){
        return back()->withErrors('Faijlami Koro halar po???');
      }
      else{
        $old_password = $request->old_password;
        $db_password = Auth::user()->password;
        if (Hash::check($old_password, $db_password)) {
          User::find(Auth::id())->update([
            'password'=> Hash::make($request->password)
          ]);
          //email start
          Mail::to(Auth::user()->email)->send(new ChangePasswordConfirm());
          return back()->with('change_password', 'your password changed successfully');
        }
        else{
          return back()->withErrors('Your Old Password is not right!');
        }
      }
    }




}
