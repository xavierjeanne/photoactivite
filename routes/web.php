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
Route::group(['middleware' => 'admin',], function() {
    Route::get('/admin', 'Back\AdminController@index')->name('admin');
    Route::get('/admin/informations-personnelles', 'Back\UserController@informationPersonnelles')->name('admin.informations-personnelles');
    Route::post('/admin/user/save', 'Back\UserController@save')->name('admin.user.save');
    /**page admin */
    Route::get('/admin/page/list', 'Back\PageController@list')->name('admin.page.list');
    Route::get('/admin/page/new', 'Back\PageController@form')->name('admin.page.new');
    Route::get('/admin/page/edit/{id}', array(
        'as' => 'admin.page.edit',
        'uses' => 'Back\PageController@form'
    ));
    Route::get('/admin/page/delete/{id}', array(
        'as' => 'admin.page.delete',
        'uses' => 'Back\PageController@delete'
    ));
    Route::delete('/admin/page/delete/{id}', array(
        'as' => 'admin.page.delete',
        'uses' => 'Back\PageController@delete'
    ));
});
/**fin de page */
/**
* Page accéssible aux utilisateurs authentifié
 */
Route::middleware('auth')->group(function () {
    Route::get('/licence', 'LicenceController@form')->name('licence');

});