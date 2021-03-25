<?php

namespace App\Http\Controllers;

use App\Rules\Filetype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Mail;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*if(Auth::user()->user_type != 'super_admin') {
            $users = User::where('user_type', '<>', 'super_admin')->where('created_by', Auth::user()->id)->orderBy('id')->get();
        } else {
            $users = User::where('user_type', '<>', 'super_admin')->orderBy('id')->get();
        }*/
		$users = User::where('user_type', '<>', 'super_admin')->orderBy('id')->get();

    	return view('admin.user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if($request->isMethod('post')) {

            // $validatedData = $request->validate([
            //     'name' => 'required',
            //     'email' => 'required|email|unique:users,email',
            //     'user_type' => 'required'
            // ]);
			
            // $token = $this->getToken();
            // $user = User::create([
            //     'name'          => $request->name,
            //     'email'         => $request->email,
            //     'phone'         => $request->phone,
            //     'user_type'     => strtolower($request->user_type),
            //     'token'         => $token,
            //     'created_by'    => Auth::user()->id
            // ]);

            // if($user->id) {
            //     $data = array('name'=> $request->name,'email'=> $request->email,'link' => $token);

            //     Mail::send('email.mail', $data, function($message) use($data) {
            //         $message->to($data['email']);
            //         $message->subject('User Activation for Volkswagen');
            //         $message->from(env('MAIL_USERNAME'), 'Volkswagen');
            //     });
                
            //     $request->session()->flash('message', 'User added successfully.');
            //     $request->session()->flash('alert_class', 'success');
            // } else {
            //     $request->session()->flash('message', 'Something went wrong, Please try again!');
            //     $request->session()->flash('alert_class', 'danger');
            // }

        //     return redirect()->intended('manage-user');
        // }

        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->intended('user');
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
        $user = User::find($id);

        // if(empty($user)) {
        //     $request->session()->flash('message', 'Something went wrong, Please try again!');
        //     $request->session()->flash('alert_class', 'danger');

        //     return redirect()->intended('manage-user');
        // }

        // if($request->isMethod('post')) {
        //     $validatedData = $request->validate([
        //         'name' => 'required',
        //         'email' => 'required|email|unique:users,email,'.$user->id,
        //         'user_type' => 'required'
        //     ]);

        //     $user->name = $request->name;
        //     $user->email = $request->email;
        //     $user->phone = $request->phone;
        //     $user->user_type = $request->user_type;

        //     if($user->save()) {
        //         $request->session()->flash('message', 'User updated successfully.');
        //         $request->session()->flash('alert_class', 'success');
        //     } else {
        //         $request->session()->flash('message', 'Something went wrong, Please try again!');
        //         $request->session()->flash('alert_class', 'danger');
        //     }

        //     return redirect()->intended('manage-user');
        // }

        return view('admin.user.edit', ['user' => $user]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
