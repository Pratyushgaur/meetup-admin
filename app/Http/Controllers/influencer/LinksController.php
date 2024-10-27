<?php

namespace App\Http\Controllers\influencer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InfluencerLink;
class LinksController extends Controller
{
    function index(){
        $links = InfluencerLink::where('user_id','=',\Auth::id())->get();

        return view('influencer.home.links',compact('links'));
    }
    function save(Request $request){
        $request->validate([
            'title' => 'required',
            'url' => 'required'
        ]);
        $influencerLink = new InfluencerLink;
        $influencerLink->title = $request->title;
        $influencerLink->user_id= \Auth::id();
        $influencerLink->link= $request->url;
        $influencerLink->save();
        return redirect()->back();

    }
    function delete($id){
        InfluencerLink::where('id','=',$id)->where('user_id','=',\Auth::id())->delete();
        return redirect()->back();

    }
}