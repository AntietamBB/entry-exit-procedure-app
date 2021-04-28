<?php

namespace App\Http\Controllers;
use App\Models\Tasks;

use Illuminate\Http\Request;

class CronController extends Controller
{
    public function task_reminder() {
        $tasks = Tasks::select('*')->where([
                            ['target_date', '>=', date("Y-m-d")],
                            ['status', '=', 0]
                        ])
                        ->with('admin')
                        ->with('employee')
                        ->with('category')
                        ->get();
echo '<pre>';
print_r( $tasks);
exit;

        foreach($tasks as $task) {
            try {
                $dat['email'] = $task->admin->email;
                $dat['name'] = $task->admin->name;
                $dat['category'] = $task->category->title;
                $dat['employee'] = $task->employee->name;
                $dat['date'] = $task->target_date;
                $dat['subject'] = "Antietam Broadband - Alert for your task!";
                Mail::send('email.cron-task-notification', ['name' => $dat['name'], 'email' => $dat['email'], 'category' => $dat['category'], 'employee' => $dat['employee'], 'date' => $dat['date']] ,function ($m) use ($dat){
                    $m->from(env('MAIL_FROM_ADDRESS'), 'Antietam Broadband');
                    $m->to($dat['email'], $dat['name'])->subject($dat['subject']);
                });
            } catch (Exception $e) {
                echo 'Message: ' . $e->getMessage();
            }
        }
    }
}
