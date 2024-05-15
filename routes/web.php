<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/', [ProfileController::class, 'home'])->middleware(['auth']);
Route::get('/dashboard', [ProfileController::class, 'home'])->name('dashboard')->middleware(['auth']);


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admindashboard', [ProfileController::class, 'indexadmin'])->name('admindashboard');
});




// Route::get('/dashboard', function () {
//     return view('index');
// })->name('dashboard');
Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware(['auth']);



Route::get('about', function () {
    return view('about_us');
})->middleware(['auth']);

Route::get('/services', function () {
    return view('services');
})->middleware(['auth']);

Route::get('/contact', function () {
    return view('contact');
})->middleware(['auth']);

Route::get('/resume', function () {
    return view('resumeBuilder');
})->name('resume.view')->middleware(['auth']);
Route::get('/resume-builder', function () {
    return view('resumeBuilder'); // Assuming your view file is in the resources/views directory
})->name('resume.builder')->middleware(['auth']);



Route::get('/job_recommendation', function () {
    return view('job_recommendation');
})->middleware(['auth']);
Route::get('/job_recommendation2', function () {
    return view('job_recommendation2');
})->middleware(['auth']);

Route::get('/uploadResume', function () {
    return view('uploadResume');
})->middleware(['auth']);

Route::post('/uploadResume', [ProfileController::class, 'uploadResume'])->middleware(['auth']);

Route::get('/jobRecommendationDB', [ProfileController::class, 'jobRecommendationDB'])->middleware(['auth']);


Route::get('/jobs', [ProfileController::class, 'jobs'])->middleware(['auth']);




Route::get('/mockinterview', [ProfileController::class, 'mockinterview'])->middleware(['auth']);

Route::get('/create', [ProfileController::class, 'create'])->middleware(['auth']);
Route::post('/mockinterview', [ProfileController::class, 'store'])->middleware(['auth']);

Route::get('/view', [ProfileController::class, 'view'])->middleware(['auth']);

Route::get('/search', [ProfileController::class, 'search'])->middleware(['auth'])->name('search');

Route::get('/manageusers', [ProfileController::class, 'manageusers'])->middleware(['auth']);

Route::post('/changetype/{id}', [ProfileController::class, 'changetype'])->name('changetype');
Route::delete('/manageusers/{id}', [ProfileController::class, 'manageusers'])->name('manageusers');



Route::get('/searchmiadmin', [ProfileController::class, 'searchmiadmin'])->middleware(['auth']);


Route::get('/moi', [ProfileController::class, 'moi']);
