<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function doctorLogin()
    {
        return view('user.auth.login');
    }


//    public function userRegister()
//    {
//        return view('auth.register');
//    }

    public function doctorLogging(Request $request)
    {
        $password = Hash::make($request->get('password'));
        $doctor = Doctor::query()
            ->where('email', $request->get('email'))
            ->first();
//        if (!Hash::check($request->get('password'), $user->password)) {
//            return redirect()->route("user.login")->with('error', 'Password Are Wrong.');
//        }
        if (is_null($doctor)) {
            return redirect()->route("user.login");
        }
        Auth::guard('doctor')->login($doctor);
        return redirect()->route("user.home");
    }

    public function doctorLogout(Request $request)
    {
        Auth::guard('doctor')->logout();

//        $request->session()->invalidate();

        return redirect()->route('doctor.login');
    }


    public function adminLogin()
    {
        return view('admin.auth.login');
    }

    public function adminLogging(Request $request)
    {
        $password = Hash::make($request->get('password'));
        $admin = Admin::query()
            ->where('email', $request->get('email'))
            ->first();
        if (is_null($admin)) {
            return redirect()->route("admin.login");
        }
        if (!Hash::check($request->get('password'), $admin->password)) {
            return redirect()->route("admin.login")->with('error', 'Email-Address And Password Are Wrong.');
        }
        Auth::guard('admin')->login($admin);
        return redirect()->route("admin.home");
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();

//        $request->session()->invalidate();

        return redirect()->route('admin.login');
    }

}
