<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\User;
Use App\FaqForm;
use Auth;
use Carbon\Carbon;
use App\Category;
use App\Product;
use App\Http\Requests\Faq_Form_validate;
class FrontendController extends Controller
{

  public function __construct(){
    $this->middleware('auth');
    $this->middleware('verified');
  }
  /*======Welcome page======*/
  function index()
    {
      return view('cit.frontend.index', [
        'categories' => Category::all(),
        'products' => Product::all()
      ]);
    }

  function contact(){
    return view('cit.frontend.contact');
  }
  function about(){
    return view('cit.frontend.about');
  }
  function faq(){
    return view('cit.frontend.faq', [
      'faqs' =>FaqForm::all()
    ]);
  }

}
