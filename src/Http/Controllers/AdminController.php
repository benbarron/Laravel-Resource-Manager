<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;
use App\Models;

class AdminController extends Controller
{
    public function __construct()
    {
      //$this->middleware(['']);
    }

    public function home()
    {
      return view('admin.home');
    }

    public function profile()
    {
      $user = Auth::user();
      return view('admin.profile')->with('user', $user);
    }

    public function models()
    {
      $models = Models::paginate(15);
      return view('admin.models')->with('models', $models);
    }

    public function users($criteria)
    {
      $pag = 3;

      if($criteria == "all"){
        $users = User::paginate($pag);
      } else if ($criteria == "admins"){
        $users = User::where('IsAdmin', '1')->paginate($pag);
      } else if($criteria == "non-admins"){
        $users = User::where('IsAdmin', '0')->paginate($pag);
      } else {
        abort(404);
      }

      return view('admin.users')->with('users', $users);
    }

    public function showNewUserForm()
    {
      return view('admin.new-user');
    }
}
