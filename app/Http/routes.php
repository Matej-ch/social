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

// TODO add sweetAlert messages + notify is needed
// TODO add captcha
// TODO add relationship
// TODO add 2 games (snake + balloons)
// TODO improve interface, so id doesn't look so much like bootstrap
//TODO add live chat
//TODO weather forecast
//TODO test if works

/**
Home
 */
Route::get('/', ['uses' => '\Social\Http\Controllers\HomeController@index',
                    'as' => 'home',]);

Route::get('/alert', function(){
    return redirect()->route('home')->with('info','You have signed up');
});

/**
Authentication
 */
Route::get('/signup', [
    'uses' => '\Social\Http\Controllers\AuthController@getSignup',
    'as' => 'auth.signup',
    'middleware'=>['guest']
]);

Route::post('/signup', [
    'uses' => '\Social\Http\Controllers\AuthController@postSignup',
    'middleware'=>['guest']
    ]);

Route::get('/signin', [
    'uses' => '\Social\Http\Controllers\AuthController@getSignin',
    'as' => 'auth.signin','middleware'=>['guest']]);

Route::post('/signin', [
    'uses' => '\Social\Http\Controllers\AuthController@postSignin',
    'middleware'=>['guest']
]);

Route::get('/signout', [
    'uses' => '\Social\Http\Controllers\AuthController@getSignout',
    'as' => 'auth.signout',
]);

/**
SEARCH

 */

Route::get('/search', [
    'uses' => '\Social\Http\Controllers\SearchController@getResults',
    'as' => 'search.results',
]);

/**
User Profile
 */
Route::get('/user/{username}', [
    'uses' => '\Social\Http\Controllers\ProfileController@getProfile',
    'as' => 'profile.index',
]);

Route::get('/profile/edit', [
    'uses' => '\Social\Http\Controllers\ProfileController@getEdit',
    'as' => 'profile.edit',
    'middleware'=>['auth']
]);

Route::post('/profile/edit', [
    'uses' => '\Social\Http\Controllers\ProfileController@postEdit',
    'middleware'=>['auth']
]);

/**
Friends
 */
Route::get('/friends', [
    'uses' => '\Social\Http\Controllers\FriendController@getIndex',
    'as' => 'friends.index',
    'middleware'=>['auth']
]);

Route::get('/friends/add/{username}', [
    'uses' => '\Social\Http\Controllers\FriendController@getAdd',
    'as' => 'friends.add',
    'middleware'=>['auth']
]);

Route::get('/friends/accept/{username}', [
    'uses' => '\Social\Http\Controllers\FriendController@getAccept',
    'as' => 'friends.accept',
    'middleware'=>['auth']
]);

/**
 * Status
 *
*/

Route::post('/status', [
    'uses' => '\Social\Http\Controllers\StatusController@postStatus',
    'as' => 'status.post',
    'middleware'=>['auth']
]);

Route::post('/status/{statusId}/reply', [
    'uses' => '\Social\Http\Controllers\StatusController@postReply',
    'as' => 'status.reply',
    'middleware'=>['auth']
]);

Route::get('/status/{statusId}/like', [
    'uses' => '\Social\Http\Controllers\StatusController@getLike',
    'as' => 'status.like',
    'middleware'=>['auth']
]);