<?php

namespace App\Http\Controllers\influencer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserOtp;
use App\Models\Categories;
use Auth;
use App\Models\User;
use Session;
use App\Events\InfluencerSetup;
use Illuminate\Validation\Rule;
use App\Rules\UniqueEmailWithRole;

class LoginController extends Controller
{
    function sendOtp(Request $request){

    }
    function register(Request $request){

        $request->validate([
            'fullname' => 'required',
            'gender' => 'required',
            'email' =>['required|email',new UniqueEmailWithRole("1",'email')],
            'mobile' => ['required',new UniqueEmailWithRole("1",'mobile')],
            'country_code' => 'required',
            'username' => 'required',
            
            
            Rule::unique('users')->where(function ($query) use ($request) {
                return $query->where('role', '1');
            }),
        ]);
        UserOtp::updateOrCreate(
            [
                'mobile' => $request->mobile
            ],

            [
                "mobile" => $request->mobile,
                'otp'    => rand(1000,9999)
            ]
            
        );
        $sessiondata = $request->except('_token');
        $sessiondata['verified'] = 0;
        session()->put('registerData', $sessiondata);

        return redirect()->route("influencer.verify.otp");

    }

    function verify_otp()  {    
        if(!session()->has('registerData')){
            return redirect()->route("influencer.signup");
        }
        
        return view("influencer.login_pages.otp_verify");   
    }

    

    function verify_otp_post(Request $request) {
        $request->validate([
            'otp_1' => 'required',
            'otp_2' => 'required',
            'otp_3' => 'required',
            'otp_4' => 'required',
        ]);
        
        if(session()->has('registerData')) {
            $user = session()->get('registerData');
            $otp = $request->otp_1.$request->otp_2.$request->otp_3.$request->otp_4;

            $otpdata = UserOtp::where('mobile','=',$user['mobile'])->first();
            if($otpdata){
                if($otpdata->otp == $otp){
                    $user['verified'] = 1;
                    return redirect()->route("influencer.define.yourself");

                    // $usermodel = new User;
                    // $usermodel->name = $user['fullname'];
                    // $usermodel->mobile = $user['mobile'];
                    // $usermodel->email = $user['email'];
                    // $usermodel->role = "1";
                    // $usermodel->country_code = $user['country_code'];
                    // $usermodel->gender = $user['gender'];
                    // $usermodel->save();
                    // return redirect()->route('i');
                }else{
                    return redirect()->back()->with('otperror','Incorrect one time password');
                }
            }else{
                 return redirect()->back()->with('otperror','Otp  Record not found');

            }
        }else{
            return redirect()->back()->with('otperror','Something went wrong on user data');
        }


    
    }
    function logout(){
        \Auth::logout();
        return redirect()->route("influencer.login");
    }
    function define_yourself(Request $request){
        $categories = Categories::orderBy("name","DESC")->get();
        return view("influencer.login_pages.defineyourself",compact('categories'));
    }
    function define_yourself_post($id){
        if(!$id)
            return redirect()->route('influencer.signup');
        if(!session()->has('registerData'))
            return redirect()->route("influencer.signup");

        
        $Influancer_default_commission = BusinessSetting::first()->Influancer_default_commission;
        $userSession = session()->get('registerData');
        $name = str_replace(' ', '', $userSession['fullname']); // Replaces all spaces with hyphens.
        $name = preg_replace('/[^A-Za-z0-9\-]/', '', $name);
        $username = $userSession['username']; //$this->generateUsername($name);
        
        $user = new User;
        $user->name =  $userSession['fullname'];
        $user->mobile = $userSession['mobile'];
        $user->username = $username;
        $user->country_code =  $userSession['country_code'];
        $user->email =  $userSession['email'];
        $user->gender =  $userSession['gender'];
        $user->category_id = $id;
        $user->role = '1';
        $user->service_label_name = "Fan Connect";
        $user->plan_label_name = "Membership";
        $user->commission = $Influancer_default_commission;
        $user->save();
        
        Auth::login($user);
        InfluencerSetup::dispatch($user->id);
        return redirect()->route('influencer.home');
        
        

        
    }

    function login(Request $request){
        
        $request->validate([
            'username' => 'required',
        ]);
        $user = User::where('username','=',$request->username)->orWhere('mobile' ,'=', $request->username)->where('role' ,'=', '1');
        if($user->exists()){
            $user = $user->first();
            UserOtp::updateOrCreate(
                [
                    'mobile' => $user->mobile
                ],
    
                [
                    "mobile" => $user->mobile,
                    'otp'    => rand(1000,9999)
                ]
                
            );
            session()->put('loginData', $user);
            return redirect()->route("influencer.login.verify.otp");

        }else{
            return redirect()->back()->withInput($request->input())->with('error',"invalid Username");
        }

        
    }
    function verify_log_otp_post(Request $request){
        if(!session()->has('loginData')){
            return redirect()->route("influencer.login");
        }

        $otp = $request->otp_1.$request->otp_2.$request->otp_3.$request->otp_4;
        $user = $session=session()->get('loginData');
        $otpdata = UserOtp::where('mobile','=',$user['mobile'])->first();
        if($otpdata){
            if($otpdata->otp == $otp){
                
                Auth::login($user);
                return redirect()->route('influencer.home');
            }else{
                return redirect()->back()->with('otperror','Incorrect one time password');
            }
        }else{
            return redirect()->back()->with('otperror','Otp  Record not found');
       
       }


   
           
    }
    function verify_log_otp()  {    
        if(!session()->has('loginData')){
            return redirect()->route("influencer.login");
        }
        $user = $session=session()->get('loginData');
        $otpdata = UserOtp::where('mobile','=',$user['mobile'])->first();
        
        return view("influencer.login_pages.login_otp_verify",compact('otpdata'));   
    }
    function generateUsername($name){
        $check = User::where('username','=',$name)->exists();
        $i = '01';
        if(!$check){
            return $name;
        }else{
            while (true) {
                $name= $name.$i;
                $check = User::where('username','=',$name)->exists();
                if(!$check){
                    break;
                }else{
                    $i++;
                }
            }
            return $name;
            
            
        }
    }
    function check_username(Request $request){
        
        $check = User::where('username','=',$request->username)->exists();
        if($check){
            $suggestions = $this->generateUsernameSuggestions($request->username);
            echo json_encode(array('status' => '0','suggestions' =>$suggestions));
        }else{
            echo json_encode(array('status' => '1')); 
        }
    }
    function generateUsernameSuggestions($baseUsername) {
        $suggestions = [];
        
        // Simple logic to generate 5 alternative usernames
        for ($i = 1; $i <= 5; $i++) {
            $suggestions[] = $baseUsername . rand(100, 999);
        }
    
        // Return the suggestions as a formatted list
        return $suggestions;
    }
    
}
