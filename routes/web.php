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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);/*商品一覧画面*/
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);/*商品追加画面*/
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);/*商品追加処理*/
    Route::post('/delete', [App\Http\Controllers\ItemController::class, 'delete']);/*削除ボタン*/
    Route::get('/item', [App\Http\Controllers\ItemController::class, 'item']);
    Route::get('/edit/{id}', [App\Http\Controllers\ItemController::class, 'edit']);/*編集ボタン*/
    Route::post('/update/{id}', [App\Http\Controllers\ItemController::class, 'update']); /*編集反映*/ 
    Route::get('/show', [App\Http\Controllers\ItemController::class, 'show']);/*条件検索画面への遷移*/
});
