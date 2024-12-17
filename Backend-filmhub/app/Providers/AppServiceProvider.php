<?php

namespace App\Providers;

use App\Models\CategoryPost;
use Illuminate\Support\ServiceProvider;
use App\Models\CategoryPost;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $categoryPost = CategoryPost::where('status', 1)->get();
        view()->share('categoryPost', $categoryPost);
    }
}
