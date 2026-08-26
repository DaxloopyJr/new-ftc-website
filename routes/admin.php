<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // Users
    Route::resource('users', Admin\UserController::class);

    // Roles
    Route::resource('roles', Admin\RoleController::class)->only(['index', 'store', 'update', 'destroy']);

    // Pages
    Route::resource('pages', Admin\PageController::class);

    // News
    Route::resource('news', Admin\NewsController::class);

    // Publications
    Route::resource('publications', Admin\PublicationController::class);

    // Info Library
    Route::resource('info-library', Admin\InfoLibraryController::class)->parameters([
        'info-library' => 'info_library'
    ]);

    // Advertisements
    Route::resource('advertisements', Admin\AdvertisementController::class);

    // Media Gallery
    Route::resource('gallery', Admin\MediaGalleryController::class);

    // Hero Slides
    Route::resource('hero-slides', Admin\HeroSlideController::class);
    Route::post('hero-slides/reorder', [Admin\HeroSlideController::class, 'reorder'])->name('hero-slides.reorder');

    // Team Members
    Route::resource('team-members', Admin\TeamMemberController::class);

    // Contacts
    Route::get('contacts', [Admin\ContactController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{id}', [Admin\ContactController::class, 'show'])->name('contacts.show');
    Route::delete('contacts/{id}', [Admin\ContactController::class, 'destroy'])->name('contacts.destroy');

    // Settings
    Route::get('settings', [Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [Admin\SettingController::class, 'update'])->name('settings.update');

    // Reports
    Route::get('reports/visitors', [Admin\ReportController::class, 'visitors'])->name('reports.visitors');
    Route::get('reports/downloads', [Admin\ReportController::class, 'downloads'])->name('reports.downloads');
    Route::get('reports/page-views', [Admin\ReportController::class, 'pageViews'])->name('reports.page-views');
});
