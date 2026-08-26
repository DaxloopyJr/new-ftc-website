<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use App\Models\Page;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
		Paginator::useBootstrapFive(); 
		
        // Share settings with all views
        View::composer('*', function ($view) {
            try {
                $settings = cache()->remember('site_settings', 3600, function () {
                    return Setting::all()->pluck('value', 'key')->toArray();
                });

                $headerPages = cache()->remember('header_pages', 3600, function () {
                    return Page::where('is_published', true)
                        ->whereNull('parent_id')
                        ->with(['children' => function ($q) {
                            $q->where('is_published', true)->orderBy('sort_order');
                        }])
                        ->orderBy('sort_order')
                        ->get();
                });

                $view->with('siteSettings', $settings);
                $view->with('headerPages', $headerPages);
            } catch (\Exception $e) {
                $view->with('siteSettings', []);
                $view->with('headerPages', collect());
            }
        });
    }
}
