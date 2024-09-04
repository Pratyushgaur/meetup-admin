<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class LoginController extends Controller
{
    //

    function login(Request $request)  {
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = array(
                        'email' =>$request->email,
                        'password' =>$request->password,
                        'role' => '0'
                    );
        if(Auth::attempt($credentials)){
            return redirect()->route('admin.dashboard');
        }else{
            return 'invalid';
        }
    }
}
