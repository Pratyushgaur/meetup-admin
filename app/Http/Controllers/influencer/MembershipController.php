<?php

namespace App\Http\Controllers\influencer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Influencerplan;
class MembershipController extends Controller
{
    function index(){
        $plans = \App\Models\Influencerplan::where('user_id',\Auth::id())->latest()->get();
        $price = \App\Models\Price::get();
        return view("influencer.home.membership",compact('plans','price'));
    }
    function membership_name_update(Request $request)  {
        
        $request->validate([
            'service_name' => 'required',
        ]);

       
        $str = strip_tags($request->service_name);
        
        \App\Models\User::where('id','=',\Auth::id())->update([
            'plan_label_name' => $str
        ]);
        return redirect()->back();
    }

    function membership_submit(Request $request){
        
        $request->validate([
            'membershipname' => 'required',
            'description' => 'required',
            'price' => 'required',
            'coverimage' => 'required|mimes:jpg,jpeg,png'
        ]);

        

        $imageName = time().rand().time().'.'.request()->coverimage->getClientOriginalExtension();
        request()->coverimage->move(public_path('plans'), $imageName);

        Influencerplan::insert([
            'user_id' => auth()->user()->id,
            'title' => $request->membershipname,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName
        ]);
        return redirect()->back();

    }

    function membership_update(Request $request){
        $request->validate([
            'membershipname' => 'required',
            'description' => 'required',
            'price' => 'required',
            'editid' => 'required',
            'coverimage' => 'mimes:jpg,jpeg,png'
        ]);
        
        $exist = Influencerplan::find($request->editid);
       
        if($request->hasFile('coverimage')){
            $file_path = public_path().'/plans/'.$exist->image;
            if(file_exists($file_path))
                unlink($file_path);
            
            $imageName = time().rand().time().'.'.request()->coverimage->getClientOriginalExtension();
            request()->coverimage->move(public_path('plans'), $imageName);

        }else{
            $imageName  =  $exist->image;
        }
        Influencerplan::where('id','=',$request->editid)->update([
            'title' => $request->membershipname,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName
        ]);
        return redirect()->back();
    }

    function membership_delete($id){

        Influencerplan::where('id','=',$id)->where('user_id','=',auth()->user()->id)->delete();
        return redirect()->back();
        
    }
    function getAllSubscriber(Request $request){
       $users = \App\Models\UserSubscription::where('plan_id','=',$request->id)->join('users','user_subscriptions.user_id','=','users.id')->select('users.name','users.id as uid',\DB::raw("DATE_FORMAT(purchase_date, '%d-%b-%Y') as p_date"),\DB::raw("DATE_FORMAT(expire_date, '%d-%b-%Y') as ex_date"))->orderBy('user_subscriptions.id','desc')->get();
       echo json_encode(array('user' => $users));

    }
    
}
