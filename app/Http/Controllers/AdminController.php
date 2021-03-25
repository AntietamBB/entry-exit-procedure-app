<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\Filetype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Mail;

class AdminController extends Controller
{
    public function index() {
    	return view('admin.dashboard');
    }

    public function add_user(Request $request) {
        if($request->isMethod('post')) {

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

            return redirect()->intended('manage-user');
        }

        return view('admin.add-user');
    }

    public function edit_user(Request $request, $id = null) {
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

        return view('admin.edit-user', ['user' => $user]);
    }

    public function delete_user(Request $request, $id = null) {
        
        if($id == null) {
            $request->session()->flash('message', 'Something went wrong, Please try again!');
            $request->session()->flash('alert_class', 'danger');
            
            return redirect()->intended('manage-user');
        }

        $user = User::find($id);

        if(!empty($user) && $user->delete()) {
            $request->session()->flash('message', 'User deleted successfully.');
            $request->session()->flash('alert_class', 'success');
        } else {
            $request->session()->flash('message', 'Something went wrong, Please try again!');
            $request->session()->flash('alert_class', 'danger');
        }

        return redirect()->intended('manage-user');
    }

    public function manage_employees() {
    	return view('admin.manage-employees', []);
    }

    public function add_employee(Request $request) {
        if($request->isMethod('post')) {
            return redirect()->intended('manage-employees');
        }
        
        return view('admin.add-employee', []);
    }

    public function edit_employee(Request $request, $id = null) {
        return view('admin.edit-employee', []);
    }

    public function entry_form(Request $request, $id = null) {
        return view('admin.entry-form', []);
    }

    public function exit_form(Request $request, $id = null) {
        return view('admin.exit-form', []);
    }
    
    protected function getToken() {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }
	
	public function profile() {
    	return view('admin.profile');
    }
	
	public function change_password(Request $request) {

        if($request->isMethod('post')) {

            $validatedData = $request->validate([
                'password' => 'required|confirmed',
                'password_confirmation' => 'required'
            ]);

            $user = User::find(Auth::user()->id);

            $user->password = Hash::make($request->password);

            if($user->save()) {
                $request->session()->flash('message', 'Password updated successfully.');
                $request->session()->flash('alert_class', 'success');
            } else {
                $request->session()->flash('message', 'Something went wrong, Please try again!');
                $request->session()->flash('alert_class', 'danger');
            }

            return redirect()->intended('profile');
        }

    	return view('admin.change-password');
    }

    public function update_profile(Request $request) {

        if($request->isMethod('post')) {

            $validatedData = $request->validate([
                'name' => 'required',
                'phone' => 'required'
            ]);

            $user = User::find(Auth::user()->id);

            $user->name = $request->name;
            $user->phone = $request->phone;

            if($user->save()) {
                $request->session()->flash('message', 'Profile updated successfully.');
                $request->session()->flash('alert_class', 'success');
            } else {
                $request->session()->flash('message', 'Something went wrong, Please try again!');
                $request->session()->flash('alert_class', 'danger');
            }

            return redirect()->intended('profile');

        }

        return view('admin.update-profile');
    }
	
    public function user_activation($token) {
        $verifyUser = user::where('token', $token)->first();
		$token = '';
		$error = '';
        
		if($verifyUser) {
            $token = $verifyUser->token;
        } else {
            $error = 'Your Link is expired. Please contact admin for more details';
        }
		return view('frontend.resetpassword',["token"=>$token, "error"=>$error]);
    }

    public function passwordsetting(Request $request) {
        if($request->isMethod('post')) {
            $validatedData = $request->validate([
                'password' => 'min:6|required_with:cnf_password|same:cnf_password',
                'cnf_password-password' => 'min:6'
            ]);
			
            $user = user::where('token', $request->token)->first();
            
			if($user) {
				$user->password = Hash::make($request->password);
				$user->token = "";
	
				if($user->save()) {
					return redirect('/sign-in')->with('password_update', 'Your password is set');
				}
			}
        }
    }
	
    public function resetpassword() {
        return view('frontend.resetpassword');
    }
	
    public function forgot_password(Request $request) {
        if($request->isMethod('post')) {
            if($request->user_email != '') {
				$user = user::where('email', $request->user_email)->first();
				
				if($user) {
					if(!empty($user->password)){
						$token = $this->getToken();
						$user->token = $token;
						
						if($user->save()) {
							$data = array('name'=> $user->name,'email'=> $user->email,'link' => $user->token);
	
							Mail::send('email.forgot_pass', $data, function($message) use($data) {
								$message->to($data['email']);
								$message->subject('Password reset for Volkswagen');
								$message->from(env('MAIL_USERNAME'), 'Volkswagen');
							});
							return redirect('/forgot_password')->with('forgot_message_sucess', 'Your password reset link is sent to your email id');
						}
					} else {
						return redirect('/forgot_password')->with('forgot_message', 'Your account is not activated !');
					} 
				} else {
					return redirect('/forgot_password')->with('forgot_message', 'There is no user found with this email !');
				}
			} else {
				return redirect('/forgot_password')->with('forgot_message', 'Email field is required !');
			}
        }
		
        return view('frontend.forgotpassword');
    }
}
