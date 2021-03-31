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
		$users = User::where('user_type','admin')->with('roles')->orderBy('id')->get();
    	return view('admin.user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entry_categories = \Silber\Bouncer\Database\Role::where('form_type',1)->select(['id','name','title'])->orderBy('name')->get();
        $exit_categories = \Silber\Bouncer\Database\Role::where('form_type',2)->select(['id','name','title'])->orderBy('name')->get();
        return view('admin.user.create',['entry_categories' => $entry_categories,'exit_categories' => $exit_categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits:10'
        ]);
        $password =  Hash::make('password');
        $user = User::create([
            'user_type' => 'admin',
            'name'=> $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $password,
        ]);
        if(isset($request->category)){
            $categories = $request->category;
            foreach($categories as $category){
                $user->assign($category);
            }
        }
        
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
        $categories = $user->getRoles()->toArray();
        $exit_categories = \Silber\Bouncer\Database\Role::where('form_type',2)->select(['id','name','title'])->orderBy('name')->get();
        $entry_categories = \Silber\Bouncer\Database\Role::where('form_type',1)->select(['id','name','title'])->orderBy('name')->get();

        return view('admin.user.edit', ['user' => $user,'categories' => $categories,'exit_categories' => $exit_categories,'entry_categories' => $entry_categories]);
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
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required|digits:10'
        ]);
        $user = User::find($id);
        $user->update([
            'name'=> $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        $old_categories = $user->getRoles()->toArray();
        foreach($old_categories as $category){
            $user->retract($category);
        }
        if(isset($request->category)){
            $new_categories = $request->category;
            foreach($new_categories as $category){
                $user->assign($category);
            }
        }
        
        return redirect()->intended('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       User::destroy($id);
       return redirect()->intended('user');
    }
}
