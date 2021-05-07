<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Request;

use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Employee;
use App\Models\ExitForm;
use Session;
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
            $notifys = Session::get('notifys', function() { return array(); });

            if(isset(Auth::user()->id) && Auth::user()->user_type == 'admin' && (strpos(Request::url(), "dashboard") || strpos(Request::url(), "exit-form"))) {
                $user_id = Auth::user()->id;
                $user = User::where('id', $user_id)->first();
                $user_roles = $user->getRoles()->toArray();
                $exit_categories = \Silber\Bouncer\Database\Role::where('form_type', 2)
                                ->whereIn('name', $user_roles)
                                ->with('abilities')
                                ->orderBy('name')
                                ->get();

                $employees = Employee::select('*')
                                ->where('user_type', '=', 'user')
                                ->where('exitdate', '>', date('Y-m-d', strtotime("-1 month")))
                                ->orderBy('exitdate')
                                ->get();

                $cat_abilities = [];
                foreach($user->roles as $role) {
                    foreach($role->abilities as $ability) {
                        $cat_abilities[$role->id][] = $ability->id;
                    }
                }
                
                foreach($employees as $employee) {
                    $i = 0;
                    foreach($user->roles as $role) {
                        $completed_abilities = ExitForm::where('employee_id', $employee->id)->whereIn('ability_id', $cat_abilities[$role->id])->get();

                        if(count($cat_abilities[$role->id]) != count($completed_abilities)) {
                            $notifys[$i]['emp_id'] = $employee->id;
                            $notifys[$i]['cat_name'] = $role->title;
                            $notifys[$i]['emp_name'] = $employee->name;
                            $notifys[$i]['due_date'] = $employee->exitdate;
                        }
                        $i++;
                    }
                }
                
                Session::put('notifys', $notifys);
            }

            View::share('notifys', $notifys);
        });
	
	    Schema::defaultStringLength(191);
    }
}
