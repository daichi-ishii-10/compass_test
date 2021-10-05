<?php

namespace App\Http\Controllers\Auth\Register;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
  /*
|--------------------------------------------------------------------------
| Register Controller
|--------------------------------------------------------------------------
|
| This controller handles the registration of new users as well as their
| validation and creation. By default this controller uses a trait to
| provide this functionality without requiring any additional code.
|
*/

use RegistersUsers;

/**
* Where to redirect users after registration.
*
* @var string
*/
protected $redirectTo = '/top';

/**
* Create a new controller instance.
*
* @return void
*/
public function __construct()
{
  $this->middleware('guest');
}

  /**
  * Get a validator for an incoming registration request.
  *
  * @param  array  $data
  * @return \Illuminate\Contracts\Validation\Validator
  */


  /**
  * Create a new user instance after a valid registration.
  *
  * @param  array  $data
  * @return \App\User
  */
  protected function create(array $data)
  {
    return User::create([
        'username' => $data['username'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
    ]);
  }


  // public function registerForm(){
  //     return view("auth.register");
  // }

  public function register(){

    return view('auth.register');
  }

  public function added(CreateUserRequest $request){
    $request->isMethod('post');
    $data = $request->input();
    $username = $data['username'];

    $this->create($data);

    return view('auth.added')->with('username',$username);
  }
}
