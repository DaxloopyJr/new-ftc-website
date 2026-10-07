<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\InfoLibraryController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;

use App\Http\Controllers\Admin;

// Frontend Routes with visitor tracking
Route::middleware(['track.visitors'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
	Route::get('/system', [HomeController::class, 'admin'])->name('admin');
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');
    Route::get('/announcements', [NewsController::class, 'announcements'])->name('announcements.index');
    Route::get('/publications', [PublicationController::class, 'index'])->name('publications.index');
    Route::get('/publications/{slug}', [PublicationController::class, 'show'])->name('publications.show');
    Route::get('/publications/{slug}/download', [PublicationController::class, 'download'])->name('publications.download');
    Route::get('/info-library', [InfoLibraryController::class, 'index'])->name('info-library.index');
    Route::get('/info-library/{slug}', [InfoLibraryController::class, 'show'])->name('info-library.show');
    Route::get('/info-library/{slug}/download', [InfoLibraryController::class, 'download'])->name('info-library.download');
    Route::get('/team', [TeamMemberController::class, 'index'])->name('team.index');
    Route::get('/team/{id}', [TeamMemberController::class, 'show'])->name('team.show');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('/{slug}', [PageController::class, 'show'])->name('pages.show');
});


// Auth Routes (Laravel Breeze - if installed, these will be added by the package)
// For now, we'll include basic auth routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Admin pannel access

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
