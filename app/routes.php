<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/locateinv', function(){
	return View::make('invoices.find_invoice');
});

Route::post('/findinvoice', array('as' => 'find_invoice', 'uses' => 'InvoicesController@find_invoice'));

Route::get('/lc', function()
{
	return View::make('lastchance.lastchance_form');
});


Route::get('/newinv', array('as' => 'new_invoice', 'uses' => 'InvoicesController@new_invoice'));


Route::post('/addatty', array('as' => 'new_customer', 'uses' => 'AttorneysController@store'));



Route::get('/makeatty', function()
{
	return View::make('addcustomer');
});



Route::post('/makeinvoicenow', function(){
	return View::make('hello');
});



Route::post('/makepreinvoice', function(){
	return View::make('preinvoice');
});

Route::get('/fixdata', function(){
	return View::make('fixdata');
});


Route::post('/invoice_created/add', array('as' => 'finalize_invoice', 'uses' => 'InvoicesController@finalize'));

Route::post('/invoice_created/fix', array('as' => 'fix_invoice', 'uses' => 'InvoicesController@fix'));

Route::post('/invoice_created', function(){
	return View::make('preinvoice');
});


Route::post('/finalize/completed', array('as' => 'finalize', 'uses' => 'InvoicesController@finalize'));

Route::post('/fix/it', function(){
	return View::make('rere');
});

Route::post('/finalize', function(){
	return View::make('finalize');
});


Route::get('/invoicenumbertest', function(){
	return View::make('invnumtest');
});

Route::get('/listinvoices', function(){
	return View::make('invoicelist');
});

Route::post('/remakepdf', array('as' => 'remake_pdf', 'uses' => 'InvoicesController@remakeInvoice'));


Route::get('/invoicennn', array('as' => 'export', 'uses' => 'InvoicesController@export'));


Route::get('/random/{id}', array('as' => 'showinvoice', 'uses' => 'InvoicesController@showinvoice'));
	
Route::resource('invoices', 'InvoicesController');

Route::get('/fixclaims', function(){
	return View::make('fixclaimnumber');
});



Route::post('/updateaddress', array('as' => 'update_address', 'uses' => 'InvoicesController@updateinvoice_address'));

Route::post('/updateverbiage', array('as' => 'update_verbiage', 'uses' => 'InvoicesController@updateinvoice_verbiage'));

Route::post('/makelastchance', function(){
	return View::make('lastchance.lastchance_complete');
});




?>






