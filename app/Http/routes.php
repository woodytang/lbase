<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Models\Section\Section;

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

/*
|--------------------------------------------------------------------------
| 前台路由
|--------------------------------------------------------------------------
|
*/
Route::group(array(), function () {

    Route::get('/', [
         'as'=>'home',
         'uses'=> 'FrontController@index']);

    Route::get('/posts/{id}', [
        'as'=>'post_path',
        'uses'=> 'FrontController@show']);

    Route::get('/sites', [
        'as'=>'site_path',
        'uses'=> 'FrontController@siteListing']);

    Route::get('/category/{id}', [
        'as'=>'category_listing_path',
        'uses'=>'FrontController@categoryListing']);

    Route::get('/tag/{id}', [
        'as'=>'tag_listing_path',
        'uses'=>'FrontController@tagListing']);

    Route::get('/cheatsheet', 'FrontController@cheatsheet');

    //页面详情页
    Route::get('sections/{id}', [
        'as'=>'section_path',
        'uses'=>'SectionsController@section']);

    Route::get('sections/{id}/posts/{link}', [

        'as'=>'section_post_path',
        'uses'=>'SectionsController@section_post']);

    //前台API
    Route::controller('api','ApiController');
    Route::controller('crawler','CrawlerController');
    


});



/*
|--------------------------------------------------------------------------
| 后台路由
|--------------------------------------------------------------------------
|
*/

//Admin路由
Route::group(array('prefix'=>'admin','middleware' => 'auth'), function () {


    Route::get('/','DashboardController@index');
    Route::resource('posts', 'PostsController');
    Route::resource('categories','CategoriesController');
    Route::resource('menus','MenusController');
    Route::resource('menusets','MenuSetsController');
    Route::resource('section_contents','SectionContentsController');
    Route::resource('sections','SectionsController');
    Route::resource('users','UsersController');
    Route::resource('sites','SitesController');

    Route::controller('api','ApiController');
    Route::controller('settings','SettingsController');


});
/*
Route::get('test',function(){

    dd(Config::get('app.url'));
});*/