<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests;
use Hash;
use Auth;
use App\Models\UserAPIAuthModel;
use Illuminate\Support\Facades\Input;
use Crypt,
Validator,
Redirect,
DB,
Session,
Mail,URL;

class UserController extends Controller
{
	public function register() {

		return view('user.register');
	}

	public function Postregister(Request $req) {
		$rules = array(
			'username' => 'required',
			'email'      =>'required|email|unique:users',
			'password'=>'required',
			'cpassword'=>'required|same:password',
			);

		$validator = Validator::make($req->all(), $rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		else {
			DB::beginTransaction();
			$user = new User($req->all());
			$user->password = bcrypt(Input::get('password'));
			$data =$user->save();
			if(isset($data)){
			  $apiAuthModel = new UserAPIAuthModel;
	          $apiAuthModel->access_token = crypt(uniqid(),'$6$rounds=5000$anexamplestringforsalt$');
	          $apiAuthModel->user_id = $user->id;
	          $apiAuthModel->expiry = date("Y-m-d", strtotime(date('Y-m-d'). " +30 days")) ;
	          $apiAuthModel->save();
			}

			return redirect('/');
		}


	}

	public function login() {

		return view('user.login');
	}

	public function Postsignin(Request $req) {
		$rules = array(
			'email'      =>'required',
			'password'=>'required',
			);

		$validator = Validator::make($req->all(), $rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		else {
			
			if (Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')])) {
				Session::put('email',Input::get('email'));


				return redirect('/signup');
			}
			return Redirect::back()->with('flash_error', 'Email And Password  and User not match')->withInput();;
		}
	}

	

	public function logout() {
		Auth::logout();
		Session::flush();
		return redirect('/');
	}

   	public function forget() {

		return view('user.forgetpassword');
	}

	public function postForgotPassword(Request $req) {
        $rules = array(
            'email' => 'required|email',
        );

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {

            $user = User::where('email', '=', Input::get('email'));

            if ($user->count()) {
                $user = $user->first();
                $code = str_random(60);
                $password = str_random(15);
                $user->password_temp = bcrypt($password);
                $user->code = $code;

                if ($user->save()) {
                    $link = URL::to('resetpassword', $code);
                    $content['email'] = $user->email;
                    $data['content'] = 'Dear '.$user->name.'
                                        <br><br>
                                        You have requested to reset the login password on <a href="'.$_SERVER['SERVER_NAME'].'">CRM</a>.
                                        <br><br>
                                        Reset your password by clicking following link:<br><br>'.
                                        $link;
                    
                    Mail::send('Email.EmailTemplateView', $data, function($message) use ($content) {
                        $message->to($content['email'], 'Concrete Builders')->from('crm@concretebuilders.co.in')->subject('Reset Passsword Request');
                    });
                    return Redirect::to('/forget')->with('flash_error', 'Password reset link sent to your email')->withInput();
                }
            } else {
                return Redirect::route('user.forget')->with('flash_error', "Email ID doesn't exist in the system")->withInput();
            }
        }
    }



     public function resetpassword($code) {
        $user = User::where('code', '=', $code)
                ->where('password_temp', '!=', '');

        if ($user->count()) {
            return view('user.resetPasswordView')->with('code', $code);
        } else {
            return Redirect::back()->with('flash_error', 'Token not valid anymore')->withInput();
        }
    }

    public function changePassword() {
        $pass = Input::get('password');
        $rePass = Input::get('retype_password');
        $code = Input::get('code');
        $rules = array(
            'password' => 'required',
            'retype_password' => 'required|same:password'
        );
        $validator = Validator::make(Input::all(), $rules);
        //echo '<pre>'; print_r($validator); exit;
        if ($validator->fails()) {
            return Redirect::to('/resetpassword/' . $code)
                            ->withErrors($validator);
        } else {
            $user = User::where('code', $code)->first();
            if ($user) {
                $user->password = Hash::make($pass);
                $user->code = "";
                $user->save();
                return Redirect::to('/')->with('flash_error', 'Password changed successfully')->withInput();
            } else
                return Redirect::back()->with('flash_error', 'Token not valid anymore')->withInput();
        }
    }

	
}
