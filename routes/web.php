<?php

use Illuminate\Support\Facades\Route;
require __DIR__.'/auth.php';
// ----------------{Shop Routes}-----------------
Route::get('/',\App\Livewire\Front\Home::class)->name('home');
Route::get('/courses',\App\Livewire\Front\Courses::class)->name('courses');
Route::get('/course_details',\App\Livewire\Front\CourseDetails::class)->name('course.details');
Route::middleware('auth')->group(function (){

});




// ------------------------{Admin Routes}----------------------
Route::get('/admin', \App\Livewire\Admin\Panel\Index::class)->name('panel');
Route::get('/admin/users', \App\Livewire\Admin\User\UserList::class)->name('users.index');


