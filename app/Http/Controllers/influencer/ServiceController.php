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
        \App\Models\Service::where('id','=',$request->id)->update([
            'service_type' => $request->service_title,
            'price' => $request->price
        ]);
        return redirect()->back();
    }
    function service_influencer_create(Request $request)  {
        \App\Models\Service::create([
            'service_type' => $request->service_type,
            'price' => $request->price,
            'influencer_id' => \Auth::id(),
        ]);
        return redirect()->back();
        
    }
}
