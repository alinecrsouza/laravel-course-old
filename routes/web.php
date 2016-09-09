<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

//with 'match' we can use more the one HTTP verb
//Route::match(['get', 'post'], '/example2', function(){
//    return "oi";
//});

//'any' accepts any HTTP verb
//Route::any('/example', function(){});

//everytime it finds an 'id' as a parameter, it applies this constraint
//this eliminate the need of '->where('id', '[0-9]+')' 
Route::pattern('id', '[0-9]+');

//*** learning how to send parameters ***
//'?' turns the parameter optional
//[0-9] accepts 0-9 digits, '+' minimum one digit
//Route::get('user/{id?}', function($id = null){
//Route::get('user/{id?}', function($id = 123){
//    if($id)
//        return "Olá $id";
//    
//    return "Não possui ID";
//})->where('id', '[0-9]+');

//*** naming a route ***
//Route::get('cool-products', ['as' => 'products', function(){
//    //returns the route been accessed
//    echo Route::currentRouteName();
//    //return 'Products';
//}]);
//
////returns the route: http://localhost:8000/cool-products
//echo route('products'); die;
//
///*** redirects to the route ***
//redirect()->route('produtos');

//*** grouping routes ***
//Route::group(['prefix' => 'admin'], function(){
//    Route::get('products', function(){
//       return 'Products'; 
//    });
//});

//*** route model binding ***
//old way:
//Route::get('/category/{id}',function($id){
//    $category = new \CodeCommerce\Category();
//    $c = $category->find($id);
//    
//    return $c->name;
//});
//right way:
//need to change  the boot function at the RouteServiceProvider
//Route::get('/category/{category}', function(\CodeCommerce\Category $category){
//    
//    dd($category);
//});


Route::get('/','WelcomeController@index');
Route::get('/example','WelcomeController@example');
Route::group(['prefix' => 'admin'], function(){
    Route::group(['prefix' => 'products'], function() {
        Route::get('', ['as' => 'admin.products.index', 'uses' => 'AdminProductsController@index']);
        Route::get('create', ['as' => 'admin.products.create', 'uses' => 'PostsAdminController@create']);
        Route::post('store', ['as' => 'admin.products.store', 'uses' => 'PostsAdminController@store']);
        Route::get('edit/{id}', ['as' => 'admin.products.edit', 'uses' => 'PostsAdminController@edit']);
        Route::put('update/{id}', ['as' => 'admin.products.update', 'uses' => 'PostsAdminController@update']);
        Route::get('destroy/{id}', ['as' => 'admin.products.destroy', 'uses' => 'PostsAdminController@destroy']);
    });
    Route::group(['prefix' => 'categories'], function() {
        Route::get('', ['as' => 'admin.categories.index', 'uses' => 'AdminCategoriesController@index']);   
        Route::get('create', ['as' => 'admin.categories.create', 'uses' => 'PostsAdminController@create']);
        Route::post('store', ['as' => 'admin.categories.store', 'uses' => 'PostsAdminController@store']);
        Route::get('edit/{id}', ['as' => 'admin.categories.edit', 'uses' => 'PostsAdminController@edit']);
        Route::put('update/{id}', ['as' => 'admin.categories.update', 'uses' => 'PostsAdminController@update']);
        Route::get('destroy/{id}', ['as' => 'admin.categories.destroy', 'uses' => 'PostsAdminController@destroy']);
    });    
});
//Route::get('/admin/categories','AdminCategoriesController@index');
//Route::get('/admin/products','AdminProductsController@index');