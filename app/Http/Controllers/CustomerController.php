<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function homecustomer(){
      return view('cit.customer.home');
    }
}
