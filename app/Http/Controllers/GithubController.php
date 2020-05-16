<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;
use Auth;

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
     $user = Socialite::driver('github')->user();

     $findUser = User::where('email',$user->email)->first();

     if($findUser){
       Auth::login();
       return redirect('/home');
     }
     else{
       User::create([
         'name'=>$user->name,
         'email'=>$user->email

       ]);
       return redirect('/home');
     }

 }
}
