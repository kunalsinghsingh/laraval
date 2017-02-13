<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Models\UserAPIAuthModel;
use App\Http\Controllers\Controller;
use Crypt,
Validator,
Redirect,
DB,
Session,
Mail,URL;
use App\Models\User;

class APIAuthController extends Controller
{

   public function register(Request $req){
    $rules = array(
      'username' => 'required',
      'email'      =>'required|email|unique:users',
      'password'=>'required',
      'cpassword'=>'required|same:password',
      );

    $validator = Validator::make($req->all(), $rules);

    if ($validator->fails())
    {
     // return Redirect::back()->withErrors($validator)->withInput();
      return (new Response($validator->errors()->tojson()))->header('Content-Type', 'application/json');
    }
    else {

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
      

     return (new Response('User Saved', 200))->header('Content-Type', 'application/json');
    }

   }
}
