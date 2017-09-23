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

/*Route::get('/', function () {
    return view('welcome');
});*/

//Route::get('', 'HomeController@index');
//
Route::get('/', 'HomeController@index');
//Route::post('/login', 'HomeController@login');
Route::get('/logout', 'HomeController@getLogout');

Auth::routes();
Route::group(['middleware'=>'auth'],function(){

Route::group(['prefix'=>'customer'],function(){
	Route::get('/', 'CustomerController@index');
	Route::get('/create', 'CustomerController@create');
	Route::post('/create', 'CustomerController@postCreate');
	Route::get('/addressbook', 'CustomerController@address');
	Route::post('/addressbook', 'CustomerController@postAddress');
	Route::get('/delete/{id}', 'CustomerController@delete');
	Route::get('/address_delete/{id}', 'CustomerController@address_delete');
	Route::get('/show/{id}','CustomerController@show');
	Route::get('/edit/{id}','CustomerController@edit');
	Route::get('/search', 'CustomerController@search');
	Route::get('/addressdetail', 'CustomerController@addressdetail');
	Route::post('/updateaddress', 'CustomerController@updateaddress');
	Route::post('/updatedetail', 'CustomerController@updatedetail');
	Route::get('/checkemail', 'CustomerController@checkemail');
	Route::get('/filter', 'CustomerController@filter');
});

Route::group(['prefix'=>'metals'],function(){
	Route::get('/', 'MetalController@index');
	Route::get('/add', 'MetalController@create');
	Route::post('/add', 'MetalController@postCreate');
	Route::get('/delete/{id}', 'MetalController@delete');
	Route::get('/edit/{id}','MetalController@edit');
	Route::post('/edit', 'MetalController@postEdit');

});

Route::group(['prefix'=>'ringsize'],function(){
	Route::get('/', 'RingsizeController@index');
	Route::get('/add', 'RingsizeController@create');
	Route::post('/add', 'RingsizeController@postCreate');
	Route::get('/delete/{id}', 'RingsizeController@delete');
	Route::get('/edit/{id}','RingsizeController@edit');
	Route::post('/edit', 'RingsizeController@postEdit');

});
/*-------------------for metals-------------*/

Route::group(['prefix'=>'metals'],function(){
	Route::get('/', 'MetalController@index');
	Route::get('/add', 'MetalController@create');
	Route::post('/add', 'MetalController@postCreate');
	Route::get('/delete/{id}', 'MetalController@delete');
	Route::get('/edit/{id}','MetalController@edit');
	Route::post('/edit', 'MetalController@postEdit');

});
/*-------------------for delivery method-------------*/
Route::group(['prefix'=>'delivery'],function(){
	Route::get('/', 'DelivermethodController@index');
	Route::get('/add', 'DelivermethodController@create');
	Route::post('/add', 'DelivermethodController@postCreate');
	Route::get('/delete/{id}', 'DelivermethodController@delete');
	Route::get('/edit/{id}','DelivermethodController@edit');
	Route::post('/edit', 'DelivermethodController@postEdit');

});
/*-------------------for status -------------*/

Route::group(['prefix'=>'status'],function(){
	Route::get('/', 'StatusController@index');
	Route::get('/add', 'StatusController@create');
	Route::post('/add', 'StatusController@postCreate');
	Route::get('/delete/{id}', 'StatusController@delete');
	Route::get('/edit/{id}','StatusController@edit');
	Route::post('/edit', 'StatusController@postEdit');

});
/*-------------------for payment method-------------*/
Route::group(['prefix'=>'payment'],function(){
	Route::get('/', 'PaymentmethodController@index');
	Route::get('/add', 'PaymentmethodController@create');
	Route::post('/add', 'PaymentmethodController@postCreate');
	Route::get('/delete/{id}', 'PaymentmethodController@delete');
	Route::get('/edit/{id}','PaymentmethodController@edit');
	Route::post('/edit', 'PaymentmethodController@postEdit');

});
/*-------------------for Quote-------------*/
Route::group(['prefix'=>'quote'],function(){
	Route::get('/', 'QuoteController@index');
	Route::get('/add/{id}', 'QuoteController@create');
	Route::post('/add', 'QuoteController@postCreate');
	Route::get('/delete/{id}', 'QuoteController@delete');
	Route::get('/customersearch', 'QuoteController@customersearch');
	Route::get('/emailsearch', 'QuoteController@emailsearch');
	Route::get('/view/{id}', 'QuoteController@QuoteView');
	Route::get('/filter', 'QuoteController@filter');
	Route::get('/edit/{id}', 'QuoteController@edit');
	Route::post('/update', 'QuoteController@update');
	Route::get('/delete_quoteitem', 'QuoteController@delete_quoteitem');
	Route::get('/pdf/{id}', 'QuoteController@getPdf');
	Route::get('/mail/{id}', 'QuoteController@sendQuote');

});
/*------------------- Order ----------------------*/
Route::group(['prefix'=>'order'],function(){
	Route::get('/', 'OrderController@index');
	Route::get('/create/{id}', 'OrderController@create');
	Route::post('/save', 'OrderController@postCreate');


});
Route::get('/panels', function()
{
	return View::make('panel');
});

Route::get('/home', 'HomeController@index')->name('home');
});