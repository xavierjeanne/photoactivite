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
    Route::get('/admin/page/list', 'Back\PageController@index')->name('admin.page.list');
    Route::get('/admin/page/{id}/content', 'Back\PageController@listContent')->name('admin.page.list.content');
    Route::post('/admin/page/new', 'Back\PageController@new')->name('admin.page.new');
    Route::post('/admin/page/{id}/content/new', 'Back\PageController@newBlock')->name('admin.page.content.new');
    Route::get('/admin/page/edit/{id}', array(
        'as' => 'admin.page.edit',
        'uses' => 'Back\PageController@edit'
    ));
    Route::get('/admin/page/{id}/content/edit/{bloc_id}', array(
        'as' => 'admin.page.content.edit',
        'uses' => 'Back\PageController@editContent'
    ));
    Route::delete('/admin/page/delete/{id}', array(
        'as' => 'admin.page.delete',
        'uses' => 'Back\PageController@delete'
    ));
   Route::delete('/admin/page/{id}/delete/content/{bloc_id}', array(
        'as' => 'admin.page.content.delete',
        'uses' => 'Back\PageController@deleteContent'
    ));
    /**fin de page */
    Route::get('/admin/category/list','Back\CategoryController@index')->name('admin.category.list');
    Route::post('/admin/category/new','Back\CategoryController@new')->name('admin.category.new');
    Route::delete('/admin/category/delete','Back\CategoryController@delete')->name('admin.category.delete');
    Route::get('/admin/category/edit/{id}','Back\CategoryController@edit')->name('admin.category.edit');
});
/**
* Page accéssible aux utilisateurs authentifié
 */
Route::middleware('auth')->group(function () {
    Route::get('/licence', 'LicenceController@form')->name('licence');

});