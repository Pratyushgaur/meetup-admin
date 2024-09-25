<?php

namespace App\Http\Controllers\influencer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Userkyc;
class SettingController extends Controller
{
    function payout_setting(){
        $kyc = Userkyc::where('user_id','=',\Auth::id())->first();
        return view('influencer.settings.payout_setting',compact('kyc'));
    }
    function payout_setting_post(Request $request){
        $request->validate([
            
            'pan_card' => 'required',
            'aadhar_no' => 'required',
            'billing_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'bank_name' => 'required',
            'account_number' => 'required',
            'account_holder' => 'required',
            'account_ifsc' => 'required'
        ]);
        $userkyc = new Userkyc;
        $userkyc->user_id = \Auth::id();
        $userkyc->pan_card = $request->pan_card;
        $userkyc->gst_no = $request->gst_no;
        $userkyc->aadhar_no = $request->aadhar_no;
        $userkyc->billing_name = $request->billing_name;
        $userkyc->address = $request->address;
        $userkyc->city = $request->city;
        $userkyc->pincode = $request->pincode;
        $userkyc->upi_id = $request->upi_address;
        $userkyc->bank_name = $request->bank_name;
        $userkyc->account_no = $request->account_number;
        $userkyc->account_holder = $request->account_holder;
        $userkyc->account_ifsc = $request->account_ifsc;
        $userkyc->save();
        if($request->hasFile('images')){
            $userkyc = Userkyc::where('user_id','=',\Auth::id())->where('status','=','0')->first();
            $data = [];
            if(!empty($userkyc)){
                foreach($request->file('images') as $key => $image){
                    $imageName = time() . auth()->user()->id.$key.'_' . $image->getClientOriginalName();
                    $image->move(public_path('docs'), $imageName);
                    $data[] = $imageName;
                }
                Userkyc::where('user_id','=',\Auth::id())->where('status','=',"0")->update([
                    'docs' => json_encode($data)
                ]);
                
                
            }
        }
        echo json_encode(array('res' => 1));

          
    }
    function payout_setting_doc_post(Request $request){
        if($request->hasFile('images')){
            $userkyc = Userkyc::where('user_id','=',\Auth::id())->where('status','=','0')->first();
            
            if(!empty($userkyc)){
                $imageName = time() . auth()->user()->id.'_' . $request->images->getClientOriginalName();
                $request->images->move(public_path('docs'), $imageName);
                if($userkyc->docs !=''){
                    $docs = json_decode($userkyc->docs);
                    $docs[] = $imageName;
                   
                    $data = $docs;
                }else{
                    $data[] = $imageName;
                }
                Userkyc::where('user_id','=',\Auth::id())->where('status','=',"0")->update([
                    'docs' => json_encode($data)
                ]);
                echo 'don';
            }

        }else{
            return 'no image found';
        }
    }
}
