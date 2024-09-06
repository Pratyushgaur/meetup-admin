<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request,RedirectResponse};
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    /**
     * 
     * 
     * @return View
     */
    public function index() : View
    {
        return view('admin.login');
    }

    /**
     * 
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function login(Request $request) : Redirector|RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]))
        {
            return redirect(route('admin.dashboard'));
        }else{
            flash()->error('Email Or Password Should be wrong..!!');
            return redirect()->back();
        }
    }

    /**
     * 
     * 
     * @return View
     */
    function dashboard(): View
    {
        return view("admin.dashboard");
    }

    /**
     * 
     * 
     * @return RedirectResponse|Redirector
     */
    public function logout() : Redirector|RedirectResponse
    {
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'));
    }
}