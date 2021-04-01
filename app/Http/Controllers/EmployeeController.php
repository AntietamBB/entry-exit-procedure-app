<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use DateTime;
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
                  $data=$request->all();
                  
               
        if ($request->isMethod('post')) {
         
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|digits:10',
                'startdate'=>'required',
                'department'=>'required',
                'position'=>'required'
            ]);
          
         
           
            
            $date1=  date("Y-m-d",strtotime($request['startdate']));
      print_r($date1);
    
        exit(); 
            $user = Employee::create([

                'name'          => $request->name,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'startdate'     =>$date1,
                'department'    =>$request->department,
                'position'      =>$request->position,
                'user_type'     => 'user',
                'password'      => 'password',
               
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
            'phone' => 'required|digits:10',
            'startdate'=>'required',
            'department'=>'required',
            'position'=>'required'
        ]);
        $date1=  date("Y-m-d",strtotime($request['startdate']));
      
        $employee = Employee::find($id);
        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'startdate'     =>$date1,
            'department'    =>$request->department,
            'position'      =>$request->position,
        ]);
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
}
