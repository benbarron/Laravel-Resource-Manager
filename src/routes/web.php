<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Routes for the admim package, register your own routes for the
| main pages of your below them.
|
|
*/

Route::get('/', function() {
  return view('home');
});

Route::middleware(['auth', 'IsAdmin'])->prefix('/admin')->group(function(){

  Route::get('/logout/{id}', 'LoginController@logout')->name('logout');

  Route::get('home', 'AdminController@home')->name('home');

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

  Route::get('/images', 'MediaController@index')->name('admin.media');
  Route::post('/images/store', 'MediaController@storeImage')->name('images.store');
  Route::post('/images/delete/{fileName}', 'MediaController@delete')->name('images.delete');
});

Route::get('/models/api/{tableName}/{apiKay}', 'ModelController@apiAccess')->name('model.api');



Route::get('/documentation', function(){

});

Route::prefix('admin')->group(function(){
  Route::get('/login', 'LoginController@showLoginForm')->name('login');
  Route::post('/login', 'LoginController@login')->name('admin.authentication');
});


//Route::get('/', function(){
//  return view('home');
//});
