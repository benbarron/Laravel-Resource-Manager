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
	    public function enableApiAccess($modelName, $tableName)
    {
      $model = DB::table('models')->where('name', $modelName)->update([ 'apiAccess' => 1 ]);

      return back()->with('green', 'Api Access has been added to this model');
    }

    public function disableApiAccess($modelName, $tableName)
    {
      $model = DB::table('models')->where('name', $modelName)->update([ 'apiAccess' => 0 ]);

      return back()->with('green', 'Api Access has been removed from this model');
    }

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

    public function apiAccess($tableName, $apiKey)
    {
      if ( $tableName == "users" ) {
         abort(404);
      } else {
        $key = "ij1CPywJlRlKgQcqXkDIUsoyg0jejouE";

        $model = DB::table('models')->where('tableName', $tableName)->get();

        if ( count($model) == 0 ) {
           abort(404);
        }

        if ( $apiKey == $key && $model[0]->apiAccess == 1 ) {
          $data = DB::table($tableName)->get();
          return $data;
        }
      }
    }
}