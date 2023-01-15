<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\CategoryController;


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

// The comment indicates what is below it

Route::get('/', function () {
    return view('welcome');
});
//-----------------------------------------------------------------
// show book with id - url - function in BookContorller = show  
Route::get('/books/getname/{a}', [BookController::class,'getName']);
//-----------------------------------------------------------------

Route::middleware('isadmin')->group(function(){
Route::get('/books/create', [BookController::class,'create']);// create new book  
Route::post('/books/store', [BookController::class,'store']);
Route::get('/books/edit/{id}', [BookController::class,'edit']);//update book
Route::post('/books/update/{id}', [BookController::class,'update']);
Route::get('/books/delete/{id}', [BookController::class,'delete']);//delete book

Route::get('/categories/list', [CategoryController::class,'list']);
Route::post('/categories/save', [CategoryController::class,'save']);

});

Route::middleware('isloggedin')->group(function(){
Route::get('/books/list', [BookController::class,'list']);//show all book
Route::get('/books/show/{id}', [BookController::class,'show']);
Route::get('/users/logout',[UserController::class,'logout']);
Route::get('/users/notes',[NoteController::class,'notes']);
Route::post('/users/savenotes',[NoteController::class,'savenotes']);

});

Route::get('/users/register', [UserController::class,'register']);//register
Route::post('/users/save',[UserController::class,'save']);
Route::get('/users/login', [UserController::class,'login']);//login
Route::post('/users/handlelogin',[UserController::class,'handlelogin']);
Route::get('notauth',function(){
    return 'you dont have a permison to visit this page';
});