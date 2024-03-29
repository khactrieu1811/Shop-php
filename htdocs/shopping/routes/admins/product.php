<?php
//product
Route::prefix('product')->group(function (){
Route::get('/',[
'as'=>'products.index',
'uses'=>'AdminProductController@index',
'middleware' => 'can:product-list'
]);
Route::get('/create',[
'as'=>'products.create',
'uses'=>'AdminProductController@create',
'middleware' => 'can:product-add'
]);
Route::post('/store',[
'as'=>'products.store',
'uses'=>'AdminProductController@store'
]);
Route::get('/edit,{id}',[
'as'=>'products.edit',
'uses'=>'AdminProductController@edit',
'middleware' => 'can:product-edit,id'
]);
Route::post('/update,{id}',[
'as'=>'products.update',
'uses'=>'AdminProductController@update'
]);
Route::get('/delete,{id}',[
'as'=>'products.delete',
'uses'=>'AdminProductController@delete'
]);
});
