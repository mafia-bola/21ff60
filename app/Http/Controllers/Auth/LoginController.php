<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Helpers\Alert;
use Auth;
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required'
        ]);
        
        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];


        if (Auth::guard('admin')->attempt($credentials)){
            \Log::info('Success Login');
            return redirect()->intended(route('admin.dashboard.index'));
        }else {
            Alert::make('danger','Pastikan username dan password benar.');
            return back();
        }
    }

    // public function loginPengunjung(Request $request)
    // {
    //     $this->validate($request,[
    //         'username' => 'required',
    //         'password' => 'required'
    //     ]);
    //     $credentials = [
    //         'username' => $request->username,
    //         'password' => $request->password
    //     ];

    //     if (Auth::guard('pengunjung')->attempt($credentials)){
    //         \Log::info('Success Login');
    //         // return redirect()->intended(route('admin.dashboard.index'));
    //     }else {
    //         Alert::make('danger','Pastikan username dan password benar.');
    //         return back();
    //     }
    // }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
