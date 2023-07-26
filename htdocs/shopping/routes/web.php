<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', 'AdminController@loginAdmin')->name('login');
Route::post('/login','AdminController@postLoginAdmin')->name('login');
Route::get('/logout','AdminController@logoutAdmin')->name('logout');
Route::get('/home','AdminController@home')->name('home');
Route::get('/register','AdminController@registerAdmin')->name('register');
Route::post('/register','AdminController@registerUser')->name('register');

//admin
Route::prefix('admin')->group(function (){
    Route::prefix('categories') ->group(function (){
        Route::get('/',[
            'as'=>'categories.index',
            'uses'=>'categoryController@index',
            'middleware' => 'can:category-list'
        ]);
        Route::get('/create',[
            'as'=>'categories.create',
            'uses'=>'CategoryController@create',
            'middleware' => 'can:category-add'
        ]);
        Route::post('/store',[
            'as'=>'categories.store',
            'uses'=>'CategoryController@store',
        ]);
        Route::get('/edit/{id}',[
            'as'=>'categories.edit',
            'uses'=>'CategoryController@edit',
            'middleware' => 'can:category-edit'
        ]);
        Route::post('/update/{id}',[
            'as'=>'categories.update',
            'uses'=>'CategoryController@update'
        ]);
        Route::get('/delete/{id}',[
            'as'=>'categories.delete',
            'uses'=>'CategoryController@delete',
            'middleware' => 'can:category-delete'
        ]);
    });
    //menus
    Route::prefix('menus') ->group(function (){
        Route::get('/',[
            'as'=>'menus.index',
            'uses'=>'MenuController@index',
            'middleware' => 'can:menu-list'
        ]);
        Route::get('create',[
            'as'=>'menus.create',
            'uses'=>'MenuController@create'
        ]);
        Route::post('store',[
            'as'=>'menus.store',
            'uses'=>'MenuController@store'
        ]);
        Route::get('edit,{id}',[
            'as' => 'menus.edit',
            'uses'=>'MenuController@edit'
        ]);
        Route::post('/update,{id}',[
            'as'=>'menus.update',
            'uses'=>'MenuController@update'
        ]);
        Route::get('/delete,{id}',[
            'as'=>'menus.delete',
            'uses'=>'MenuController@delete'
        ]);
    });
    //slider
    Route::prefix('slider')->group(function (){
        route::get('/',[
            'as' => 'sliders.index',
            'uses' => 'SliderAdminController@index'
        ]);
        route::get('/create',[
            'as' => 'sliders.create',
            'uses' => 'SliderAdminController@create'
        ]);
        route::post('/store',[
            'as' => 'sliders.store',
            'uses' => 'SliderAdminController@store'
        ]);
        route::get('/edit,{id}',[
            'as' => 'sliders.edit',
            'uses' => 'SliderAdminController@edit'
        ]);
        route::post('/update,{id}',[
            'as' => 'sliders.update',
            'uses' => 'SliderAdminController@update'
        ]);
        route::get('/delete,{id}',[
            'as' => 'sliders.delete',
            'uses' => 'SliderAdminController@delete'
        ]);
    });
    //settings
    Route::prefix('settings')->group(function () {
        route::get('/', [
            'as' => 'settings.index',
            'uses' => 'AdminSettingController@index'
        ]);
        route::get('create', [
            'as' => 'settings.create',
            'uses' => 'AdminSettingController@create'
        ]);
        route::post('store', [
            'as' => 'settings.store',
            'uses' => 'AdminSettingController@store'
        ]);
        route::get('/edit,{id}', [
            'as' => 'settings.edit',
            'uses' => 'AdminSettingController@edit'
        ]);
        route::post('/update,{id}', [
            'as' => 'settings.update',
            'uses' => 'AdminSettingController@update'
        ]);
        route::get('/delete,{id}', [
            'as' => 'settings.delete',
            'uses' => 'AdminSettingController@delete'
        ]);
    });
    //user
    Route::prefix('users')->group(function () {
        route::get('/', [
            'as' => 'users.index',
            'uses' => 'AdminUserController@index'
        ]);
        route::get('/create', [
            'as' => 'users.create',
            'uses' => 'AdminUserController@create'
        ]);
        route::post('/store', [
            'as' => 'users.store',
            'uses' => 'AdminUserController@store'
        ]);
        route::get('/edit,{id}', [
            'as' => 'users.edit',
            'uses' => 'AdminUserController@edit'
        ]);
        route::post('/update,{id}', [
            'as' => 'users.update',
            'uses' => 'AdminUserController@update'
        ]);
        route::get('/delete,{id}', [
            'as' => 'users.delete',
            'uses' => 'AdminUserController@delete'
        ]);
    });
    //
    Route::prefix('roles')->group(function () {
        route::get('/', [
            'as' => 'roles.index',
            'uses' => 'AdminRolesController@index'
        ]);
        route::get('/create', [
            'as' => 'roles.create',
            'uses' => 'AdminRolesController@create'
        ]);
        route::post('/store', [
            'as' => 'roles.store',
            'uses' => 'AdminRolesController@store'
        ]);
        route::get('/edit,{id}', [
            'as' => 'roles.edit',
            'uses' => 'AdminRolesController@edit'
        ]);
        route::post('/update,{id}',[
            'as' => 'roles.update',
            'uses' => 'AdminRolesController@update'
        ]);
        route::get('/delete,{id}',[
            'as' => 'roles.delete',
            'uses' => 'AdminRolesController@delete'
        ]);
    });
    Route::prefix('permissions')->group(function () {
        route::get('/create', [
            'as' => 'permissions.create',
            'uses' => 'AdminPermissionController@createPermissions'
        ]);
        route::post('/store', [
            'as' => 'permissions.store',
            'uses' => 'AdminPermissionController@store'
        ]);
    });
});


