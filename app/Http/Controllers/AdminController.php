<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\User;
use App\Models\EntryForm;
use App\Models\ExitForm;
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
        $count=0;
        $admin = Employee::select('*')
        ->where('user_type', '=', 'admin')
        ->get();
        $users = Employee::select('*')
        ->where('user_type', '=', 'user')
        ->get();
    	return view('admin.dashboard',['users'=>$users,'admin'=>$admin]);
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
        $user_id = Auth::id();
        $user = User::find($user_id);
        $employee = User::find($id);
        $entry_categories = \Silber\Bouncer\Database\Role::where('form_type',1)->with('abilities')->orderBy('name')->get();
        $employee_abilities = EntryForm::where('employee_id',$id)->with('user')->get()->toArray();
        $user_categories = $user->getRoles()->toArray();
        return view('admin.entry-form', [
            'categories' => $entry_categories,
            'user_categories' => $user_categories,
            'employee_abilities' => $employee_abilities,
            'user' => $user,
            'employee' => $employee,
        ]);
    }

    public function entry_form_save(Request $request, $id = null){
        $user_id = Auth::id();
        $user = User::where('id',$user_id)->first();
        $user_abilitites = $user->getAbilities()->pluck('id')->toArray();
        $remaining_entries = null;
        if(isset($request->abilities)){
            $abilities  = $request->abilities;
            foreach($abilities as $ability){
                $form = EntryForm::where('employee_id',$id)->where('ability_id',$ability)->first();
                if(empty($form)){
                    EntryForm::create([
                        'employee_id' => $id,
                        'ability_id' => $ability, 
                        'user_id' => Auth::id(), 
                        'created_at' => date('Y-m-d h:i:s', time())
                    ]);
                }
            }
            if($user->user_type == 'super_admin'){
                EntryForm::where('employee_id',$id)->whereNotIn('ability_id',$abilities)->delete();
            }
            else{
                $remaining_entries = EntryForm::where('employee_id',$id)->whereNotIn('ability_id',$abilities)->get();
            }
        }
        else{
            if($user->user_type == 'super_admin'){
                EntryForm::where('employee_id',$id)->delete();
            }
            else{
                $remaining_entries =  EntryForm::where('employee_id',$id)->get();
            }
        }
        if( $remaining_entries != null){
            foreach($remaining_entries as $entry){
                if(in_array($entry->ability_id,$user_abilitites)){
                    $entry->delete();
                }
            }
        }
        return redirect()->intended("entry-form/$id");
    }
    public function entry_form_email(Request $request,  $id=NULL)
    {
        
       
        $id=$request->get('id');
        
        $data=$request->all();
         
        $email=$request->input('email');
      
        $subject=$request->input('subject');
        
        $message=$request->input('message');
 
  
  
  $headers = $this->set_headers();

   mail($data['email'], $subject, $message, $headers);
   try {
     $headers = $this->set_headers();
   }
 catch (Exception $e) {
   echo 'Message: ' . $e->getMessage();
 }
 if (count(Mail::failures()) > 0) {
    echo "failure";
 }
echo "success";
 }
 

      
    public function set_headers()
    {
        $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: " . getenv('MAIL_FROM_NAME') . " <" . getenv('MAIL_FROM_ADDRESS') . ">";
        return $headers;
    }
    public function exit_form(Request $request, $id = null) {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $employee = User::find($id);
        $entry_categories = \Silber\Bouncer\Database\Role::where('form_type',2)->with('abilities')->orderBy('name')->get();
        $employee_abilities = ExitForm::where('employee_id',$id)->with('user')->get()->toArray();
        $user_categories = $user->getRoles()->toArray();
        return view('admin.exit-form', [
            'categories' => $entry_categories,
            'user_categories' => $user_categories,
            'employee_abilities' => $employee_abilities,
            'user' => $user,
            'employee' => $employee
        ]);
    }
    public function exit_form_save(Request $request, $id = null){
        $user_id = Auth::id();
        $user = User::where('id',$user_id)->first();
        $user_abilitites = $user->getAbilities()->pluck('id')->toArray();
        $remaining_exits = null;
        if(isset($request->abilities)){
            $abilities  = $request->abilities;
            foreach($abilities as $ability){
                $form = ExitForm::where('employee_id',$id)->where('ability_id',$ability)->first();
                if(empty($form)){
                    ExitForm::create([
                        'employee_id' => $id,
                        'ability_id' => $ability, 
                        'user_id' => Auth::id(), 
                        'created_at' => date('Y-m-d h:i:s', time())
                    ]);
                }
            }
            if($user->user_type == 'super_admin'){
                ExitForm::where('employee_id',$id)->whereNotIn('ability_id',$abilities)->delete();
            }
            else{
                $remaining_exits = ExitForm::where('employee_id',$id)->whereNotIn('ability_id',$abilities)->get();
            }
        }
        else{
            if($user->user_type == 'super_admin'){
                ExitForm::where('employee_id',$id)->delete();
            }
            else{
                $remaining_exits =  ExitForm::where('employee_id',$id)->get();
            }
        }
        if( $remaining_exits != null){
            foreach($remaining_exits as $entry){
                if(in_array($entry->ability_id,$user_abilitites)){
                    $entry->delete();
                }
            }
        }
        return redirect()->intended("exit-form/$id");
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
