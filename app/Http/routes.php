<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('home', 'HomeController@index');



Route::post('/product_kitchens', function() {
    $inputs = Input::all();
    $selected = $inputs['selected'];
    
    if ($selected == 1)
    {
        return view('products.kitchen');  
    }
    
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => 'auth'], function()
{
    Route::resource('users', 'UserController');
    Route::resource('products', 'ProductController');
    Route::resource('shifts', 'ShiftController');
    Route::resource('orders', 'OrderController');
    
    Route::get('combo/{product_id}', array('as' => 'combos', function ($product_id){
        
        $product = \App\Product::find($product_id);
        
        return view('combo_rules.create', [ 'product' => $product, 'combo_types' => \App\ComboType::all() ]);
    }));
    
    Route::get('addRoleToUser/{user}/{role}', array('uses' => 'UserController@addRoleToUser', 'as' => 'addRoleToUser'));
    Route::get('removeRoleFromUser/{user}/{role}', array('uses' => 'UserController@removeRoleFromUser', 'as' => 'removeRoleFromUser'));
    
    Route::get('kitchen', function() {
    	return view('kitchen.orders.index');
    });
    
    Route::get('kitchen/items', function(){
    	$orders = DB::select('select order_items.id, products.name, order_items.order_id, order_items.quantity from order_items inner join products on order_items.product_id = products.id inner join product_types on products.product_type_id = product_types.id where product_types.name = "Prepared" and is_completed = false'); 	
        
        return $orders;
        
    });
    
    Route::post('order_item/mark/completed/{id}', function($id) {
       
       $order_item = App\OrderItem::find($id);
       
       $order_item->is_completed = true;
       $order_item->save();
       
       return Response::make(array('status' => 'success'), 200);
       
    });
    
});



Route::resource('api/stocks', 'API\StockAPIController');

Route::resource('stocks', 'StockController');

Route::get('stocks/{id}/delete', [
    'as' => 'stocks.delete',
    'uses' => 'StockController@destroy',
]);
