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
	if(Auth::check()){
		return redirect('/account/dashboard');
	} else {
		return view('auth.login');
	}
});
*/
Auth::routes();
Route::group(['middleware' => 'auth'], function () {
	Route::group(
        ['namespace' => 'Admin', 'prefix' => 'account', 'as' => 'admin.'], function () {
			Route::resources(
				[
					'users' => 'UserController',
					'profile' => 'ProfileController',
					'settings' => 'SettingController',
					'cabangs' => 'CabangController',
					'keuangans' => 'KeuanganController',
					'warehouses' => 'WarehouseController',
					'gudang' => 'GudangController',
					'categories' => 'CategoriesController',
					'satuan' 	=> 'SatuanController',
					'barang'	=> 'BarangController',
					'roles' 	=> 'RoleController',
					'vendor'	=> 'VendorController',
					'pembelian'	=> 'PembelianController'
				]
			);
			Route::get('/', 'ShowDashboard@index');
			Route::get('dashboard', 'ShowDashboard@index')->name('dashboard');

			Route::get('role-permission', 'UserController@rolePermission')->name('users.roles_permission');
			Route::post('permission', 'UserController@addPermission')->name('users.add_permission');
			Route::put('permission/{role}', 'UserController@setRolePermission')->name('users.setRolePermission');
			
			Route::get('cabangs/json',['as' => 'cabangs.json' , 'uses' => 'CabangController@json']);
			Route::get('/search-pic', 'SettingController@searchPic')->name('settings.search-pic');
			Route::get('/search-warehouse', 'WarehouseController@searchWarehouse')->name('warehouses.search-warehouse');
			Route::get('/search-barang', 'BarangController@searchBarang')->name('barang.search-barang');

			Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

			Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
			
			
		});
});

