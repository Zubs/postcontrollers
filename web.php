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

/*Route::get('/', function () {
    return view('welcome');
});
 


Route::get('/hello', function () {
    // return view('welcome');
     return '<h1>hello world</h1>';
});
*/
/* Route::get('/users/{id}/{name}', function ($id, $name) {
    return 'this is user '.$name. "with id of ".$id;
});

*/
//BELOW IS THE CONTROLLERS FOR posts.........................

Route::get('/', 'PagesController@index');
Route::resource('posts', 'PostsController');
Route::post('dashboard/post', 'PostsController@store');
Route::get('post/create', 'BackEndController@create');
Route::get('post/dashboard/create', 'PostsController@create');
Auth::routes();
Route::get('/dashboard', 'dashboardController@index')->name('dashboard');
Route::get('/dashboard', 'dashboardController@index');
Route::get('/create','PostsController@Storage');
Route::get('posts/dashboard/edit','PostsController@update');



  //comments controller
  Route::get('comments','commentsController@comments');
  
  

//page.....................frontEndpages.

Route::get('/', 'FrontEndController@index');
Route::get('/services','FrontEndController@services');
Route::get('/about','FrontEndController@about');
Route::get('/project','FrontEndController@project');
Route::resource('posts', 'postsController');
Route::get('/post','FrontEndController@post',
                            ['uses' => 'FrontEndController@posts.create']);
Route::get('/post_single','FrontEndController@post_single');
Auth::routes();
// email sending on the contact page.
Route::get('/contact',
             ['uses' => 'FrontEndController@create']);

Route::post('/contact',
            ['uses' => 'FrontEndController@store', 'as' => ('contact.store')]);

// sending on the quotemessage.

Route::get('/quotemessage','SendquoteController@quotemessage');

Route::post('/quotemessage',
                  ['uses'  => 'SendquoteController@store', 'as' => ('quotemessage.store')]);
                

  // subscriber emails capture
  
 Route::get('/headerfooter','SubscriberController@headerfooter');
 
 Route::post('/headerfooter.store',
                    ['uses'  => 'SubscriberController@store', 'as' => ('headerfooter.store')]);

 //BackEnd admin route

 //dashboard for footer and header combined here

 Route::get('/', 'BackendController@dashboard');
 Route::get('posts/edit', 'BackendController@update');
 
 

// BackEnd dashboard that performs processes...............
 
 



