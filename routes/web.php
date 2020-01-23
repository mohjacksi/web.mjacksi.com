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

Route::get('/', function () {
    $pages = \App\Page::where('is_public',true)->limit(10)->OrderBy('id','DESC')->get();
    return view('welcome')->with(['pages'=>$pages]);
});

Auth::routes();

Route::get('/home', 'HomeController@index');


Route::group(['middleware' => ['auth']], function () {
    // Logout
    Route::get('/logout', function (){
        Auth::logout();
        return redirect()->route('main');
    });

    Route::resource('pages', 'PageController');

    //Edit page
    Route::get('/pages','PageController@index')->name('home');
    Route::get('{username}/{url}/edit','PageController@edit')->name('page.edit_by_username_url');

    Route::put('{username}/{url}/put','PageController@update');
    Route::get('{username}','PageController@getPublicPages');
});
Route::get('{username}/{url}','PageController@show');
