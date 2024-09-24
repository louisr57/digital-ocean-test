<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;
use App\Models\Job;
use App\Models\Calendar;
use App\Http\Controllers\EventsController;


Route::get('/', function () {
    return view('home', ['greeting' => 'It\'s another really beautiful day!']);
});

Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');

Route::get('/events', [EventsController::class, 'index'])->name('events.index');
Route::get('/events/{id}', [EventsController::class, 'show'])->name('events.show');

Route::get('/registrations', [RegistrationController::class, 'index'])->name('registrations.index');
Route::get('/registrations/{registration}', [RegistrationController::class, 'show'])->name('registrations.show');



Route::get('/jobs', function () {
    return view('jobs', [
        'jobs' => Job::all()
    ]);
});

Route::get('/jobs/{id}', function ($id) {

    $job = Job::find($id);

    return view('job', [
        'job' => $job
    ]);
});

Route::get('/contact', function () {
    return view('contact');
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
