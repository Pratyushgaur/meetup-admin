<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request,RedirectResponse};
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;


class AdminController extends Controller
{

    /**
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
     * @return View
     */
    function dashboard(): View
    {
        $data = [];
        $cdate = Carbon::now();
        $mdate = new Carbon('-1 month');
        $ydate = new Carbon('-1 year');

        $data['income'] = Helpers_get_total_income();

        $data['influancer_total'] = User::where('role',1)->count();
        $data['influancer_month'] = User::where('role',1)->whereDate('created_at', "<=" , $cdate->format('Y-m-d H:i:s'))->whereDate('created_at', ">=" , $mdate->format('Y-m-d')." 00:00:00")->count();

        $data['user_total'] = User::where('role',0)->count();
        $data['user_month'] = User::where('role',0)->whereDate('created_at', "<=" , $cdate->format('Y-m-d H:i:s'))->whereDate('created_at', ">=" , $mdate->format('Y-m-d')." 00:00:00")->count();

        return view("admin.dashboard" , compact('data'));
    }

    /**
     * 
     * @return RedirectResponse|Redirector
     */
    public function logout() : Redirector|RedirectResponse
    {
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'));
    }

    /**
     * 
     * @return View
     */
    function profile(): View
    {
        $admin = Auth::guard('admin')->user();
        return view("admin.profile.index",compact('admin'));
    }

    /**
     * 
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function ProfileSubmit(Request $request) : Redirector|RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'image' => 'nullable|image',

        ]);

        try {
            $profile = Admin::find(Auth::guard('admin')->user()->id);  
            
            $profile->name = $request->name;

            if(isset($request->image) && !is_null($request->image)){
                $profile_image = time() . '_' . rand(1000,10000000) . '_' .$request->image->getClientOriginalName();
                $request->image->move(public_path('adminProfile'), $profile_image, 'real_publics');
                $profile->profile_image = $profile_image;
            }
            $profile->email = $request->email;
            $profile->mobile = $request->phone;
            $profile->save();

            flash()->success('Profile Created');
            return redirect(route('admin.profile.profile'));
        } catch (\Throwable $th) {
            flash()->error('profile not created');
            return redirect(route('admin.profile.profile'));
        }
    }

    
    /**
     * 
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function ProfilepasswordSubmit(Request $request) : Redirector|RedirectResponse
    {
        $request->validate([
           'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);

        try {
            $profile = Admin::find(Auth::guard('admin')->user()->id);  
            $profile->password = $request->password;
            $profile->save();

            flash()->success('Profile password Created');
            return redirect(route('admin.profile.profile'));
        } catch (\Throwable $th) {
            flash()->error('profile password not created');
            return redirect(route('admin.profile.profile'));
        }
    }
}