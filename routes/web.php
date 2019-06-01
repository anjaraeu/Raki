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
    session(['pending_group' => 'create']);
    return view('welcome');
});

Route::get('/language/{lang}', 'LocaleController@setLocale');
Route::get('/language.json', 'LocaleController@getJSON');

Route::post('/upload', 'DependencyUploadController@uploadFile');
Route::delete('/upload', 'UploadController@deleteFile');
Route::post('/publish', 'UploadController@publishGroup');

Route::get('/f/{slug}', 'DownloadController@getFile')->name('downloadFile');
Route::get('/f/{slug}/check', 'DownloadController@checkFile')->name('checkFile');
Route::get('/f/{slug}/preview', 'DownloadController@previewFile')->name('previewFile');
Route::get('/l/{link}', 'LinkController@handleLink')->name('shortLink');
Route::get('/g/{slug}', 'DownloadController@getGroup')->name('showGroup');
Route::get('/g/{slug}/dl', 'DownloadController@getGroupZip')->name('downloadGroup');

Route::any('/g/{slug}/manage', 'DeleteController@manageGroup')->name('manageGroup');
Route::get('/g/{slug}/delete', 'DeleteController@deleteGroup')->name('deleteGroup');
Route::get('/f/{slug}/delete', 'DeleteController@deleteFile')->name('deleteFile');

Route::get('/legal', 'StaticController@legal')->name('legalPage');
Route::get('/privacy', 'StaticController@privacy')->name('privacyPage');
Route::get('/kb/{article}', 'StaticController@kb')->name('dynamicKb');
Route::get('/manage', 'DeleteController@startManage')->name('startManage');
