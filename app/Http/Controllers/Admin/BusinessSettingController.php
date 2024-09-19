<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request,RedirectResponse};
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Redirector;
use App\Models\BusinessSetting;
use App\Models\SendNotification;
use App\Models\User;

class BusinessSettingController extends Controller
{
     // start Business settings Methods

    /**
     * 
     * 
     * @return View
     */
    public function TermCondition(): View
    {
       $data = BusinessSetting::first();
        return view('admin.business-settings.terms-condition',compact('data'));
    }

    /**
     * 
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function TermConditionSubmit(Request $request) : Redirector|RedirectResponse
    {
        $request->validate([
            'term_condition' => 'required'
        ]);

        try {
            if (BusinessSetting::exists()) {
                $term_condition =  BusinessSetting::first();
                $term_condition->term_condition	 = $request->term_condition;
                $term_condition->save();
                flash()->success('term & condition update successfully');
            }else {
                $term_condition = new BusinessSetting();
                $term_condition->term_condition	 = $request->term_condition;
                $term_condition->save();
                flash()->success('term & condition Created');
            }      

         return redirect(route('admin.business-setup.term.condition'));

        } catch (\Throwable $th) {
            flash()->error('term & condition not Edited');
            return redirect(route('admin.business-setup.term.condition'));
        }   
    }

    /**
     * 
     * 
     * @return View
     */
    public function PrivacyPolicy(): View
    {
        $data = BusinessSetting::first();
        return view('admin.business-settings.privacy-policy',compact('data'));
    }

    /**
     * 
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function PrivacyPolicySubmit(Request $request) : Redirector|RedirectResponse
    {
        $request->validate([
            'privacy_policy' => 'required'
        ]);
        try {

            if (BusinessSetting::exists()) {
                $privacy_policy =  BusinessSetting::first();
                $privacy_policy->privacy_policy	 = $request->privacy_policy;
                $privacy_policy->save();
                flash()->success('privacy & policy update successfully');
            }else {
                $privacy_policy = new BusinessSetting();
                $privacy_policy->privacy_policy	 = $request->privacy_policy;
                $privacy_policy->save();
                flash()->success('privacy & policy Created');
            }      
        return redirect(route('admin.business-setup.privacy.policy'));
            
        } catch (\Throwable $th) {
            flash()->error('privacy & policy not Edited');
            return redirect(route('admin.business-setup.privacy.policy'));
        }   
    }

    /**
     * 
     * 
     * @return View
     */
    public function CompanySetup(): View
    {
        $data = BusinessSetting::first();
        return view('admin.business-settings.company-setup',compact('data'));
    }

    /**
     * 
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function CompanySetupSubmit(Request $request) : Redirector|RedirectResponse
    {
        $request->validate([
            'company_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'country' => 'required',
            'address' => 'required',
            'facebook' => 'required',
            'insta' => 'required',
            'twitter' => 'required',
            'linkedin' => 'required',
            'logo' => 'nullable|image',
            'fevicon' => 'nullable|image',
        ]);

        try {

            if (BusinessSetting::exists()) {
                $data = BusinessSetting::first();
                $data->name = $request->company_name;
                $data->email = $request->email;
                $data->mobile_no = $request->phone;
                $data->country = $request->country;
                $data->address = $request->address;
                $data->facebook_url = $request->facebook;
                $data->instagram_url = $request->insta;
                $data->X_url = $request->twitter;
                $data->linkedin_url = $request->linkedin;

                if(isset($request->logo))
                {
                    $notification_image = time() . '_' . rand(1000,10000000) . '_' .$request->logo->getClientOriginalName();
                    $request->logo->move(public_path('companyimage'), $notification_image, 'real_publics');
                    $data->logo = $notification_image;
                }

                if(isset($request->fevicon))
                {
                    $notification_image = time() . '_' . rand(1000,10000000) . '_' .$request->fevicon->getClientOriginalName();
                    $request->fevicon->move(public_path('companyimage'), $notification_image, 'real_publics');
                    $data->fevicon = $notification_image;
                }
                $data->save();

                flash()->success('Company Data update successfully');
            }else {
                $data = new BusinessSetting();
                $data->name = $request->company_name;
                $data->email = $request->email;
                $data->mobile_no = $request->phone;
                $data->country = $request->country;
                $data->address = $request->address;
                $data->facebook_url = $request->facebook;
                $data->instagram_url = $request->insta;
                $data->X_url = $request->twitter;
                $data->linkedin_url = $request->linkedin;

                if(isset($request->logo))
                {
                    $notification_image = time() . '_' . rand(1000,10000000) . '_' .$request->logo->getClientOriginalName();
                    $request->logo->move(public_path('companyimage'), $notification_image, 'real_publics');
                    $data->logo = $notification_image;
                }

                if(isset($request->fevicon))
                {
                    $notification_image = time() . '_' . rand(1000,10000000) . '_' .$request->fevicon->getClientOriginalName();
                    $request->fevicon->move(public_path('companyimage'), $notification_image, 'real_publics');
                    $data->fevicon = $notification_image;
                }
                $data->save();

                flash()->success('Company Data Created');
            }      
        return redirect(route('admin.business-setup.company.setup'));
            
        } catch (\Throwable $th) {
            flash()->error('Company Data not Edited');
            return redirect(route('admin.business-setup.company.setup'));
        }
    }

     /**
     * 
     * 
     * @return View
     */
    public function CommissionSetup(): View
    {
        $data = BusinessSetting::first();
        return view('admin.business-settings.commission-setup',compact('data'));
    }

    /**
     * 
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function CommissionSetupSubmit(Request $request) : Redirector|RedirectResponse
    {
        $request->validate([
            'default_commission' => 'required',
            'influncer' => 'required',
        ]);

        try {

            if (BusinessSetting::exists()) {
                if($request->influncer == 'all')
                {
                    $alluser = User::where('role','1')->get();

                    foreach ($alluser as $key => $value) 
                    {
                        $user = User::find($value->id);
                        $user->commission = $request->default_commission;
                        $user->save();
                    }
                }
                $data = BusinessSetting::first();
                $data->Influancer_default_commission = $request->default_commission;
                $data->save();

                flash()->success('Default commission update successfully');
            }else {
                if($request->influncer == 'all')
                {
                    $alluser = User::where('role','1')->get();

                    foreach ($alluser as $key => $value) 
                    {
                        $user = User::find($value->id);
                        $user->commission = $request->default_commission;
                        $user->save();
                    }
                }
                $data = new BusinessSetting();
                $data->Influancer_default_commission = $request->default_commission;
                $data->save();

                flash()->success('Default commission Created');
            }      
        return redirect(route('admin.business-setup.commission.setup'));
            
        } catch (\Throwable $th) {
            flash()->error('Default commission not Edited');
            return redirect(route('admin.business-setup.commission.setup'));
        }
    }

    /**
     * 
     * 
     * @return View
     */
    public function SendNotification(): View
    {
        $send_notification= SendNotification::all();
        return view('admin.business-settings.send-notification',compact('send_notification'));
    }

    /**
     * 
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function SendNotificationSubmit(Request $request) : Redirector|RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'user_influncer' => 'required',
            'image' => 'required|image',

        ]);

        try {

            $notification_image = time() . '_' . rand(1000,10000000) . '_' .$request->image->getClientOriginalName();
            $request->image->move(public_path('notification-image'), $notification_image, 'real_publics');
           
            $send_notification = new SendNotification(); 
            $send_notification->title = $request->title;
            $send_notification->description = $request->description;
            $send_notification->sending_to = $request->user_influncer;
            $send_notification->image = $notification_image;
            $send_notification->save();

            flash()->success('Send Notification Created');
            return redirect(route('admin.business-setup.send.notification'));
        } catch (\Throwable $th) {
            flash()->error('Send Notification not created');
            return redirect(route('admin.business-setup.send.notification'));
        }
    }

    /**
     * 
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function SendNotificationKeySubmit(Request $request) : Redirector|RedirectResponse
    {
        $request->validate([
            'key' => 'required',
        ]);

        try {

            dd($request->key);

            flash()->success('Send Notification Created');
            return redirect(route('admin.business-setup.send.notification'));
        } catch (\Throwable $th) {
            flash()->error('Send Notification not created');
            return redirect(route('admin.business-setup.send.notification'));
        }
    }
}
