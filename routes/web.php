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

Route::get('/testing', function () {
    $users = \App\User::all();
    dd($users);
    foreach ($users as $user) {
        $email = $user->email;
        $user->username = $email;
        $user->save();
    }

    exit;
    $html = '<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>';
    \PDF::loadHTML($html)->setPaper('a4')->setOrientation('landscape')->setOption('margin-bottom', 0)->setOption('javascript-delay', 2000)->setOption('enable-external-links', true)->save('myfile.pdf');
});



Route::group(['middleware' => ['auth', 'is_super_admin']], function() {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index')->middleware(['auth']);
    Route::get('/dashboard/users', 'UsersController@index')->name('users.index');
    Route::get('/dashboard/users/create', 'UsersController@create')->name('users.create');
    Route::post('/dashboard/users/create', 'UsersController@store')->name('users.store');
    Route::get('/dashboard/users/edit/{id}', 'UsersController@edit')->name('users.edit');
    Route::post('/dashboard/users/status/{id}', 'UsersController@status')->name('users.status');

    Route::get('/dashboard/content', 'ContentsController@index')->name('content.index');
    Route::get('/dashboard/content/create', 'ContentsController@create')->name('content.create');
    Route::post('/dashboard/content/create', 'ContentsController@store')->name('content.store');
    Route::get('/dashboard/content/edit/{id}', 'ContentsController@edit')->name('content.edit');
    Route::post('/dashboard/content/delete/{id}', 'ContentsController@delete')->name('content.delete');

    Route::get('/dashboard/categories', 'CategoryController@index')->name('category.index');
    Route::get('/dashboard/category/create', 'CategoryController@create')->name('category.create');
    Route::post('/dashboard/category/create', 'CategoryController@store')->name('category.store');
    Route::get('/dashboard/category/edit/{id}', 'CategoryController@edit')->name('category.edit');
    Route::post('/dashboard/category/delete/{id}', 'CategoryController@delete')->name('category.delete');


    Route::get('/dashboard/teams', 'TeamsController@index')->name('team.index');
    Route::get('/dashboard/team/create', 'TeamsController@create')->name('team.create');
    Route::post('/dashboard/team/create', 'TeamsController@store')->name('team.store');
    Route::get('/dashboard/team/edit/{id}', 'TeamsController@edit')->name('team.edit');
    Route::post('/dashboard/team/delete/{id}', 'TeamsController@delete')->name('team.delete');

    Route::get('/dashboard/categories/all', 'CategoryController@allCategories')->name('category.all');
    Route::get('/dashboard/categories/update', 'CategoryController@categoryUpdate')->name('category.update');
    Route::get('/dashboard/categories/create-json', 'CategoryController@categoryCreate')->name('category.create-json');
    Route::get('/dashboard/categories/remove', 'CategoryController@categoryRemove')->name('category.remove');


    Route::get('/dashboard/claim-types', 'ClaimTypeController@index')->name('claim-type.index');
    Route::get('/dashboard/claim-type/create', 'ClaimTypeController@create')->name('claim-type.create');
    Route::post('/dashboard/claim-type/create', 'ClaimTypeController@store')->name('claim-type.store');
    Route::get('/dashboard/claim-type/edit/{id}', 'ClaimTypeController@edit')->name('claim-type.edit');
    Route::post('/dashboard/claim-type/delete/{id}', 'ClaimTypeController@delete')->name('claim-type.delete');

    Route::get('/dashboard/claim-mechanics', 'ClaimMechanicsController@index')->name('claim-mechanic.index');
    Route::get('/dashboard/claim-mechanic/create', 'ClaimMechanicsController@create')->name('claim-mechanic.create');
    Route::post('/dashboard/claim-mechanic/create', 'ClaimMechanicsController@store')->name('claim-mechanic.store');
    Route::get('/dashboard/claim-mechanic/edit/{id}', 'ClaimMechanicsController@edit')->name('claim-mechanic.edit');
    Route::post('/dashboard/claim-mechanic/delete/{id}', 'ClaimMechanicsController@delete')->name('claim-mechanic.delete');

    Route::get('/dashboard/departments', 'DepartmentController@index')->name('department.index');
    Route::get('/dashboard/department/create', 'DepartmentController@create')->name('department.create');
    Route::post('/dashboard/department/create', 'DepartmentController@store')->name('department.store');
    Route::get('/dashboard/department/edit/{id}', 'DepartmentController@edit')->name('department.edit');
    Route::post('/dashboard/department/delete/{id}', 'DepartmentController@delete')->name('department.delete');


    Route::get('/dashboard/customers', 'CustomersController@index')->name('customer.index');
    Route::get('/dashboard/customer/create', 'CustomersController@create')->name('customer.create');
    Route::post('/dashboard/customer/create', 'CustomersController@store')->name('customer.store');
    Route::get('/dashboard/customer/edit/{id}', 'CustomersController@edit')->name('customer.edit');
    Route::post('/dashboard/customer/delete/{id}', 'CustomersController@delete')->name('customer.delete');
    Route::get('/dashboard/customer/details/{id}', 'CustomersController@details')->name('customer.details');

    Route::get('/dashboard/meeting-place', 'MeetingPlaceController@index')->name('meeting-place.index');
    Route::get('/dashboard/meeting-place/create', 'MeetingPlaceController@create')->name('meeting-place.create');
    Route::get('/dashboard/meeting-place/store', 'MeetingPlaceController@store')->name('meeting-place.store');


});

Route::group(['middleware' => ['auth', 'can_access']], function() {

    Route::get('/claim/create', 'ClaimsController@create')->name('claim.create');

    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/home', 'HomeController@index')->name('home.index');

});
Route::group(['middleware' => ['auth']], function() {

    Route::get('/dashboard/claims', 'ClaimsController@index')->name('claim.index');
    Route::get('/dashboard/claim/create', 'ClaimsController@create')->name('claim.create');
    Route::post('/dashboard/claim/create', 'ClaimsController@store')->name('claim.store');
    Route::get('/dashboard/claim/details/{id}', 'ClaimsController@details')->name('claim.details');
    Route::get('/dashboard/claim/edit/{id}', 'ClaimsController@edit')->name('claim.edit');
    Route::post('/dashboard/claim/delete/{id}', 'ClaimsController@delete')->name('claim.delete');

    Route::post('/dashboard/claim/image/delete/{id}', 'ClaimsController@deleteImage')->name('image.delete');
    Route::post('/dashboard/claim/other/fields/update', 'ClaimsController@otherFields')->name('claim.detail.form');

    Route::post('/dashboard/claim/conversation/create', 'ClaimsController@addConversation')->name('claim.conversation.store');

    Route::post('/claim/create', 'ClaimsController@store')->name('claim.create.post');
    Route::get('/department/address/{id}', 'ClaimsController@departmentAddress')->name('department.address');
    Route::get('/customer/departments/{id}', 'DepartmentController@customerDepartments')->name('customer.department');
    Route::get('/customer/departments/grouped/{id}', 'DepartmentController@customerGroupedDepartments')->name('customer.department');
    Route::get('/customer/teams/{id}', 'TeamsController@customerTeams')->name('customer.teams');
    Route::get('/content/list/{categoryId}', 'ContentsController@getList')->name('content.list');
    Route::post('/claim/status', 'ClaimsController@updateStatus')->name('claim.status');
});

Auth::routes();
