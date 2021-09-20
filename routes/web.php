<?php

use Illuminate\Support\Facades\Auth;
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



Auth::routes();
/**
 * Overridde route
 */
/*Route::get('register/{type}', [
  'as' => 'register-step2',
  'uses' => 'Auth\RegisterController@showRegistrationFormStep2'
]);*/
/**
 * pages du site acccéssible à tous
 */
Route::get('/', 'HomeController@index')->name('home');
Route::get('/pro','ProController@index')->name('pro');
Route::get('/perso','ProController@index')->name('perso');
Route::get('/contact','ContactController@index')->name('contact');
Route::get('/mentions','MentionController@index')->name('mentions');
Route::get('/policy','PolicyController@index')->name('policy');

/**
 * back office
 */
Route::get('/admin','Back\AdminController@index')->name('admin')->middleware('admin');
Route::get('/admin/informations-personnelles','Back\UserController@informationPersonnelles')->name('admin.informations-personnelles')->middleware('admin');
Route::post('/admin/user/save','Back\UserController@save')->name('admin.user.save')->middleware('admin');
Route::get('/admin/page/list','Back\PageController@list')->name('admin.page.list')->middleware('admin');
/**
* Page accéssible aux utilisateurs authentifié
 */
Route::middleware('auth')->group(function () {
    Route::get('/licence', 'LicenceController@form')->name('licence');

});