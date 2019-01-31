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
Route::get('/admin/login', 'Admin\LoginController@showLoginForm')->name('login');
Route::post('/admin/login', 'Admin\LoginController@login')->name('admin.authenticate');

//admin routes
Route::middleware(['auth', 'IsAdmin'])->prefix('/admin')->group(function(){

  Route::get('/logout/{id}', 'Admin\LoginController@logout')->name('logout');

  Route::get('/home', 'Admin\AdminController@home')->name('home');

  Route::get('/models', 'Admin\AdminController@models')->name('admin.models');

  Route::get('/models/new', 'Admin\ModelController@new')->name('model.new');
  Route::post('/create/model', 'Admin\ModelController@create')->name('model.create');

  Route::get('/profile', 'Admin\AdminController@profile')->name('profile');

  Route::post('/profile/update', 'Admin\UserController@updateUser')->name('profile.update');

  Route::get('/users/{criteria}', 'Admin\AdminController@users')->name('admin.users');
  Route::get('/new/user', 'Admin\AdminController@showNewUserForm')->name('newUser');
  Route::post('/create/user', 'Admin\UserController@createUser')->name('create.user');

  Route::get('/models/browse/{modelName}/{tableName}', 'Admin\ModelController@browseModel')->name('model.browse');
  Route::get('/models/edit/{modelName}/{tableName}', 'Admin\ModelController@editModel')->name('model.browse');
  Route::post('/models/update', 'Admin\ModelController@updateModel')->name('model.update');
  Route::post('/models/drop/column', 'Admin\ModelController@dropColumn')->name('model.drop');
  Route::post('/models/delete', 'Admin\ModelController@deleteModel')->name('model.delete');

  Route::get('/models/new-entry/{modelName}/{tableName}', 'Admin\ModelController@modelEntry')->name('model.entry');
  Route::post('/models/store/entry/{modelName}/{tableName}', 'Admin\ModelController@storeModelEntry')->name('model.store');

  Route::get('/models/edit/entry/{modelName}/{tableName}/{id}', 'Admin\ModelController@editModelEntry')->name('model.edit-entry');

  Route::post('/models/update/entry/{modelName}/{tableName}/{id}', 'Admin\ModelController@updateModelEntry')->name('model.update');

  Route::post('/models/delete/entry/{modelName}/{tableName}', 'Admin\ModelController@deleteModelEntry')->name('model.delete');

  Route::post('/models/enable/api-access/{modleName}/{tableName}', 'Admin\ModelController@enableApiAccess')->name('model.api.enable');
  Route::post('/models/disable/api-access/{modleName}/{tableName}', 'Admin\ModelController@disableApiAccess')->name('model.api.disable');

  Route::get('/media', 'Admin\MediaController@index')->name('admin.media');
  Route::post('/images/store', 'Admin\MediaController@storeImage')->name('images.store');
  Route::post('/images/delete/{fileName}', 'Admin\MediaController@deleteImage')->name('images.delete');




  Route::get('/documentation', function(){

  });

  //---------------------------------------------
  Route::get('/gen-users', 'UserController@genUsers')->name('gen.users');
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



Route::get('/models/api/{tableName}/{apiKay}', 'Admin\ModelController@apiAccess')->name('model.api');

Route::middleware(['auth', 'IsAdmin'])->group(function () {
  Route::get('/global-search/api/users/{filter}', 'Admin\ModelController@globalSearchUsers')->name('global.search.users');
  Route::get('/global-search/api/models/{filter}', 'Admin\ModelController@globalSearchModels')->name('global.search.models');
  Route::get('/global-search/api/entries/{filter}', 'Admin\ModelController@globalSearchEntries')->name('global.search.entries'); 
});


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

