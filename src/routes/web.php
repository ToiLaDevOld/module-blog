<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('news', 'PostController@index')->name('blog.index');