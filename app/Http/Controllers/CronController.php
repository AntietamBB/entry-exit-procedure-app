<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Models\Employee;
use App\Models\User;
use App\Models\ExitForm;

class CronController extends Controller
{
    public function daily_reminder() {
        $exit_categories = \Silber\Bouncer\Database\Role::where('form_type', 2)
                        ->with('abilities')
                        ->orderBy('name')
                        ->get();

        $users = User::select('*')
                        ->where('user_type', '=', 'admin')
                        ->get();
                        
        $employees = Employee::select('*')
                        ->where('user_type', '=', 'user')
                        ->where('exitdate', '>', date('Y-m-d', strtotime("-1 month")))
                        ->orderBy('exitdate')
                        ->get();

        $cat_abilities = [];
        foreach($exit_categories as $category) {
            foreach($category->abilities as $ability) {
                $cat_abilities[$category->id][] = $ability->id;
            }
        }

        $incomplete_employee_categories = array();

        foreach($employees as $employee) {
            foreach($exit_categories as $role) {
                $completed_abilities = ExitForm::where('employee_id', $employee->id)->whereIn('ability_id', $cat_abilities[$role->id])->get();
                if(count($cat_abilities[$role->id]) != count($completed_abilities)) {
                    $incomplete_employee_categories[$role->id][] = $employee;
                }
            }
        }

        foreach($users as $user) {
            $user_tasks = array();
            $i = 0;
            foreach($user->roles as $rle) {
                if(isset($incomplete_employee_categories[$rle->id])) {
                    foreach($incomplete_employee_categories[$rle->id] as $empl) {
                        $user_tasks[$i]['category_name'] = $rle->title;
                        $user_tasks[$i]['employee_name'] = $empl->name;
                        $user_tasks[$i]['date'] = $empl->exitdate;
                        $i++;
                    }
                }
            }
            
            try {
                $dat['email'] = $user->email;
                $dat['name'] = $user->name;
                $dat['subject'] = "Antietam Broadband - Pending Tasks!";

                Mail::send('email.cron-daily-notification', ['name' => $dat['name'], 'data_list' => $user_tasks] ,function ($m) use ($dat){
                    $m->from(env('MAIL_FROM_ADDRESS'), 'Antietam Broadband');
                    $m->to($dat['email'], $dat['name'])->subject($dat['subject']);
                });
            } catch (Exception $e) {
                echo 'Message: ' . $e->getMessage();
            }
        }
    }

    public function hourly_reminder() {
        $exit_categories = \Silber\Bouncer\Database\Role::where('form_type', 2)
                        ->with('abilities')
                        ->orderBy('name')
                        ->get();

        $users = User::select('*')
                        ->where('user_type', '=', 'admin')
                        ->get();
                
        $employees = Employee::select('*')
                        ->where('user_type', '=', 'user')
                        ->where('exitdate', '>', date('Y-m-d', strtotime("-1 month")))
                        ->where('send_reminder', '=', 'hourly')
                        ->orderBy('exitdate')
                        ->get();

        $cat_abilities = [];
        foreach($exit_categories as $category) {
            foreach($category->abilities as $ability) {
                $cat_abilities[$category->id][] = $ability->id;
            }
        }

        $incomplete_employee_categories = array();

        foreach($employees as $employee) {
            foreach($exit_categories as $role) {
                $completed_abilities = ExitForm::where('employee_id', $employee->id)->whereIn('ability_id', $cat_abilities[$role->id])->get();
                if(count($cat_abilities[$role->id]) != count($completed_abilities)) {
                    $incomplete_employee_categories[$role->id][] = $employee;
                }
            }
        }
        
        foreach($users as $user) {
            $user_tasks = array();
            foreach($user->roles as $rle) {
                if(isset($incomplete_employee_categories[$rle->id])) {
                    foreach($incomplete_employee_categories[$rle->id] as $empl) {
                        $user_tasks[$empl->id]['employee'] = $empl;
                        $user_tasks[$empl->id]['categories'][] = $rle->title;
                    }
                }
            }
            
            foreach($user_tasks as $task) {
                try {
                    $dat['email'] = $user->email;
                    $dat['name'] = $user->name;
                    $dat['subject'] = "Antietam Broadband - Pending Task for ".$task['employee']->name."!";

                    Mail::send('email.cron-hourly-notification', ['name' => $dat['name'], 'employee_name' => $task['employee']->name, 'date' => $task['employee']->exitdate, 'data_list' => $task['categories']] ,function ($m) use ($dat){
                        $m->from(env('MAIL_FROM_ADDRESS'), 'Antietam Broadband');
                        $m->to($dat['email'], $dat['name'])->subject($dat['subject']);
                    });
                } catch (Exception $e) {
                    echo 'Message: ' . $e->getMessage();
                }
            }
        }
    }
}
