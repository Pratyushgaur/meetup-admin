<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request,RedirectResponse};
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Redirector;
use App\Models\User;
use App\Models\Post;
use App\Models\Categories;
use Illuminate\Support\Facades\File;


class InfluncerController extends Controller
{

    /**
     * 
     * 
     * @return view
     */
    public function List() : View
    {
        
        $influencer_list = User::where('role', '1')->with('post')->get();
       
        $category = Categories::all();
        return view('admin.influencer.list',compact('influencer_list','category'));
    }

     /**
     * 
     * @param $id
     * @return Redirector|RedirectResponse
     */
    public function List_edit_submit(Request $request): Redirector|RedirectResponse
    {
        $request->validate([
            'profilecover' => 'nullable|image',
            'profileimage' => 'nullable|image',
            'name' => 'required',
            'username' => 'required',
            'code' => 'required',
            'number' => 'required',
            'email' => 'required|email',
            'commission' => 'required',
            'Categories' => 'required',
            'editid' => 'required',     
        ]);        
        
        $influencer_post = User::find($request->editid);
        if($request->has('profilecover'))
        {
            $profilecover = time() . '_' . rand(1000,10000000) . '_' .$request->profilecover->getClientOriginalName();
            $request->profilecover->move(public_path('cover'), $profilecover, 'real_publics');
            $influencer_post->cover = $profilecover;
        }
        if($request->has('profileimage'))
        {
            $profileimage = time() . '_' . rand(1000,10000000) . '_' .$request->profileimage->getClientOriginalName();
            $request->profileimage->move(public_path('avator'), $profileimage, 'real_publics');
            $influencer_post->avtar = $profileimage;
        }
         
        $influencer_post->name = $request->name;
        $influencer_post->username = $request->username;
        $influencer_post->bio = $request->bio;
        $influencer_post->country_code = $request->code;
        $influencer_post->mobile = $request->number;
        $influencer_post->email  = $request->email;
        $influencer_post->commission = $request->commission;
        $influencer_post->category_id = $request->Categories;
        $influencer_post->twitter_url = $request->twitter_link;
        $influencer_post->facebook_url = $request->facebook_link;
        $influencer_post->youtube_url = $request->youtube_link;
        $influencer_post->linkedin_url = $request->linkedin_link;
        $influencer_post->instagram_url = $request->instagram_link;
        $influencer_post->snapchat_url = $request->snapchat_link;
        $influencer_post->save();

        flash()->success('influncer list Update');
        return redirect(route('admin.influncers.list'));
    }

     /**
     * 
     * @param $id
     * @return Redirector|RedirectResponse
     */
    public function InfluncerStatus($id): Redirector|RedirectResponse
    {
        try {
            $influencer_status = User::find($id);
            if($influencer_status->status == 0){
                $influencer_status->status = 1;
            }else{
                $influencer_status->status = 0;
            }
            $influencer_status->save();

            flash()->success('Status Edited Successfully');
            return redirect(route('admin.influncers.list'));
        } catch (\Throwable $th) {
            flash()->error('Unexpectec Error');
            return redirect(route('admin.influncers.list'));
        }
    }

    /**
     * 
     * @param $id
     * @return view
     */
    public function InfluncerPostView($id) : View
    {
        $profile = User::where([
            ['id' , '=' , $id],
            ['role' , '=' , '1'],
        ])->first();
        $post = Post::all();
     
        return view('admin.influencer.post_view',compact('profile','post'));
    }

    /**
     * 
     * 
     * @return view
     */
    public function PendingOrders() : View
    {
        $influencer_list = User::where([
            ['role' , '=' , '1']
        ])->get();
        return view('admin.influencer.pending_order',compact('influencer_list'));
    }

    /**
     * 
     * 
     * @return view
     */
    public function PendingOrdersView($id) : View
    {
        $influencer_list = User::where([
            ['id' , '=' , $id],
            ['role' , '=' , '1']
        ])->first();
        return view('admin.influencer.pendingorderview',compact('influencer_list'));
    }

    /**
     * 
     * 
     * @return view
     */
    public function KYCVerification() : View
    {
        $influencer_list = User::where([
            ['role' , '=' , '1']
        ])->with('kyc')->get();
        return view('admin.influencer.kyc_verify',compact('influencer_list'));
    }

    /**
     * 
     * 
     * @return view
     */
    public function KYCVerificationView($id) : View
    {
       $kyc_data = User::where('id' , $id)->with('kyc')->first();
        return view('admin.influencer.kyc_verify_view',compact('kyc_data'));
    }

    
}
