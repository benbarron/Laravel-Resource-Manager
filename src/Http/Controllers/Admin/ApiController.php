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

class ModelEntryController extends Controller 
{
		public function __construct()
		{

		}

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