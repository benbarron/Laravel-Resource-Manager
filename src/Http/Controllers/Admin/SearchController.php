<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use DB;
use App\Models;
use Storage;
use Auth;

class SearchController extends Controller 
{


    public function globalSearchUsers($filter)
    {
      $users = DB::table('users')->select('name', 'email')
                                 ->where('name', 'like', "%$filter%")
                                 ->orWhere('email', 'like', "%$filter%")->get();
      return $users;
    }

    public function globalSearchModels($filter)
    {
      $models = DB::table('models')->where('name', 'like', "%$filter%")
                                   ->orWhere('tableName', 'like', "%$filter%")->get();
      return $models;
    }

    public function globalSearchEntries($filter)
    {
      $tables = DB::table('models')->select('tableName', 'name')->get();

      $arr = [];
      $i = 0;
      foreach ($tables as $table) {
        $entries = DB::table($table->tableName)->where('title', 'like' , "%$filter%")->get();
        if ( count ( $entries ) > 0 ) {
          $return = $i;
          foreach ($entries as $entrie) {
            $entrie->tableName = $table->tableName;
            $entrie->modelName = $table->name;
          }
        }
        if ( $i == 0 ) {
          $arr = $entries;
        } else {
          $arr = $arr->union($entries);
        }
        $i ++;
      }
      return $arr;
    }


}