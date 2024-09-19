<?php

namespace App\Http\Controllers\influencer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    //

    function home(Request $request)  {
        return view("influencer.home.home");
    }

    function profile_edit(){
        return view("influencer.home.profile-edit");
    }
    function profile_edit_post(Request $request){
        $request->validate([
            'fullname' => 'required',
            "bio" => 'required'
        ]);
        $id = auth()->user()->id;
        \App\Models\User::where('id','=',$id)->update([
             'name' => $request->fullname,       
             'bio' => $request->bio,       
             'app_theme_color' => $request->appcolor,       
             'instagram_url' => $request->instagram,       
             'snapchat_url' => $request->snapchat,       
             'twitter_url' => $request->twitter,       
             'youtube_url' => $request->youtube,       
             'facebook_url' => $request->facebook,       
             'linkedin_url' => $request->linkedin       
        ]);
        return  redirect()->back()->with('success',"Profile updated");

        
    }
    function profile_cover_post(Request $request){
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5048',
        ]);
        $imageName = auth()->user()->username.'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('cover'), $imageName);
       
        \App\Models\User::where('id','=',\Auth::id())->update([
            'cover' => $imageName
        ]);
        return redirect()->back();
    }
    function profile_avator_post(Request $request){
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5048',
        ]);
        $imageName = auth()->user()->username.'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('avator'), $imageName);
       
        \App\Models\User::where('id','=',\Auth::id())->update([
            'avtar' => $imageName
        ]);
        return redirect()->back();
    }
    function profile() {
        
        $service = \App\Models\Service::where('influencer_id',\Auth::id())->latest()->get();
        $plans = \App\Models\Influencerplan::where('user_id',\Auth::id())->latest()->get();
       
        return view('influencer.home.profile',compact('service','plans'));
    }
    function profile_preview(){
        return view('influencer.home.profile_view');

    }
}
