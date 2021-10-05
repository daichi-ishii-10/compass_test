<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */

  use AuthenticatesUsers;
  // use AuthenticatesUsers {
  //   logout as performLogout;
  // }

  /**
  * Where to redirect users after login.
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
    $this->middleware('guest')->except('logout');
  }

  // 表示させるだけ
  public function login(){
    return view("auth.login");
  }
  // ログインの処理
  public function getlogin(LoginUserRequest $request){
    if($request->isMethod('post')){
      $data=$request->only('mail','password');
      // ログインが成功したら、トップページへ
      //↓ログイン条件は公開時には消すこと
      if(Auth::attempt($data)){
        return redirect('/top');
      }
    }
    return view("auth.login");
  }

  protected function logout(){
    Auth::logout();
    return redirect('/login');
  }
}
