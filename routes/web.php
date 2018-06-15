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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Home URL
Route::get('/', 'HomeController@home')->name('home');

// Article URL
Route::get('/articles', 'ArticleController@index')->name('article.index');
Route::get('/article/{article}-{slug?}', 'ArticleController@show')->name('article.show');

// Ranking URL
Route::get('/ranking/player', 'RankingController@player')->name('ranking.player');
Route::get('/ranking/guild', 'RankingController@guild')->name('ranking.guild');

// Guild URL
Route::get('/guild/{guild}', 'GuildController@show')->name('guild.show')->where('id', '[0-9]+');

Route::group(['middleware' => 'auth'], function () {
	// Article comment URL
	Route::post('/article/{article}/comment', 'ArticleCommentController@store')->name('article.comment.store');
	Route::post('/article/{article}/comment/{articleComment}/update', 'ArticleCommentController@update')->name('article.comment.update');
	Route::post('/article/{article}/comment/{articleComment}/destroy', 'ArticleCommentController@destroy')->name('article.comment.destroy');
});