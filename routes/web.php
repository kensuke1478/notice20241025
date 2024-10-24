<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\NoticeController;

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


// お知らせTOP画面
Route::get('/notice', [noticeController::class, 'index'])->name('notice.index');

// お知らせ新規登録画面
Route::get('/notice/add',[noticeController::class, 'add'])->name('notice.add');
Route::post('/notice/add',[noticeController::class, 'create'])->name('notice.create');

// お知らせ更新画面
Route::get('/notice/{notice}/edit', [noticeController::class, 'edit'])->name('notice.edit');
Route::put('/notice/{notice}/edit', [noticeController::class, 'update'])->name('notice.update');

// お知らせ削除画面
Route::match(['get','head','post'],'/notice/{notice}', [noticeController::class, 'delete'])->name('notice.delete');
