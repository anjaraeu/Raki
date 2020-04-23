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
    session(['pending_group' => 'create', 'pending_files' => []]);
    return view('welcome');
});

Route::get('/sessiondump', function () {
    dd(session()->all());
});

// Languages for Vue.js
Route::get('/language/{lang}', 'LocaleController@setLocale');
Route::get('/language.json', 'LocaleController@getJSON');

// Tus endpoint, Files APIs
Route::any('/tus/{any?}', 'TusController@serve')->where('any', '.*');
/*Route::post('/upload', 'DependencyUploadController@uploadFile');
Route::delete('/upload', 'UploadController@deleteFile');*/
Route::post('/sync', 'UploadController@syncFile');
Route::post('/publish', 'UploadController@publishGroup');

// Download
Route::get('/f/{file}', 'DownloadController@getFile')->name('downloadFile');
Route::get('/f/{file}/check', 'DownloadController@checkFile')->name('checkFile');
Route::get('/f/{file}/preview', 'DownloadController@previewFile')->name('previewFile');
Route::get('/l/{link}', 'LinkController@handleLink')->name('shortLink');
Route::get('/g/{group}', 'DownloadController@getGroup')->name('showGroup');
Route::get('/g/{group}/dl', 'DownloadController@getGroupZip')->name('downloadGroup');

// Manage
Route::any('/g/{group}/manage', 'DeleteController@manageGroup')->name('manageGroup');
Route::get('/g/{group}/delete', 'DeleteController@deleteGroup')->name('deleteGroup');
Route::get('/f/{group}/delete', 'DeleteController@deleteFile')->name('deleteFile');

// Report
Route::get('/g/{group}/report', 'ReportController@create')->name('reportGroup');
Route::post('/g/{group}/report', 'ReportController@store')->name('reportGroup.post');

// Static pages
Route::get('/legal', 'StaticController@legal')->name('legalPage');
Route::get('/privacy', 'StaticController@privacy')->name('privacyPage');
Route::get('/kb/{article}', 'StaticController@kb')->name('dynamicKb');
Route::get('/manage', 'DeleteController@startManage')->name('startManage');

// Auth API
Auth::routes(['verify' => true]);
Route::get('/user', 'UserController@userApi');

// User dashboard
Route::middleware(['auth:web'])->group(function () {
    Route::get('/dashboard', 'UserController@dashboard')->name('user.dashboard');
});

// Admin
Route::middleware(['auth:web', 'admin'])->group(function() {
    Route::get('/admin', 'AdminController@dashboard')->name('admin.dashboard');
});
