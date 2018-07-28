<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{   
    /*
    |--------------------------------------------------------------------------
    | Login Section
    |--------------------------------------------------------------------------
    |
    | Taruh yang berhubungan dengan pengolahan auth user di sini.
    |
    */
   
    public function viewLogin()
    {
    	return view('login');
    }

    public function submitLogin(Request $request)
    {
    	$this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        
        $credentials = [
            'team_username' => $request->username,
            'password' => $request->password,
            'team_type' => 'admin',
        ];

        $credentials2 = [
            'team_username' => $request->username,
            'password' => $request->password,
            'team_type' => 'peserta',
        ];

        if (Auth::attempt($credentials)) {
    		return redirect()->intended(route('admin.dashboard'));
		}
        elseif (Auth::attempt($credentials2)) {
            return redirect()->intended(route('peserta.dashboard'));
        }
        else{
		  return redirect()->back()->withErrors(['loginfailed' => 'Username/Password Salah!']);
        }
    }

    public function doLogout()
    {
    	Auth::logout();
        return redirect()->route('login.form');
    }

    
    /*
    |--------------------------------------------------------------------------
    | Register Section
    |--------------------------------------------------------------------------
    |
    | Taruh yang berhubungan dengan CUD User di sini
    |
    */
    public function viewRegister()
    {
        return view('admin/register');
    }

    public function submitRegister(Request $request)
    {
        $username = $request->input('username');
        $res = User::where('team_username',$username)->count();
        if($res){
            return redirect()->route('error')->with(['msg' => 'Username Sudah Terdaftar!']);
        }

        $team = new User();
        $team->team_username = $request->input('username');
        $team->team_password = bcrypt($request->input('password'));
        $team->team_type = $request->input('ttype');

        $status = $team->save();

        return redirect()->route('register.view');
    }


}
