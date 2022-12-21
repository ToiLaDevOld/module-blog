<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('blog', 'PostController@index')->name('blog.index');
Route::get('blog/'.config('app.cast_page_prefix').'{page}', 'PostController@index')->name('blog.page')->where('page', '[0-9]+');