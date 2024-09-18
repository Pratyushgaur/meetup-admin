<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request,RedirectResponse};
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Redirector;
use App\Models\User;

class InfluncerController extends Controller
{

    /**
     * 
     * 
     * @return view
     */
    public function List() : View
    {
        $influencer_list = User::where('role', '1')->get();

        return view('admin.influencer.list',compact('influencer_list'));
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
        return view('admin.influencer.post_view',compact('profile'));
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
        ])->get();
        return view('admin.influencer.kyc_verify',compact('influencer_list'));
    }

    /**
     * 
     * 
     * @return view
     */
    public function influencer() : View
    {
        $influencer_list = User::all();
        return view('admin.influencer.list',compact('influencer_list'));
    }
}
