<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $notifications = collect(); // Collection vide par défaut
            $notificationsCount = 0;   // Compteur à 0 par défaut

            if (Auth::check()) {
                $user = Auth::user();
                $notifications = $user->notifications_envoyees()->orderBy('created_at', 'desc')->get();
                $notificationsCount = $user->notifications_envoyees()->count();
            }

            $view->with('notifications', $notifications)
                 ->with('notificationsCount', $notificationsCount);
        });
    }
}
