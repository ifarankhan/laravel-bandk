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
    return redirect()->route('dashboard.index');
});*/

Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index')->middleware(['auth']);

Route::group(['middleware' => ['auth', 'is_super_admin']], function() {

    Route::get('/dashboard/users', 'UsersController@index')->name('users.index');
    Route::get('/dashboard/users/create', 'UsersController@create')->name('users.create');
    Route::post('/dashboard/users/create', 'UsersController@store')->name('users.store');
    Route::get('/dashboard/users/edit/{id}', 'UsersController@edit')->name('users.edit');

    Route::get('/dashboard/content', 'ContentsController@index')->name('content.index');
    Route::get('/dashboard/content/create', 'ContentsController@create')->name('content.create');
    Route::post('/dashboard/content/create', 'ContentsController@store')->name('content.store');
    Route::get('/dashboard/content/edit/{id}', 'ContentsController@edit')->name('content.edit');
    Route::delete('/dashboard/content/delete/{id}', 'ContentsController@delete')->name('content.delete');

    Route::get('/dashboard/categories', 'CategoryController@index')->name('category.index');
    Route::get('/dashboard/category/create', 'CategoryController@create')->name('category.create');
    Route::post('/dashboard/category/create', 'CategoryController@store')->name('category.store');
    Route::get('/dashboard/category/edit/{id}', 'CategoryController@edit')->name('category.edit');
    Route::delete('/dashboard/category/delete/{id}', 'CategoryController@delete')->name('category.delete');

    Route::get('/dashboard/claims', 'ClaimsController@index')->name('claim.index');
    Route::get('/dashboard/claim/create', 'ClaimsController@create')->name('claim.create');
    Route::post('/dashboard/claim/create', 'ClaimsController@store')->name('claim.store');
    Route::get('/dashboard/claim/details/{id}', 'ClaimsController@details')->name('claim.details');
    Route::delete('/dashboard/claim/delete/{id}', 'ClaimsController@delete')->name('claim.delete');

    Route::post('/dashboard/claim/conversation/create', 'ClaimsController@addConversation')->name('claim.conversation.store');


});

Route::group(['middleware' => ['auth']], function() {

    Route::get('/department/address/{id}', 'ClaimsController@departmentAddress')->name('department.address');
    Route::get('/claim/create', 'ClaimsController@create')->name('claim.create');
    Route::post('/claim/create', 'ClaimsController@store')->name('claim.create.post');

    Route::get('/', 'HomeController@index')->name('home.index');
    /*Route::get('/category/{slug}', 'HomeController@categoryDetail')->name('home.category');*/


});


Auth::routes();
