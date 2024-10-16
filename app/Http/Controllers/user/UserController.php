<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Rules\UniqueEmailWithRole;

use App\Models\User;
use App\Models\Influencerplan;
use App\Models\Post;
use App\Models\UserOtp;
use App\Models\Customer;
use App\Models\UserWalletTrasaction;
use Carbon\Carbon;
use App\Events\MessageSent;

class UserController extends Controller
{
    function index(User $user ,Request $request){
        $userid =  (auth()->guard('customer')->check()) ?  auth()->guard('customer')->user()->id : null ;
        $plans =Influencerplan::where('user_id','=',$user->id)->get();
        $ex_posts =Post::where('userid','=',$user->id)
       
        ->leftJoin('post_unlocks', function($join) use ($userid) {
            $join->on('posts.id', '=', 'post_unlocks.post_id')
                 ->where('post_unlocks.user_id', '=', $userid); // Using the variable here
        })
        //->where('post_unlocks.user_id','=',auth()->guard('customer')->user()->id)
        ->select('posts.*','post_unlocks.id as post_unlock_id')
        ->where('post_type','=','0')->orderBy('posts.id','desc')->limit(5);
        
       
        return view('user.home',compact('user','plans','ex_posts'));
    }

    function exclusive(User $user ){
        $userid =  (auth()->guard('customer')->check()) ?  auth()->guard('customer')->user()->id : null ;
        $posts  = Post::where('userid','=',$user->id)
        ->leftJoin('post_unlocks', function($join) use ($userid) {
            $join->on('posts.id', '=', 'post_unlocks.post_id')
                 ->where('post_unlocks.user_id', '=', $userid); // Using the variable here
        })
        ->where('post_type','=',"0")
        ->select('posts.*','post_unlocks.id as post_unlock_id')
        ->orderBy('posts.id','desc')->get();
        $postype = 'Exclusive';
        return view('user.exclusive',compact('posts','postype'));
    }
    function prime(User $user)  {
        $userid =  (auth()->guard('customer')->check()) ?  auth()->guard('customer')->user()->id : null ;

        $posts  = Post::where('userid','=',$user->id)
        ->leftJoin('user_subscriptions', function($join) use ($userid,$user) {
            $join->on('posts.plan_id', '=', 'user_subscriptions.plan_id')
                 ->where('user_subscriptions.user_id', '=', $userid)
                 ->where('user_subscriptions.influencer_id', '=', $user->id)
                 ->whereDate("purchase_date",'<=',Carbon::now())
                 ->whereDate("expire_date",'>=',Carbon::now());
                
        })
        ->where('post_type','=',"1")->join('influencer_plans','posts.plan_id','=','influencer_plans.id')->select('posts.*','influencer_plans.title as plan_name','user_subscriptions.id as post_unlock_id')->get();
       // dd($posts->toArray());
        $postype = 'premium';

        return view('user.premium',compact('posts','postype'));
    }
    function login(){
        return view('user.login');
    }
    function register(){
        return view('user.register');
    }
    function register_post(User $user ,Request $request){
       
        $request->validate([
            'name' => 'required',
            'email' =>['required',new UniqueEmailWithRole("2",'email')],
            'mobile' => ['required',new UniqueEmailWithRole("2",'mobile')]
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
        session()->put('registerUserData', $sessiondata);
        return redirect()->route("user.verify.otp",request()->segment(2));

    }
    function verifyotp(User $user ,Request $request){
        if(!session()->has('registerUserData')){
            return redirect()->route("user.register",request()->segment(2));
        }
        return view("user.otp_verify");   
    }
    function verifyotp_submit(User $user ,Request $request)  {
        $request->validate([
            'otp_1' => 'required',
            'otp_2' => 'required',
            'otp_3' => 'required',
            'otp_4' => 'required',
        ]);
        if(session()->has('registerUserData')) {
            $user = session()->get('registerUserData');
            $otp = $request->otp_1.$request->otp_2.$request->otp_3.$request->otp_4;

            $otpdata = UserOtp::where('mobile','=',$user['mobile'])->first();
            if($otpdata){
                if($otpdata->otp == $otp){
                    $customer  = new User;
                    $customer->name = $user['name'];
                    $customer->mobile = $user['mobile'];
                    $customer->email = $user['email'];
                    $customer->role = "2";
                    $customer->save();
                    auth()->guard('customer')->login($customer);
                    return redirect()->route("user.home",request()->segment(2));

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
    function login_post(User $user,Request $request){
        $request->validate([
            'username' => 'required',
        ]);
       
        $user = User::where('mobile','=',$request->username)->where('role','=','2');
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
            return redirect()->route("user.login.verify.otp",request()->segment(2));

        }else{
            return redirect()->back()->withInput($request->input())->with('error',"invalid Username");
        }
    }

    function login_verify(User $user,Request $request){
        if(!session()->has('loginData')){
            return redirect()->route("user.login",request()->segment(2));
        }
        $user = $session=session()->get('loginData');
        $otpdata = UserOtp::where('mobile','=',$user['mobile'])->first();
        return view("user.loginotp_verify",compact('otpdata'));   
    }
    function login_verify_post(User $user,Request $request){
        if(!session()->has('loginData')){
            return redirect()->route("user.login");
        }

        $otp = $request->otp_1.$request->otp_2.$request->otp_3.$request->otp_4;
        $user = $session=session()->get('loginData');
        
        $otpdata = UserOtp::where('mobile','=',$user->mobile)->first();
        if($otpdata){
            if($otpdata->otp == $otp){
                $customer = User::where('mobile','=',$user->mobile)->where('role','=','2')->first();
                auth()->guard('customer')->login($customer);
                return redirect()->route('user.home',request()->segment(2));
            }else{
                return redirect()->back()->with('otperror','Incorrect one time password');
            }
        }else{
            return redirect()->back()->with('otperror','Otp  Record not found');
       
       }
    }
    function logout(User $user,Request $request){
        auth()->guard('customer')->logout();
        return redirect()->route('user.home',request()->segment(2));
    }
    // =============
    function wallet(User $user,Request $request){
        $transaction = UserWalletTrasaction::where( 'user_id' ,auth()->guard('customer')->user()->id)->orderBy('id','desc')->get();
        return view('user.wallet',compact('transaction'));
    }
    function wallet_add(User $user,Request $request){
        $request->validate([
            'amount' =>'required|numeric'
        ]);



        $user  = User::where('id','=',auth()->guard('customer')->user()->id)->where('role','=','2');
        $userDt = $user->first();
        $new = $userDt->balance+$request->amount;
        $user->update([
            'balance' => $new
        ]);

        UserWalletTrasaction::insert([
            'transction_type' => '1',
            'transction_title' => 'Recharge',
            'transction_desc' =>'New recharge view Bank',
            'amount' => $request->amount,
            'user_id' =>auth()->guard('customer')->user()->id
        ]);
        return redirect()->back();


        


        
    }
    
    function plan_view(User $user,$planid){
        
        $plan = Influencerplan::where('id','=',$planid)->where('user_id','=',$user->id)->FirstOrFail();
        $plans = Influencerplan::where('user_id','=',$user->id)->get();
       
        return view('user.plan_view',compact('plan','plans'));
    }
    function plan_buy(User $user,$planid){
        $plan = Influencerplan::where('id','=',$planid)->where('user_id','=',$user->id)->FirstOrFail();
        if($plan){
            if(auth()->guard('customer')->user()->balance >= $plan->price){
                
                $checkAlready  = \App\Models\UserSubscription::where('user_id','=',auth()->guard('customer')->user()->id)->where('user_subscriptions.influencer_id', '=', $user->id)->whereDate("purchase_date",'<=',Carbon::now())->whereDate("expire_date",'>=',Carbon::now())->exists();
                if(!$checkAlready){
                    \DB::beginTransaction();

                    try {
                        \App\Models\UserSubscription::insert(['influencer_id' => $user->id,'user_id' => auth()->guard('customer')->user()->id,'plan_id' => $planid,'purchase_date' =>Carbon::now()->format('Y-m-d'),'expire_date' =>Carbon::now()->addDays(30)->format('Y-m-d')]);
                        User::where('id','=',auth()->guard('customer')->user()->id)->where('role','=','2')->update(['balance' => auth()->guard('customer')->user()->balance-$plan->price]);
                        \App\Models\UserWalletTrasaction::insert(['transction_type' => '0','transction_title' => 'Plan Purchase','transction_desc' =>'Purchase Plan By wallet','amount' => $plan->price,'user_id' =>auth()->guard('customer')->user()->id]);
                        \App\Models\Order::insert(['userid' =>auth()->guard('customer')->user()->id,'influencer_id' => $user->id,'order_id' =>$this->orderId(),'amount'=>$post->price,'order_type' => 'plan_purchase','order_status' => '1']);
                        \DB::commit();
                        echo json_encode(array('error'=>false,'message' => "Congratulation Plan  Unlocked")); 
                    } catch (\Exception  $e) {
                        \DB::rollback();
                        echo json_encode(array('error'=>true,'message' => $e->getMessage())); 
                    }
                }else{
                    echo json_encode(array('error'=>true,'message' => 'Plan Already  have purchased by user'));
                }
                
            }else{
                echo json_encode(array('error'=>true,'message' => 'Insufficient Balance'));

            }
        }else{
            echo json_encode(array('error'=>true,'message' => 'Plan Not Found'));

        }
    }
    function post_view(User $user,$postid){
        
        $value = Post::where('id','=',$postid)->where('userid','=',$user->id)->FirstOrFail();
        return view('user.post_view',compact('value'));
    }
    function post_unlock(User $user,$postid){
    
        $post = Post::where('id','=',$postid)->where('userid','=',$user->id)->first();
        
        if($post){
            if(auth()->guard('customer')->user()->balance >= $post->price){
                if(!\App\Models\PostUnlock::where(['post_id' => $postid,'user_id' => auth()->guard('customer')->user()->id])->exists()){
                    \DB::beginTransaction();

                    try {
                        \App\Models\PostUnlock::insert(['post_id' => $postid,'user_id' => auth()->guard('customer')->user()->id,'amount' => $post->price]);
                        User::where('id','=',auth()->guard('customer')->user()->id)->where('role','=','2')->update(['balance' => auth()->guard('customer')->user()->balance-$post->price]);
                        UserWalletTrasaction::insert(['transction_type' => '0','transction_title' => 'Post Unlock','transction_desc' =>'Post Unlock By wallet','amount' => $post->price,'user_id' =>auth()->guard('customer')->user()->id]);
                        \App\Models\Order::insert(['userid' =>auth()->guard('customer')->user()->id,'influencer_id' => $user->id,'order_id' =>$this->orderId(),'amount'=>$post->price,'order_type' => 'post_unlock','order_status' => '1'    ]);
                        \DB::commit();
                        echo json_encode(array('error'=>false,'message' => "Congratulation Post Unlocked")); 
                    } catch (\Exception  $e) {
                        \DB::rollback();
                        echo json_encode(array('error'=>true,'message' => $e->getMessage())); 
                    }
                }else{
                    echo json_encode(array('error'=>true,'message' => 'Already have unlocked by user'));
                }
                
            }else{
                echo json_encode(array('error'=>true,'message' => 'Insufficient Balance'));

            }
        }else{
            echo json_encode(array('error'=>true,'message' => 'Post Not Found'));

        }
        
    }
    function orderId(){
        $count = \App\Models\Order::whereMonth('created_at', '=', \DB::raw('MONTH(CURDATE())'))->whereYear('created_at', '=', \DB::raw('YEAR(CURDATE())'))->count();
        return Carbon::now()->format('Y').Carbon::now()->format('m').$count+1;
    }
    function sendMessage(User $user,Request $request){
        $message = $request->message;

        MessageSent::dispatch($message);
        return "done";
    }
    
}
