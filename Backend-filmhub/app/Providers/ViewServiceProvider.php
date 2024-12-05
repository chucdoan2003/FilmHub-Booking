<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Genre;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Đăng ký các service
     */
    public function register(): void
    {
        //
    }

    /**
     * Boot các service.
     */
    // public function boot(): void
    // {
    //     // Chia sẻ dữ liệu cho header
    //     View::composer('frontend.layouts.header', function ($view) {
    //         $genres = Genre::with(['movies' => function ($query) {
    //             $query->limit(5);
    //         }])->get();


    //         $view->with('genres', $genres);
    //     });
    // }
}
