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

Route::get('post/create', 'BackEndController@create');
Route::get('posts', 'BackEndController@edit');
Route::get('post/edit', 'PostsController@edit');
Route::resource('posts', 'PostsController');
Route::post('post', 'PostsController@store');
Route::get('post/create', 'PostsController@create');
Auth::routes();
Route::get('dashboard', 'DashboardController@index')->name('Dashboard');
Route::get('/dashboard', 'DashboardController@index');
Route::get('/create','PostsController@Storage');
Route::get('posts/create', 'BackEndController@create');
Route::get('/dashboard', 'DashboardController@dashboard');

  //comments controller
  Route::get('comments','commentsController@comments');
  
  

//page.....................frontEndpages.

Route::get('/', 'FrontEndController@index');
Route::get('/blog', 'FrontEndController@blog');
Route::get('/blog_single', 'FrontEndController@blog_single');
Route::get('/services','FrontEndController@services');
Route::get('/about','FrontEndController@about');
Route::get('/project','FrontEndController@project');
Route::resource('posts', 'postsController');
Route::get('/post_single','FrontEndController@post_single');
Route::get('/post_single','PostsController@show');
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

 


