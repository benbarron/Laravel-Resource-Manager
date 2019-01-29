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


class ModelController extends Controller
{
    public $numRows;
    public $dataType;
    public $default;
    public $name;
    public $columnName;
    public $tableName;
    public $modelName;

    public function new()
    {
      return view('admin.new-model');
    }

    public function create(Request $request)
    {
      $this->validate($request, [
          'name' => 'required',

      ]);

      $count = [];

      $tableName = strtolower($request->input('name')).'s';
      $modelName  = $request->input('name');

      $models = Models::where('name', $modelName)->get();

      //make sure we are not duplicating a model that already exists
      if(count($models) > 0){
        return redirect('/admin/models/new?error=taken')->withInput(Input::all());
        exit();
      } else {
        //calculate number of rows
        for($i = 1; $i < 15; $i++){
          $count[$i] = $request->input('count-'.$i);
        }

        for($i = 15; $i > 0; $i--) {
          if(empty($count[$i])) {
            $this->numRows = $i - 1;
          }
        }

        //set values for fields
        for($i = 0; $i < $this->numRows; $i++){
          $this->dataType[$i] = $request->input('data-type-'.$i);
          $this->name[$i] = $request->input('name-'.$i);
          $this->default[$i] = $request->input('default-'.$i);
          if( empty($this->name[$i]) ) {
            return back()->withInput(Input::all())->with('red', 'Check your inputs');
          }
        }


        //set parameters and create model via artisan
        $params = ['name' => $modelName];
        Artisan::call('make:model', $params);

        //store record of model in datebase
        $model = new Models;
        $model->name = $modelName;
        $model->tableName = $tableName;


        if($request->input('api_access') == "on"){
          $model->apiAccess = 1;
        } else {
          $model->apiAccess = 0;
        }

        $model->save();

        //create table in data base
        Schema::create($tableName, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('timeStamp');
            //$table->softDeletes();
            for($i = 0; $i < $this->numRows; $i++){
              if($this->dataType[$i] == "image") {
                $table->string($this->name[$i])->default('image');
              } else {
                $table->{$this->dataType[$i]}($this->name[$i])->default($this->default[$i]);
              }

            }
        });
      }

      return redirect('/admin/models')->with('green', 'Model Was Added');
    }

    public function deleteModel(Request $request)
    {
      $this->validate($request, [
        'tableName' => 'required',
        'modelName' => 'required'
      ]);

      $this->tableName = $request->input('tableName');
      $this->modelName = $request->input('modelName');

      $model = Models::where('name', $this->modelName)->firstOrFail();

      $model->delete();

      Schema::dropIfExists($this->tableName);

      return back()->with('green', 'The '.$this->modelName.' model was successfully deleted');
    }

    public function browseModel($modelName, $tableName)
    {
      $fields = DB::select(DB::raw('SHOW FIELDS FROM '.$tableName));

      $items = DB::table($tableName)->paginate(100);

      $data = array(
        'fields' => $fields,
        'items' => $items,
        'modelName' => $modelName,
        'tableName' => $tableName,
      );

      return view('admin.browse-models', $data);
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


      foreach ($fields as $field){
        if ($field->Field == "timeStamp"){
          $data[$field->Field] = time();
        } else if (strtolower($field->Field) == "author") {
          $data[$field->Field] = Auth::user()->name;
        } else if ($field->Default == "image") {
          if ($request->hasFile($field->Field)) {
            $fileName = time()."_".$request->file($field->Field)->getClientOriginalName();
            $path = $request->file($field->Field)->storeAs('public/uploads', $fileName);
            $data[$field->Field] = $fileName;
          }
        } else {
          $data[$field->Field] = $request->input($field->Field);
        }
        if(empty($data[$field->Field]) && $field->Field != "id" && $field->Type != "tinyint(1)") {
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

      foreach ($fields as $field){
        if ($field->Field == "timeStamp"){
          $data[$field->Field] = time();
        } else if (strtolower($field->Field) == "author") {
          $data[$field->Field] = Auth::user()->name;
        } else if ($field->Default == "image") {
          if ($request->hasFile($field->Field)) {
            $fileName = time()."_".$request->file($field->Field)->getClientOriginalName();
            $path = $request->file($field->Field)->storeAs('public/uploads', $fileName);
            $data[$field->Field] = $fileName;
          }
        } else {
          $data[$field->Field] = $request->input($field->Field);
        }
        if(empty($data[$field->Field]) && $field->Field != "id" && $field->Type != "tinyint(1)" && $field->Default != "image") {
          return back()->withInput(Input::all())->with('red', 'All fields are required');
        }
      }

      $data["id"] = $id;

      DB::table($tableName)->where('id', $id)->update( $data );

      return redirect('/admin/models/browse/'.$modelName.'/'.$tableName)->with('green', 'Your entry in the '.$modelName.' was updated');
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

    public function editModel($modelName, $tableName)
    {
      $fields = DB::select(DB::raw('SHOW FIELDS FROM '.$tableName));

      $model = DB::table('models')->where('tableName', $tableName)->get();

      $data = array(
        'fields' => $fields,
        'tableName' => $tableName,
        'modelName' => $modelName,
        'model' => $model,
      );

      return view('admin.edit-models', $data);
    }

    public function updateModel(Request $request)
    {
      $this->validate($request, [
        'modelName' => 'required',
        'tableName' => 'required',
      ]);

      $tableName = $request->input('tableName');
      $modelName = $request->input('modelName');

      //set values for fields
      $this->dataType = $request->input('data-type-0');
      $this->name = $request->input('name-0');
      $this->default = $request->input('default-0');

      try {
        Schema::table($tableName, function(Blueprint $table){
          if($this->dataType == "image") {
            $table->string($this->name)->default('image');
          } else {
            $table->{$this->dataType}($this->name)->default($this->default);
        }
        });
      } catch (\Illuminate\Database\QueryException $e) {
        return redirect('/admin/models/edit/'.$modelName.'/'.$tableName)->with('red', 'There was an error adding '.$this->name);
      } catch (PDOException $e) {
        return redirect('/admin/models/edit/'.$modelName.'/'.$tableName)->with('red', 'There was an error adding '.$this->name);
      }

    return redirect('/admin/models/edit/'.$modelName.'/'.$tableName)->with('green', $this->name.' was added');
    }

    public function dropColumn(Request $request)
    {
      $this->validate($request, [
        'modelName' => 'required',
        'tableName' => 'required',
        'columnName' => 'required',
      ]);

      $this->modelName = $request->input('modelName');
      $this->tableName = $request->input('tableName');
      $this->columnName = $request->input('columnName');

      Schema::table($this->tableName, function(Blueprint $table){
        $table->dropColumn($this->columnName);
      });

      return back()->with('green', $this->columnName.' was dropped');
    }

    public function apiAccess($tableName, $apiKey)
    {
      if($tableName == "users"){
         abort(404);
      } else {
        $key = "ij1CPywJlRlKgQcqXkDIUsoyg0jejouE";

        $model = DB::table('models')->where('tableName', $tableName)->get();

        if(count($model) == 0){
           abort(404);
        }

        if($apiKey == $key && $model[0]->apiAccess == 1) {
          $data = DB::table($tableName)->get();
          return $data;
        }

        if($apiKey != $key){
          abort(404);
        } else {
          abort(404);
        }
      }
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
          //$arr  = (array) array_merge((array) $arr, (array) $entries);
          $arr = $arr->union($entries);
        }

        //array_push($arr, $entries);
        $i ++;
      }
      return $arr;
    }
}
