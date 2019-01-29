<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use App\User;
use Storage;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
      $this->middleware(['auth']);
    }

    public function createUser(Request $request)
    {
      $this->validate($request, [
        'name' => 'required',
        'email' => 'required',
        'password1' => 'required',
        'password2' => 'required'
      ]);

      $name = $request->input('name');
      $email = $request->input('email');
      $password1 = $request->input('password1');
      $password2 = $request->input('password2');

      if($password1 != $password2) {
        return redirect('/admin/new/user?error=password_match')->withInput(Input::all());
      } else {
        $user = User::where('email', $email)->get();
        if(count($user) != 0){
          return redirect('/admin/new/user?error=email_taken')->withInput(Input::all());
        } else {
          $user = new User;
          $user->email = $email;
          $user->name = $name;
          $user->password = Hash::make($password1);
          $user->image = "";
          if($request->input('user_type') == "on"){
            $user->IsAdmin = 1;
          } else {
            $user->IsAdmin = 0;
          }
          $user->save();
        }
      }

      return redirect('/admin/users/all?view=all')->with('green', 'User Created');
    }

    public function updateUser(Request $request)
    {
      $this->validate($request, [
        'email' => 'required',
        'name' => 'required',
      ]);

      $oldEmail = Auth::user()->email;
      $email = $request->input('email');

      $oldName = Auth::user()->name;
      $name = $request->input('name');

      $oldPassword = $request->input('oldPassword');
      $password1 = $request->input('password1');
      $password2 = $request->input('password2');


      $user = Auth::user();

      if($name != $oldName){
        $user->name = $name;
      }


      if($email != $oldEmail){
        $user->email = $email;
      }

      if($request->hasFile('image')) {
        if(!empty($user->image)) {
          $path = Storage::delete('public/profile_images/'.$user->image);
        }

        $fileName = time()."_".$request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('public/profile_images', $fileName);
        $user->image = $fileName;
      }

      $user->save();

      if(!empty($oldPassword) && !empty($password1) && !empty($password1)) {
        if($password1 == $password2){
          if (Hash::check($oldPassword, Auth::user()->password)) {
            $user->password = Hash::make($password1);
          } else{
            return back()->with('yellow', 'The password you entered did not match our records');
          }
        } else {
          return back()->with('red', 'Your password and password verification did not match');
        }
      }

      $user->save();

      return redirect('/admin/profile')->with('green', 'Profile Successfull Updated');
    }
}
