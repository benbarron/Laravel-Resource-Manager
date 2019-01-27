<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| -login routes
|    
| -admin routes
|    - logout
|    - models
|    - profile
|    - users
|    - model entries
|    - model api access 
|    - media / images
|    - documentation
|    
| -api access routes
|    
| -register your own routes
|
|
*/

//login routes
Route::get('/admin/login', 'LoginController@showLoginForm')->name('login');
Route::post('/admin/login', 'LoginController@login')->name('admin.authenticate');

//admin routes
Route::middleware(['auth', 'IsAdmin'])->prefix('/admin')->group(function(){

  Route::get('/logout/{id}', 'LoginController@logout')->name('logout');

  Route::get('/home', 'AdminController@home')->name('home');

  Route::get('/models', 'AdminController@models')->name('admin.models');

  Route::get('/models/new', 'ModelController@new')->name('model.new');
  Route::post('/create/model', 'ModelController@create')->name('model.create');

  Route::get('/profile', 'AdminController@profile')->name('profile');

  Route::post('/profile/update', 'UserController@updateUser')->name('profile.update');

  Route::get('/users/{criteria}', 'AdminController@users')->name('admin.users');
  Route::get('/new/user', 'AdminController@showNewUserForm')->name('newUser');
  Route::post('/create/user', 'UserController@createUser')->name('create.user');

  Route::get('/models/browse/{modelName}/{tableName}', 'ModelController@browseModel')->name('model.browse');
  Route::get('/models/edit/{modelName}/{tableName}', 'ModelController@editModel')->name('model.browse');
  Route::post('/models/update', 'ModelController@updateModel')->name('model.update');
  Route::post('/models/drop/column', 'ModelController@dropColumn')->name('model.drop');
  Route::post('/models/delete', 'ModelController@deleteModel')->name('model.delete');

  Route::get('/models/new-entry/{modelName}/{tableName}', 'ModelController@modelEntry')->name('model.entry');
  Route::post('/models/store/entry/{modelName}/{tableName}', 'ModelController@storeModelEntry')->name('model.store');

  Route::get('/models/edit/entry/{modelName}/{tableName}/{id}', 'ModelController@editModelEntry')->name('model.edit-entry');

  Route::post('/models/update/entry/{modelName}/{tableName}/{id}', 'ModelController@updateModelEntry')->name('model.update');

  Route::post('/models/delete/entry/{modelName}/{tableName}', 'ModelController@deleteModelEntry')->name('model.delete');

  Route::post('/models/enable/api-access/{modleName}/{tableName}', 'ModelController@enableApiAccess')->name('model.api.enable');
  Route::post('/models/disable/api-access/{modleName}/{tableName}', 'ModelController@disableApiAccess')->name('model.api.disable');

  Route::get('/images/{dir}/{prev_dir}', 'MediaController@index')->name('admin.media');
  Route::post('/images/store', 'MediaController@storeImage')->name('images.store');
  Route::post('/images/delete/{fileName}', 'MediaController@deleteImage')->name('images.delete');

  Route::post('/media/add/folder', 'MediaController@addFolder')->name('admin.add.folder');
  Route::post('/media/delete/folder/{id}', 'MediaController@deleteFolder');


  Route::get('/documentation', function(){

  });
});
/*
|--------------------------------------------------------------------------
| Api Key and access route
|--------------------------------------------------------------------------
|
| ij1CPywJlRlKgQcqXkDIUsoyg0jejouE
|
|
*/



Route::get('/models/api/{tableName}/{apiKay}', 'ModelController@apiAccess')->name('model.api');


/*
|--------------------------------------------------------------------------
| Register your routes here
|--------------------------------------------------------------------------
|
| 
|
|
*/

//
Route::get('/', function() {
  return redirect('/admin/login');
});