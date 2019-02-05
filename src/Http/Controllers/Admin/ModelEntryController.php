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

    public function modelEntry($modelName, $tableName)
    {
      $fields = DB::select(DB::raw('SHOW FIELDS FROM '.$tableName));

      $items = DB::table($tableName)->get();

      $data = array(
        'fields' => $fields,
        'modelName' => $modelName,
        'tableName' => $tableName,
      );

      return view('admin.model-entry', $data);
    }

    public function storeModelEntry(Request $request, $modelName, $tableName)
    {
      $fields = DB::select(DB::raw('SHOW FIELDS FROM '.$tableName));


      foreach ( $fields as $field ) {
        if ( $field->Field == "timeStamp" ){
          $data[$field->Field] = time();
        } else if ( strtolower($field->Field) == "author" ) {
          $data[$field->Field] = Auth::user()->name;
        } else if ($field->Default == "image") {
          if ( $request->hasFile($field->Field) ) {
            $fileName = time()."_".$request->file($field->Field)->getClientOriginalName();
            $path = $request->file($field->Field)->storeAs('public/uploads', $fileName);
            $data[$field->Field] = $fileName;
          }
        } else {
          $data[$field->Field] = $request->input($field->Field);
        }
        if ( empty($data[$field->Field]) && $field->Field != "id" && $field->Type != "tinyint(1)" ) {
          return back()->withInput(Input::all())->with('red', 'All fields are required');
        }
      }

      DB::table($tableName)->insert([ $data ]);

      return redirect('/admin/models/browse/'.$modelName.'/'.$tableName)
              ->with('green', 'Your entry in the '.$modelName.' model was successful');
    }

    public function editModelEntry($modelName, $tableName, $id)
    {
      $fields = DB::select(DB::raw('SHOW FIELDS FROM '.$tableName));

      $content = DB::table($tableName)->find($id);

      $data = array(
        'fields' => $fields,
        'modelName' => $modelName,
        'tableName' => $tableName,
        'content' => $content,
        'id' => $id,
      );
      return view('admin.edit-model-entry', $data);
    }

    public function updateModelEntry(Request $request, $modelName, $tableName, $id)
    {
      $fields = DB::select(DB::raw('SHOW FIELDS FROM '.$tableName));

      $id = $request->input('entry-id');

      foreach ( $fields as $field ) {
        if ( $field->Field == "timeStamp" ) {
          $data[$field->Field] = time();
        } else if ( strtolower($field->Field) == "author" ) {
          $data[$field->Field] = Auth::user()->name;
        } else if ( $field->Default == "image" ) {
          if ( $request->hasFile($field->Field) ) {
            $fileName = time()."_".$request->file($field->Field)->getClientOriginalName();
            $path = $request->file($field->Field)->storeAs('public/uploads', $fileName);
            $data[$field->Field] = $fileName;
          }
        } else {
          $data[$field->Field] = $request->input($field->Field);
        }
        if ( empty($data[$field->Field]) && $field->Field != "id" && $field->Type != "tinyint(1)" && $field->Default != "image") {
          return back()->withInput(Input::all())->with('red', 'All fields are required');
        }
      }

      $data["id"] = $id;

      DB::table($tableName)->where('id', $id)->update( $data );

      return redirect('/admin/models/browse/'.$modelName.'/'.$tableName)
      				->with('green', 'Your entry in the '.$modelName.' was updated');
    }

    public function deleteModelEntry(Request $request, $modelName, $tableName)
    {
      $this->validate($request, [
        'id' => 'required'
      ]);

      $id = $request->input('id');

      $item = DB::table($tableName)->where('id', $id)->delete();

      return back()->with('green', 'Entry in the '.$modelName.' was successfully deleted');

    }
}