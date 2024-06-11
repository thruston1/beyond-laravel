<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => env('ADMIN_URL'), 'middleware' => ['web']], function () use ($router) {
    $router->get('login', ['uses' =>  'App\Http\Controllers\Admin\AccessAdminController@getLogin', 'middleware' => ['adminHaveLogin']])->name('admin.login');
    $router->post('login', ['uses' => 'App\Http\Controllers\Admin\AccessAdminController@postLogin', 'middleware' => ['adminHaveLogin']])->name('admin.login.post');
    $router->get('logout', ['uses' => 'App\Http\Controllers\Admin\AccessAdminController@doLogout'])->name('admin.logout');

    $router->group(['middleware' => ['adminLogin', 'preventBackHistory']], function () use ($router) {

        $router->group(['prefix' => 'profile'], function () use ($router) {
            $router->get('edit', ['uses'=>'App\Http\Controllers\Admin\ProfileController@getProfile'])->name('admin.getProfile');
            $router->post('edit', ['uses'=>'App\Http\Controllers\Admin\ProfileController@postProfile'])->name('admin.postProfile');
            $router->get('password', ['uses'=>'App\Http\Controllers\Admin\ProfileController@getPassword'])->name('admin.getPassword');
            $router->post('password', ['uses'=>'App\Http\Controllers\Admin\ProfileController@postPassword'])->name('admin.postPassword');
            $router->get('/', ['uses'=>'App\Http\Controllers\Admin\ProfileController@profile'])->name('admin.profile');
        });

        $router->group(['middleware' => ['adminAccessPermission']], function () use ($router) {
            $listRouter = [
                'App\Http\Controllers\Admin\SettingsController' => 'settings',
                'App\Http\Controllers\Admin\CustomMenuController' => 'custom-menu',
                'App\Http\Controllers\Admin\PageController' => 'page',
                'App\Http\Controllers\Admin\AdminController' => 'admin',
                'App\Http\Controllers\Admin\RoleController' => 'role',
                'App\Http\Controllers\Admin\UsersController' => 'user',
                'App\Http\Controllers\Admin\ProductController' => 'product',
                'App\Http\Controllers\Admin\CategoryController' => 'category',
                // upload file
                'App\Http\Controllers\Admin\UploadDataLoadController' => 'uploadLoad',

                // config
                'App\Http\Controllers\Admin\SetupStrategyCall' => 'strategy',
            ];

            foreach ($listRouter as $controller => $linkName) {
                switch ($linkName) {
                    case 'admin':
                        $router->get($linkName . '/{id}/password', $controller . '@password')->name('admin.' . $linkName . '.password');
                        $router->post($linkName . '/{id}/password', $controller . '@updatePassword')->name('admin.' . $linkName . '.updatePassword');
                        break;
                    case 'product':
                        $router->get($linkName . '/{id}/password', $controller . '@export')->name('admin.' . $linkName . '.export');
                        break;
                    case 'uploadLoad':
                        $router->post($linkName . '/ajax-data', $controller . '@ajaxData')->name('admin.' . $linkName . '.ajaxData');
                        break;
                }
                $router->get($linkName . '/data', $controller . '@dataTable')->name('admin.' . $linkName . '.dataTable');
                $router->resource($linkName, $controller, ['as' => 'admin']);
            }

        });

        $router->get('/', ['uses' => 'App\Http\Controllers\Admin\DashboardController@dashboard'])->name('admin');

    });

});

Route::get('/', ['uses' => 'App\Http\Controllers\Website\WebController@index'])->name('home.index');
Route::get('/ctm-login', ['uses' => 'App\Http\Controllers\Website\HomeController@getLogin'])->name('home.login');

Route::get('/call-center', ['uses' => 'App\Http\Controllers\Website\CallCenterController@index'])->name('callCenter.index');
Route::get('/call-screen', ['uses' => 'App\Http\Controllers\Website\CallCenterController@callCenter'])->name('callCenter.callScreen');

