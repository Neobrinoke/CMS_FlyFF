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

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::prefix(LaravelLocalization::setLocale())->middleware(['localeSessionRedirect', 'localizationRedirect'])->group(function () {
    // Home URL
    Route::get('/', 'HomeController@home')->name('home');

    // Auth URL
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register');
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset');

    // Article URL
    Route::get('/articles', 'ArticleController@index')->name('article.index');
    Route::get('/article/{article}-{slug}', 'ArticleController@show')->name('article.show');
    Route::get('/articles/{category}-{slug}', 'ArticleController@categoryIndex')->name('article.category.show');

    // Ranking URL
    Route::get('/ranking/player', 'RankingController@player')->name('ranking.player');
    Route::get('/ranking/guild', 'RankingController@guild')->name('ranking.guild');

    // Guild URL
    Route::get('/guild/{guild}', 'GuildController@show')->name('guild.show');

    // Download URL
    Route::get('/downloads', 'DownloadController@index')->name('download.index');

    // Shop URL
    Route::get('/shops', 'ShopController@index')->name('shop.index');
    Route::get('/shop/{shop}-{slug}', 'ShopController@show')->name('shop.show');
    Route::get('/shop/{shop}/{item}-{slug}', 'ShopController@item')->name('shop.item');

    Route::middleware(['auth'])->group(function () {
        // Shop cart URL
        Route::get('/shop/cart', 'ShopController@cartShow')->name('shop.cart');
        Route::post('/shop/cart/buy', 'ShopController@cartBuy')->name('shop.cart.buy');
        Route::post('/shop/cart/{item}/add', 'ShopController@cartStore')->name('shop.cart.store');
        Route::post('/shop/cart/{item}/update', 'ShopController@cartUpdate')->name('shop.cart.update');
        Route::post('/shop/cart/{item}/remove', 'ShopController@cartDestroy')->name('shop.cart.destroy');

        // Article comment URL
        Route::post('/article/{article}/comment', 'ArticleCommentController@store')->name('article.comment.store');
        Route::post('/article/{article}/comment/{articleComment}/update', 'ArticleCommentController@update')->name('article.comment.update');
        Route::post('/article/{article}/comment/{articleComment}/destroy', 'ArticleCommentController@destroy')->name('article.comment.destroy');
        Route::post('/article/{article}/comment/{articleComment}/response', 'ArticleCommentController@storeResponse')->name('article.comment.response.store');

        // Settings URL
        Route::get('/settings', 'SettingsController@generalIndex')->name('settings.general.index');
        Route::get('/settings/edit', 'SettingsController@generalEdit')->name('settings.general.edit');
        Route::post('/settings/edit', 'SettingsController@generalUpdate')->name('settings.general.update');
        Route::get('/settings/game/accounts', 'SettingsController@gameAccountIndex')->name('settings.game.account.index');
        Route::get('/settings/game/account/create', 'SettingsController@gameAccountCreate')->name('settings.game.account.create');
        Route::post('/settings/game/account/create', 'SettingsController@gameAccountStore')->name('settings.game.account.store');
        Route::get('/settings/game/account/{account}/edit', 'SettingsController@gameAccountEdit')->name('settings.game.account.edit');
        Route::post('/settings/game/account/{account}/edit', 'SettingsController@gameAccountUpdate')->name('settings.game.account.update');
        Route::get('/settings/histories', 'SettingsController@historyIndex')->name('settings.history.index');

        // Ticket URL
        Route::get('/tickets', 'TicketController@index')->name('ticket.index');
        Route::get('/ticket/create', 'TicketController@create')->name('ticket.create');
        Route::post('/ticket/create', 'TicketController@store')->name('ticket.store');
        Route::get('/ticket/{ticket}', 'TicketController@show')->name('ticket.show');
        Route::post('/ticket/{ticket}', 'TicketController@update')->name('ticket.update');
        Route::post('/ticket/{ticket}/response', 'TicketController@storeResponse')->name('ticket.response.store');
        Route::get('/ticket/{ticket}/download/{ticketAttachment}', 'TicketController@download')->name('ticket.download');
    });

    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function () {
        // Auth URL
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');

        Route::middleware(['auth'])->group(function () {
            // Home URL
            Route::get('/', 'HomeController@home')->name('home');

            // Shop URL
            Route::get('/shops', 'ShopController@index')->name('shop.index');
            Route::get('/shop/create', 'ShopController@create')->name('shop.create');
            Route::post('/shop/create', 'ShopController@store')->name('shop.store');
            Route::get('/shop/{shop}', 'ShopController@show')->name('shop.show');
            Route::get('/shop/{shop}/edit', 'ShopController@edit')->name('shop.edit');
            Route::post('/shop/{shop}/edit', 'ShopController@update')->name('shop.update');
            Route::post('/shop/{shop}/destroy', 'ShopController@destroy')->name('shop.destroy');
        });
    });
});
