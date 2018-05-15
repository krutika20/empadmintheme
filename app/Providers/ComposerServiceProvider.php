<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use Illuminate\Support\Facades\View;
use Illuminate\Contracts\View\Factory as ViewFactory;


class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer(
            'employees.form',
            'App\Http\ViewComposers\DepartmentComposer'
        );


        /* You can compose in thi way also - like you don't need to create composer class and directly bind data here */
        view()->composer('welcome', function($view){

            // Then try dd('something') here to see if the composer is run when including the view
            $view->with('count_test','testing'); 
        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

        
}
