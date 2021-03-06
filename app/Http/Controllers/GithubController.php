<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;
use Auth;
use Carbon\Carbon;

class GithubController extends Controller
{
  /**
  * Redirect the user to the GitHub authentication page.
  *
  * @return \Illuminate\Http\Response
  */
 public function redirectToProvider()
 {
     return Socialite::driver('github')->redirect();
 }

 /**
  * Obtain the user information from GitHub.
  *
  * @return \Illuminate\Http\Response
  */
 public function handleProviderCallback()
 {
   //stor information in user varibale
     $user = Socialite::driver('github')->user();

     //if account not created

     if(!User::where('email', $user->getEmail())->exists()){
       User::create([
         'name'=>$user->getNickname(),
         'email'=>$user->getEmail(),
         'password'=> bcrypt('abc@123'),
         'role'=>2,
         'created_at'=>Carbon::now(),

       ]);
     }

     // if account is created then login attempt
       if (Auth::attempt(['email' => $user->getEmail(), 'password' => 'abc@123'])) {
         return redirect('home/customer');
       }
 }
}
