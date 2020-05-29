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

Route::get('/', function () {

    $name = request('name');

    return view('welcome', 
        [ 'name' => $name]
    );
});

Route::get('/posts/{slug}', 'PostsController@show');

Route::get('/about', function(){
    // $articles = App\Article::all();
    // $articles = App\Article::latest('created_at')->get();
    // $articles = App\Article::take(2)->get();
    // $articles = App\Article::paginate(2);

    return view('about',[
        'articles' => App\Article::take(3)->latest('created_at')->get() 
        ]);
});

Route::get('/contact', function(){
    return view('contact');
});

Route::get('/articles', 'ArticlesController@index')->name('articles.index');
Route::post('/articles', 'ArticlesController@store');
Route::get('/articles/create', 'ArticlesController@create');
Route::get('/articles/{article}', 'ArticlesController@show')->name('articles.show');
Route::get('/articles/{article}/edit', 'ArticlesController@edit');
Route::put('/articles/{article}', 'ArticlesController@update');
