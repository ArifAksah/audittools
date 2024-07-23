<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Share notifications with all views
        View::composer('*', function ($view) {
            $user = Auth::user();

            if ($user) {
                $notifications = Notification::where('user_id', $user->id)
                                             ->where('is_read', 0)
                                             ->orderBy('created_at', 'desc')
                                             ->get();
                
                $unreadNotifications = $notifications->count();

                $view->with([
                    'notifications' => $notifications,
                    'unreadNotifications' => $unreadNotifications
                ]);
            }
        });
    }

    public function register()
    {
        //
    }
}
