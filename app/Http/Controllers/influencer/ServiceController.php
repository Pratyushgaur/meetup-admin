<?php

namespace App\Http\Controllers\influencer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    function index()  {
        $price = \App\Models\Price::get();
        $service = \App\Models\Service::where('influencer_id',\Auth::id())->latest()->get();

        return view("influencer.home.Services",compact('price','service'));
    }
    function service_name_update(Request $request)  {
        $request->validate([
            'service_name' => 'required',
        ]);
        $str = strip_tags($request->service_name);
        
        \App\Models\User::where('id','=',\Auth::id())->update([
            'service_label_name' => $str
        ]);
        return redirect()->back();
    }
    function service_influencer_update(Request $request)  {
       
        if($request->hasFile('service_image')){
            $imageName = time().rand().time().'.'.request()->service_image->getClientOriginalExtension();
            request()->service_image->move(public_path('services_images'), $imageName);
        }
        $updatedata = \App\Models\Service::find($request->id);
        $updatedata->service_type = $request->service_title;
        $updatedata->price = $request->price;
        if($request->hasFile('service_image')){
            $updatedata->image  = $imageName;
        }
        $updatedata->save();
       
        return redirect()->back();
    }
    function service_influencer_create(Request $request)  {
        $imageName = time().rand().time().'.'.request()->service_image->getClientOriginalExtension();
        request()->service_image->move(public_path('services_images'), $imageName);
        \App\Models\Service::create([
            'service_type' => $request->service_type,
            'price' => $request->price,
            'influencer_id' => \Auth::id(),
            'image' => $imageName
        ]);
        return redirect()->back();
        
    }

    function service_influencer_delete($id){
        \App\Models\Service::where('id','=',$id)->where('influencer_id','=',\Auth::id())->delete();
        return redirect()->back();
    }
}