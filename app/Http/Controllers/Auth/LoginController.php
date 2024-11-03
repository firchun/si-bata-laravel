<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    // protected function redirectTo()
    // {

    //     session()->flash('success', 'Anda berhasil login!');
    //     return $this->redirectTo;
    // }
    protected function authenticated(Request $request, $user)
    {
        if ($user->role == 'Seller') {
            if ($user->is_verified == 0) {
                Auth::logout();
                return redirect()->route('login')->with('danger', 'Akun Anda belum terverifikasi.');
            }
        }

        // Berikan pesan sukses jika login berhasil dan sudah diverifikasi
        session()->flash('success', 'Anda berhasil login!');
        return redirect()->intended($this->redirectPath());
    }
}
