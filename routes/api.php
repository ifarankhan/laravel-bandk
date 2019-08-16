<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

/**
 * Api version 1
 */
Route::post('login', 'API\PassportController@login');
Route::post('register', 'API\PassportController@register');
Route::group(['middleware' => 'auth:api'], function() {
    Route::post('/claim-form-data', 'API\PassportController@getClaimFormData');
    Route::post('/claim/create', 'API\PassportController@createClaim');
    Route::get('/categories', 'API\PassportController@getCategories');
    Route::get('/user/roles', 'API\PassportController@getUserRoles');
    Route::get('/category/{id?}', 'API\PassportController@getCategory');
    Route::get('/claim/{id?}', 'API\PassportController@getClaim');
    Route::get('/claims/open', 'API\PassportController@getOpenClaims');

    Route::delete('/claim/image/{id?}', 'API\PassportController@deleteClaimImage');
});


/**
 * API version 2
 */

Route::post('/v2/login', 'API\V2\PassportController@login');
Route::post('/v2/register', 'API\V2\PassportController@register');

Route::group(['prefix' => 'v2','middleware' => 'auth:api'], function (){
    Route::post('/claim-form-data', 'API\V2\PassportController@getClaimFormData');

    Route::post('/claim/create', 'API\V2\PassportController@createClaim');
    Route::get('/categories', 'API\V2\PassportController@getCategories');
    Route::get('/user/roles', 'API\V2\PassportController@getUserRoles');
    Route::get('/category/{id?}', 'API\V2\PassportController@getCategory');
    Route::get('/claim/{id?}', 'API\V2\PassportController@getClaim');
    Route::get('/claims/open', 'API\V2\PassportController@getOpenClaims');

    Route::get('/user/companies', 'API\V2\PassportController@getUserCompanies');

    Route::delete('/claim/image/{id?}', 'API\V2\PassportController@deleteClaimImage');
});