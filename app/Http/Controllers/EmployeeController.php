<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Employee::select('*')
                    ->where('user_type', '=', 'user')
                    ->get();

        return view('admin.employee.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.employee.create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->isMethod('post')) {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'startdate'=>'required'
            ]);

            $password =  Hash::make('password');
   
            $startdate =  date("Y-m-d",strtotime($request['startdate']));
          
            $user = Employee::create([
                'name'          => $request->name,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'startdate'     => $startdate,
                'exitdate'      => NULL,
                'department'    => $request->department,
                'position'      => $request->position,
                'user_type'     => 'user',
                'password'      => $password,
            ]);
       
            return redirect()->intended('employee');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        // $admin = User::where('user_type','admin')->with('roles')->orderBy('id')->get()->toArray();
        // echo '<pre>';
        // print_r($admin);
        // exit;
	    // $exit_categories = \Silber\Bouncer\Database\Role::where('form_type',2)->select(['id','name','title'])->orderBy('name')->get();
	    // echo '<pre>';
        // print_r($exit_categories);
        // exit;
	    // $tasks = Tasks::where('employee_id', $id)->get()->keyBy('category_id')->toArray();        
		
        return view('admin.employee.edit', ['employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'startdate'=>'required'
        ]);
		
        $startdate=  date("Y-m-d",strtotime($request['startdate']));
   
        $employee = Employee::find($id);

        if(isset($request['exitdate']) && $request['exitdate'] !="") {
            $exitdate=  date("Y-m-d",strtotime($request['exitdate']));
        } else {
            $exitdate = NULL;
        }

        // if(isset($request['taskdate']) && $request['taskdate'] !="") {
        //     $taskdate=  date("Y-m-d",strtotime($request['taskdate']));
        // } else {
        //     $taskdate = NULL;
        // }
        
        $update = $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'startdate' => $startdate,
            'exitdate' => $exitdate,
            //'task_completion_date' => $taskdate,
            'department' => $request->department,
            'position' => $request->position,
        ]);

        /*if($request->taskdate !="") {
            $tasks = [];
            foreach($request->selectadmin as $k=>$admin) { 
                $data = Tasks::select('*')
                                ->where([
                                    ['employee_id', $id],
                                    ['category_id', $k]
                                ])
                                ->with('admin')
                                ->with('employee')
                                ->with('category')
                                ->first();
               
                if(!empty($data)) {
                    if($data->admin_id != $admin[0] && $admin[0] != "") {
                        $update_task = Tasks::updateOrCreate(['id' => $data->id], ['admin_id' => $admin[0]]);

                        try {
                            $dat['email'] = $update_task->admin->email;
                            $dat['name'] = $update_task->admin->name;
                            $dat['category'] = $update_task->category->title;
                            $dat['employee'] = $update_task->employee->name;
                            $dat['date'] = $request->taskdate;
                            $dat['subject'] = "Antietam Broadband - New Task!";

                            Mail::send('email.task-assign-admin', ['name' =>$dat['name'] , 'email' =>$dat['email'], 'category' =>$dat['category'], 'employee' =>$dat['employee'], 'date' =>$dat['date']] ,function ($m) use ($dat){
                                $m->from(env('MAIL_FROM_ADDRESS'), 'Antietam Broadband');
                                $m->to($dat['email'], $dat['name'])->subject($dat['subject']);
                            });
                        } catch (Exception $e) {
                            echo 'Message: ' . $e->getMessage();
                        }
                    } elseif($admin[0] == "") {
                        $data->delete();
                    }
                } else {
                    if($admin[0] != "") {
                        $task = [
                            'employee_id' => $id,
                            'admin_id'    => $admin[0],
                            'category_id' => $k,
                            'target_date' => date("Y-m-d",strtotime($request['taskdate'])),
                            'created_at'  => \Carbon\Carbon::now()->toDateTimeString()
                        ];
                        $insert = Tasks::create($task);
                        
                        if($insert) {
                            try {
                                $dat['email'] = $insert->admin->email;
                                $dat['name'] = $insert->admin->name;
                                $dat['category'] = $insert->category->title;
                                $dat['employee'] = $insert->employee->name;
                                $dat['date'] = $request->taskdate;
                                $dat['subject'] = "Antietam Broadband - New Task!";

                                Mail::send('email.task-assign-admin', ['name' =>$dat['name'] , 'email' =>$dat['email'], 'category' =>$dat['category'], 'employee' =>$dat['employee'], 'date' =>$dat['date']] ,function ($m) use ($dat){
                                    $m->from(env('MAIL_FROM_ADDRESS'), 'Antietam Broadband');
                                    $m->to($dat['email'], $dat['name'])->subject($dat['subject']);
                                });
                            } catch (Exception $e) {
                                echo 'Message: ' . $e->getMessage();
                            }

                            // if (count(Mail::failures()) > 0) {
                            //     return redirect('employee')->with('error', 'Error');
                            // }
                        }
                    }   
                } 
           }
        } else {
            Tasks::where('employee_id', $id)->delete();
        } */

        return redirect()->intended('employee');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::destroy($id);
		
        return redirect()->intended('employee');
    }

    /**
     * FIlter According to Active/Inactive.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filter_data(Request $request)
    {
        $status = $request->status;
        $keyword = $request->keyword;

        if($status == 'active') {
            $operator = '=';
            $val = null;
        } elseif($status == 'inactive') {
            $operator = '!=';
            $val = null;
        }
        
        $users = Employee::select('*')->where('user_type', '=', 'user');

        if($status == 'active' || $status == 'inactive') {
            $users->where('exitdate',$operator,$val);
        }

        if($keyword != '') {
            $users->where(function($query) use ($keyword){
                $query->orWhere('name', 'LIKE', '%'.$keyword.'%');
                $query->orWhere('email', 'LIKE', '%'.$keyword.'%');
            });
        }

        $users_list = $users->get();

        return view('admin.employee.index-filter', ['users' => $users_list]);
    }
}
