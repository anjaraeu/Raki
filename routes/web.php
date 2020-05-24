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
})->name('home');

// Languages for Vue.js
Route::get('/language/{lang}', 'LocaleController@setLocale')->name('lang.set');
Route::get('/language.json', 'LocaleController@getJSON')->name('lang.get');

// Tus endpoint, Files APIs
Route::any('/tus/{any?}', 'TusController@serve')->where('any', '.*');
/*Route::post('/upload', 'DependencyUploadController@uploadFile');
Route::delete('/upload', 'UploadController@deleteFile');*/
Route::post('/sync', 'UploadController@syncFile')->name('file.sync');
Route::post('/publish', 'UploadController@publishGroup')->name('file.publish');

// Download
Route::get('/f/{file}', 'DownloadController@getFile')->name('file.download');
Route::get('/f/{file}/check', 'DownloadController@checkFile')->name('file.check');
Route::get('/f/{file}/preview', 'DownloadController@previewFile')->name('file.preview');
Route::get('/l/{link}', 'LinkController@handleLink')->name('link.handle');
Route::get('/g/{group}', 'DownloadController@getGroup')->name('group.show');
Route::get('/g/{group}/dl', 'DownloadController@getGroupZip')->name('group.download');

// Manage
Route::any('/g/{group}/manage', 'DeleteController@manageGroup')->name('group.manage');
Route::get('/g/{group}/delete', 'DeleteController@deleteGroup')->name('group.delete');
Route::get('/f/{file}/delete', 'DeleteController@deleteFile')->name('file.delete');

// Report
Route::get('/g/{group}/report', 'ReportController@create')->name('report.create');
Route::post('/g/{group}/report', 'ReportController@store')->middleware('throttle:10,1')->name('report.store');

// Static pages
Route::get('/legal', 'StaticController@legal')->name('static.legal');
Route::get('/privacy', 'StaticController@privacy')->name('static.privacy');
Route::get('/kb/{article}', 'StaticController@kb')->name('static.kb');
Route::get('/manage', 'DeleteController@startManage')->name('group.start');

// Auth API
Auth::routes(['verify' => true]);
Route::get('/user', 'UserController@userApi')->name('user.getSelf');

// User dashboard
Route::middleware(['auth:web'])->group(function () {
    Route::get('/dashboard', 'UserController@dashboard')->name('user.dashboard');
});

// Admin
Route::middleware(['auth:web', 'admin'])->group(function() {
    Route::get('/admin', 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('/g/{group}/reports', 'ReportController@show')->name('group.showReports');
    Route::put('/g/{group}/reports', 'ReportController@update')->name('group.updateReports');
});
