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
      if ( count($models) > 0 ) {
        return redirect('/admin/models/new?error=taken')->withInput(Input::all());
        exit();
      } else {
        //calculate number of rows
        for ( $i = 1; $i < 15; $i++ ) {
          $count[$i] = $request->input('count-'.$i);
        }

        for ( $i = 15; $i > 0; $i-- ) {
          if ( empty($count[$i]) ) {
            $this->numRows = $i - 1;
          }
        }

        //set values for fields
        for ( $i = 0; $i < $this->numRows; $i++ ) {
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


        if ( $request->input('api_access') == "on" ) {
          $model->apiAccess = 1;
        } else {
          $model->apiAccess = 0;
        }

        $model->save();

        //create table in data base
        Schema::create($tableName, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('timeStamp');
            for ( $i = 0; $i < $this->numRows; $i++ ) {
              if ( $this->dataType[$i] == "image" ) {
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




}
