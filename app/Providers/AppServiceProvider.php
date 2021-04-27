<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Tasks;
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
        view()->composer('*', function ($view) 
        {
            if(isset(Auth::user()->id)) {
                $notifys = Tasks::select('*')
                            ->where([
                                    ['admin_id', Auth::user()->id],
                                    ['status','=','0']
                                    ])
                            ->with('admin')
                            ->with('employee')
                            ->with('category')
                            ->get();
                
                View::share('notifys', $notifys);
            }
        });
	
	Schema::defaultStringLength(191);
    }
}
