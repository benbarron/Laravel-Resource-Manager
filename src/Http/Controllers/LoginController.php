<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\Input;


class LoginController extends Controller
{
    public function __construct()
    {

    }

    public function showLoginForm()
    {
      if(Auth::check()){
        return redirect('/admin/home');
      }
      return view('admin.login');
    }

    public function login(Request $request)
    {
      $this->validate($request, [
        'email' => 'required',
        'password' => 'required',
      ]);

      $password = $request->input('password');
      $email = $request->input('email');

      $user = User::where('email', $email)->get();

      if(count($user) == 1 && $user[0]->IsAdmin == 1) {
        $hashedPassword = $user[0]->password;
        if (Hash::check($password, $hashedPassword)) {
          Auth::login($user[0]);
          return redirect('/admin/home');

        } else {
          return redirect('/admin/login?error=credintials')->withInput(Input::all());
        }
      } else {
        return redirect('/admin/login?error=credintials')->withInput(Input::all());
      }
    }

    public function logout($id)
    {
      if($id =! Auth::user()->id){
        return back();
      } else {
        Auth::logout(Auth::user());
        return redirect('/admin/login');
      }
    }
}
