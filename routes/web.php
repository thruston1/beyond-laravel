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
                'App\Http\Controllers\Admin\MasterCampaignController' => 'masterCampaign',
                'App\Http\Controllers\Admin\DataInfoTaskController' => 'dataInfoTask',
                'App\Http\Controllers\Admin\StrategyLoadController' => 'strategyLoad',
                'App\Http\Controllers\Admin\CollectionTaskNewController' => 'collectionTask',
                'App\Http\Controllers\Admin\UserAgentController' => 'userAgent',
            ];

            foreach ($listRouter as $controller => $linkName) {
                switch ($linkName) {
                    case 'admin':
                        $router->get($linkName . '/{id}/password', $controller . '@password')->name('admin.' . $linkName . '.password');
                        $router->post($linkName . '/{id}/password', $controller . '@updatePassword')->name('admin.' . $linkName . '.updatePassword');
                        break;
                    case 'uploadLoad':
                        $router->post($linkName . '/import-csv', $controller . '@importCsv')->name('admin.' . $linkName . '.importCsv');
                        $router->post($linkName . '/upload-csv', $controller . '@importToDB')->name('admin.' . $linkName . '.importToDB');
                        $router->get($linkName . '/ajax-data', $controller . '@download_txt')->name('admin.' . $linkName . '.downloadTxt');
                        $router->post($linkName . '/ajax-data', $controller . '@ajaxData')->name('admin.' . $linkName . '.ajaxData');
                        break;
                    case 'strategyLoad':
                        $router->post($linkName . '/bucket-data', $controller . '@submitBucket')->name('admin.' . $linkName . '.submitBucket');
                        break;
                }
                $router->get($linkName . '/data', $controller . '@dataTable')->name('admin.' . $linkName . '.dataTable');
                $router->resource($linkName, $controller, ['as' => 'admin']);
            }

        });

        $router->get('/', ['uses' => 'App\Http\Controllers\Admin\DashboardController@dashboard'])->name('admin');

    });


    // web login for agent

    // for if login confirm
   
    

});

Route::group(['prefix'=>'agent', 'middleware' => ['web']], function () use ($router) {
    $router->get('/ctm-login', ['uses' => 'App\Http\Controllers\Website\AuthController@login'])->name('web.login');
    $router->post('/do-login', ['uses' => 'App\Http\Controllers\Website\AuthController@doLogin'])->name('web.doLogin');
    $router->get('/ctm-logout', ['uses' => 'App\Http\Controllers\Website\AuthController@logout'])->name('web.logout');

    $router->group(['middleware' => ['webLogin', 'preventBackHistory']], function () use ($router) {
        $router->get('/call-center', ['uses' => 'App\Http\Controllers\Website\CallCenterController@index'])->name('callCenter.index');
        $router->get('/call-screen', ['uses' => 'App\Http\Controllers\Website\CallCenterController@callCenter'])->name('callCenter.callScreen');
    });
});

Route::get('/', ['uses' => 'App\Http\Controllers\Website\WebController@index'])->name('web.index');




