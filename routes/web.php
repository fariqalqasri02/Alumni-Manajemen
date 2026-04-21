<?php

use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\CareerEventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TracerStudyController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/lowongan', [JobVacancyController::class, 'index'])->name('jobs.index');
    Route::get('/lowongan/{jobVacancy}', [JobVacancyController::class, 'show'])->name('jobs.show');

    Route::get('/kegiatan', [CareerEventController::class, 'index'])->name('events.index');
    Route::get('/kegiatan/{careerEvent}', [CareerEventController::class, 'show'])->name('events.show');
    Route::post('/kegiatan/{careerEvent}/daftar', [CareerEventController::class, 'register'])->name('events.register');

    Route::resource('tracer-studies', TracerStudyController::class)->except(['destroy']);
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('jobs', JobVacancyController::class)->parameters(['jobs' => 'jobVacancy'])->except(['show']);
    Route::resource('events', CareerEventController::class)->parameters(['events' => 'careerEvent'])->except(['show']);
    Route::resource('tracer-studies', TracerStudyController::class)->only(['index', 'show', 'destroy']);

    Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
    Route::put('/users/{user}', [UserManagementController::class, 'update'])->name('users.update');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export/pdf', [ReportController::class, 'exportPdf'])->name('reports.pdf');
    Route::get('/reports/export/excel', [ReportController::class, 'exportExcel'])->name('reports.excel');
});

require __DIR__.'/auth.php';
