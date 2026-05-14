<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

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
        RateLimiter::for('post-limit', function ($request) {
            return Limit::perMinute(2)->response(function () {
                return response()->json([
                    'status'  => 429,
                    'message' => 'Ups! Kamu sering melakukan aksi, coba tunggu sebentar ya.'
                ], 429);
            });
        });

        RateLimiter::for('interaction-limit', function ($request) {
            return Limit::perMinute(60)->response(function () {
                return response()->json([
                    'status'  => 429,
                    'message' => 'Ups! Kamu sering melakukan aksi, coba tunggu sebentar ya.'
                ], 429);
            });
        });

        RateLimiter::for('posts-limit', function ($request) {
            return Limit::perMinute(60)->response(function () {
                return response()->json([
                    'status'  => 429,
                    'message' => 'Ups! Kamu sering melakukan aksi, coba tunggu sebentar ya.'
                ], 429);
            });
        });
    }
}
