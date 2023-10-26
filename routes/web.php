<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/home', [\App\Http\Controllers\HomeController::class,'home'])->name('home');

Route::get('/aboutMe', [\App\Http\Controllers\AboutMeController::class,'index'])->name('aboutMe');

Route::get('/feedback', [\App\Http\Controllers\FeedbackController::class,'index'])->name('feedback');
Route::post('/feedback', [\App\Http\Controllers\FeedbackController::class,'store'])->name('feedback.store');

Route::get('/gallery', [\App\Http\Controllers\GalleryController::class,'index'])->name('gallery');

Route::get('/history', [\App\Http\Controllers\HistoryController::class,'index'])->name('history');

Route::get('/hobbies', [\App\Http\Controllers\HobbiesController::class,'index'])->name('hobbies');

Route::get('/study', [\App\Http\Controllers\StudyController::class,'index'])->name('study');

Route::get('/test', [\App\Http\Controllers\TestController::class,'index'])->name('test');
Route::post('/test', [\App\Http\Controllers\TestController::class,'store'])->name('test.store');

Route::get('/guestBook', [\App\Http\Controllers\GuestBookController::class,'index'])->name('guestBook');
Route::post('/guestBook', [\App\Http\Controllers\GuestBookController::class,'store'])->name('guestBook.store');

Route::get('/myBlog', [\App\Http\Controllers\MyBlogController::class,'index'])->name('myBlog');
Route::post('/myBlog/storeComment', [\App\Http\Controllers\MyBlogController::class,'storeComment'])->name('storeComment');


Route::get('/admin/home', [\App\Http\Controllers\HomeController::class,'adminHome'])->name('admin.adminHome')->middleware('checkIfAdmin');

Route::get('/admin/guestBookUpload', [\App\Http\Controllers\GuestBookUploadController::class,'index'])->name('admin.guestBookUpload')->middleware('checkIfAdmin');
Route::post('/admin/guestBookUpload', [\App\Http\Controllers\GuestBookUploadController::class,'upload'])->name('admin.guestBookUpload.upload')->middleware('checkIfAdmin');

Route::get('/admin/myBlogEditor', [\App\Http\Controllers\myBlogEditorController::class,'index'])->name('admin.myBlogEditor')->middleware('checkIfAdmin');
Route::post('/admin/myBlogEditor', [\App\Http\Controllers\myBlogEditorController::class,'store'])->name('admin.myBlogEditor.store')->middleware('checkIfAdmin');
Route::get('/admin/myBlogEditor', [\App\Http\Controllers\myBlogEditorController::class,'index'])->name('admin.myBlogEditor')->middleware('checkIfAdmin');
Route::post('/admin/myBlogEditor/store', [\App\Http\Controllers\myBlogEditorController::class,'store'])->name('admin.myBlogEditor.store')->middleware('checkIfAdmin');
Route::put('/admin/myBlogEditor/storeXML', [\App\Http\Controllers\myBlogEditorController::class,'storeXML'])->name('admin.myBlogEditor.storeXML');
Route::put('/admin/myBlogEditor/update', [\App\Http\Controllers\myBlogEditorController::class,'update'])->name('admin.myBlogEditor.update')->middleware('checkIfAdmin');
Route::get('/admin/myBlogEditor/delete/{postId}', [\App\Http\Controllers\myBlogEditorController::class,'delete'])->name('admin.myBlogEditor.delete')->middleware('checkIfAdmin');


Route::get('/admin/myBlogUpload', [\App\Http\Controllers\MyBlogUploadController::class,'index'])->name('admin.myBlogUpload')->middleware('checkIfAdmin');
Route::post('/admin/myBlogUpload', [\App\Http\Controllers\MyBlogUploadController::class,'upload'])->name('admin.myBlogUpload.upload')->middleware('checkIfAdmin');
Route::get('/admin/myBlogDownload', [\App\Http\Controllers\MyBlogUploadController::class,'download'])->name('admin.myBlogUpload.download')->middleware('checkIfAdmin');

Route::get('/admin/visitors', [\App\Http\Controllers\VisitorController::class,'index'])->name('admin.visitors')->middleware('checkIfAdmin');

Route::get('/editor/home', [\App\Http\Controllers\HomeController::class,'editorHome'])->name('editor.editorHome')->middleware('checkIfAdmin');

Route::get('/editor/myBlogEditor', [\App\Http\Controllers\myBlogEditorController::class,'editorMyBlogEditor'])->name('editor.editorMyBlogEditor')->middleware('checkIfAdmin');
Route::post('/editor/myBlogEditor', [\App\Http\Controllers\myBlogEditorController::class,'store'])->name('editor.myBlogEditor.store')->middleware('checkIfAdmin');


Route::get('/authentication', [\App\Http\Controllers\AuthController::class,'authentication'])->name('authentication');
Route::get('/registration', [\App\Http\Controllers\AuthController::class,'registration'])->name('registration');
Route::post('/authenticate', [\App\Http\Controllers\AuthController::class,'authenticate']) ->name("authenticate");
Route::post('/register', [\App\Http\Controllers\AuthController::class,'register']) ->name("register");

Route::get('/logout', [\App\Http\Controllers\AuthController::class,'logout']) ->name("logout");
Route::get('/registration/checkEmail', [\App\Http\Controllers\AuthController::class,'checkEmail'])->name('checkEmail');
