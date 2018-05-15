<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        //require base_path('routes/channels.php');
        /*
            * Authenticate the user's personal channel...
            */
        Broadcast::channel('user-{toUserId}', function ($user, $toUserId) {

            $user->id == $toUserId;
            return $toUserId;
        });
    }
}
