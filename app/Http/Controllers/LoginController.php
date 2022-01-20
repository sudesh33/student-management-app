<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['name' => $request->name, 'password' => $request->password, 'status' => 1])) {

            $request->session()->regenerate();
//            return redirect()->intended('dashboard');
//            return redirect()->route('dashboard');
            return 0;
        }

        $user = User::where('name', $request->name)->first();

        if($user->status === '0'){
            return 1;
        }else {
            return 2;
        }




//        return back()->withErrors([
//            'name' => 'The provided credentials do not match our records.',
////            'status' => 'Account Blocked.',
//        ]);
    }
}
