<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
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
        View::composer('*', function ($view) {
            // Check if the user is logged in
            if (Auth::check()) {
                // Fetch unread notifications
                $notifications = Notification::where('email_pengguna', Auth::user()->email)
                    ->where('is_read', false)
                    ->get();

                // Share notifications data with every view
                $view->with('notifications', $notifications);
            }
        });
    }
}
