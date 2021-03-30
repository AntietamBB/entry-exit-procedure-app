<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$user = Employee::select('*')->from('users')->get();
        return view('admin.employee.index', ['user'=>$user]);
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
             'phone' => 'required',
             ]);
			
          
             $user = Employee::create([
                 'name'          => $request->name,
                 'email'         => $request->email,
                 'phone'         => $request->phone,
                 'user_type'     => 'user',
                 'password'=>'password',
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
    
        $employee=DB::select('select * from users where id=?',[$id]);
        return view('admin.employee.edit',['employee'=>$employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        
        $id=$request->input('id');
        $name=$request->input('name');
        $email=$request->input('email');
        $phone=$request->input('phone');
   
        DB::update('update users set name=?,email=?,phone=? where id=?',[$name,$email,$phone,$id]);
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
           
        $user=DB::delete('delete from users where id=?',[$id]);
       
        return redirect()->intended('employee');
    }
}
