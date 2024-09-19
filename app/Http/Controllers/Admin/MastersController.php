<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Categories,
    DefaultService,
    Price,
    DefaultPlan,
    Gift
};
use Illuminate\Http\{Request,RedirectResponse};
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\File;

class MastersController extends Controller
{
    
    // Pricing Methods

    /**
     * 
     * 
     * @return View
     */
    public function DefaultPrice(): View
    {
        $price = Price::all();
        return view('admin.master.default_pricess', compact('price'));
    }

    /**
     * 
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function DefaultPriceSubmit(Request $request): Redirector|RedirectResponse
    {
        $request->validate([
            'price' => 'required|numeric'
        ]);

        try {
            $price = new Price();
            $price->prices = $request->price;
            $price->save();

            flash()->success('Pricing Created');
            return redirect(route('admin.masters.price'));
        } catch (\Throwable $th) {
            flash()->error('Pricing not created');
            return redirect(route('admin.masters.price'));
        }
    }

    /**
     * 
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function DefaultPriceEdit(Request $request): Redirector|RedirectResponse
    {
        $request->validate([
            'newprice' => 'required|numeric',
            'editid' => 'required'
        ]);

        try {
            $price = Price::find($request->editid);
            $price->prices = $request->newprice;
            $price->save();

            flash()->success('Pricing Edited Successfully');
            return redirect(route('admin.masters.price'));
        } catch (\Throwable $th) {
            flash()->error('Pricing not Edited');
            return redirect(route('admin.masters.price'));
        }
    }

    /**
     * 
     * @param $id
     * @return Redirector|RedirectResponse
     */
    public function DefaultPriceStatus($id): Redirector|RedirectResponse
    {
        try {
            $price = Price::find($id);
            if($price->status == 0){
                $price->status = 1;
            }else{
                $price->status = 0;
            }
            $price->save();

            flash()->success('Status Edited Successfully');
            return redirect(route('admin.masters.price'));
        } catch (\Throwable $th) {
            flash()->error('Unexpectec Error');
            return redirect(route('admin.masters.price'));
        }
    }

    /**
     * 
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function DefaultPriceDelete(Request $request): Redirector|RedirectResponse
    {
        $request->validate([
            'id' => 'required'
        ]);

        try {
            $price = Price::find($request->id);
            if($price->exists()){
                $price->delete();
            }

            flash()->success('Price Deleted');
            return redirect(route('admin.masters.price'));
        } catch (\Throwable $th) {
            flash()->success("Entry Doesn't exists");
            return redirect(route('admin.masters.price'));
        } 
    }
    
    // End Of Pricing Methods

    // Plan Methods

    /**
     * 
     * 
     * @return View
     */
    public function DefaultPlan(): View
    {
        $default_plan= DefaultPlan::all();
        return view('admin.master.default_plan', compact('default_plan'));
    }

    /**
     * 
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function DefaultPlanSubmit(Request $request): Redirector|RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);

        try {
            $default_plan = new DefaultPlan();
            $default_plan->title = $request->title;
            $default_plan->description = $request->description;
            $default_plan->price = $request->price;
            $default_plan->save();

            flash()->success('Plan Created');
            return redirect(route('admin.masters.plan'));
        } catch (\Throwable $th) {
            flash()->error('Plan not created');
            return redirect(route('admin.masters.plan'));
        }
    }

    /**
     * 
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function DefaultPlanEdit(Request $request): Redirector|RedirectResponse
    {
        $request->validate([
            'newtitle' => 'required',
            'newdescription' => 'required',
            'newprice' => 'required|numeric',
            'editid' => 'required'
        ]);

        try {
            $default_plan = DefaultPlan::find($request->editid);
            $default_plan->title = $request->newtitle;
            $default_plan->description = $request->newdescription;
            $default_plan->price = $request->newprice;
            $default_plan->save();

            flash()->success('Plan Edited Successfully');
            return redirect(route('admin.masters.plan'));
        } catch (\Throwable $th) {
            flash()->error('Plan not Edited');
            return redirect(route('admin.masters.plan'));
        }
    }

    /**
     * 
     * @param $id
     * @return Redirector|RedirectResponse
     */
    public function DefaultPlanStatus($id): Redirector|RedirectResponse
    {
        try {
            $default_plan = DefaultPlan::find($id);
            if($default_plan->status == 0){
                $default_plan->status = 1;
            }else{
                $default_plan->status = 0;
            }
            $default_plan->save();

            flash()->success('Status Edited Successfully');
            return redirect(route('admin.masters.plan'));
        } catch (\Throwable $th) {
            flash()->error('Unexpectec Error');
            return redirect(route('admin.masters.plan'));
        }
    }

    /**
     * 
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function DefaultPlanDelete(Request $request): Redirector|RedirectResponse
    {
        $request->validate([
            'id' => 'required'
        ]);

        try {
            $default_plan = DefaultPlan::find($request->id);
            if($default_plan->exists()){
                $default_plan->delete();
            }

            flash()->success('Plan Deleted');
            return redirect(route('admin.masters.plan'));
        } catch (\Throwable $th) {
            flash()->success("Entry Doesn't exists");
            return redirect(route('admin.masters.plan'));
        } 
    }

    // End Of Plan Methods


    // service Methods

    /**
     * 
     * 
     * @return View
     */
    public function DefaultService(): View
    {
        $default_service= DefaultService::all();
        return view('admin.master.default_services', compact('default_service'));
    }

    /**
     * 
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function DefaultServiceSubmit(Request $request): Redirector|RedirectResponse
    {
        $request->validate([
            'service_type' => 'required',
            'price' => 'required|numeric'
        ]);

        try {
            $default_service = new DefaultService();
            $default_service->service_type = $request->service_type;
            $default_service->price = $request->price;
            $default_service->save();

            flash()->success('Service Created');
            return redirect(route('admin.masters.service'));
        } catch (\Throwable $th) {
            flash()->error('Service not created');
            return redirect(route('admin.masters.service'));
        }
    }

    /**
     * 
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function DefaultServiceEdit(Request $request): Redirector|RedirectResponse
    {
        $request->validate([
            'newservice_type' => 'required',
            'newprice' => 'required|numeric',
            'editid' => 'required'
        ]);

        try {
            $default_service = DefaultService::find($request->editid);
            $default_service->service_type = $request->newservice_type;
            $default_service->price = $request->newprice;
            $default_service->save();

            flash()->success('Service Edited Successfully');
            return redirect(route('admin.masters.service'));
        } catch (\Throwable $th) {
            flash()->error('Service not Edited');
            return redirect(route('admin.masters.service'));
        }
    }

    /**
     * 
     * @param $id
     * @return Redirector|RedirectResponse
     */
    public function DefaultServiceStatus($id): Redirector|RedirectResponse
    {
        try {
            $default_service = DefaultService::find($id);
            if($default_service->status == 0){
                $default_service->status = 1;
            }else{
                $default_service->status = 0;
            }
            $default_service->save();

            flash()->success('Status Edited Successfully');
            return redirect(route('admin.masters.service'));
        } catch (\Throwable $th) {
            flash()->error('Unexpectec Error');
            return redirect(route('admin.masters.service'));
        }
    }

    /**
     * 
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function DefaultServiceDelete(Request $request): Redirector|RedirectResponse
    {
        $request->validate([
            'id' => 'required'
        ]);

        try {
            $default_service = DefaultService::find($request->id);
            if($default_service->exists()){
                $default_service->delete();
            }

            flash()->success('Service Deleted');
            return redirect(route('admin.masters.service'));
        } catch (\Throwable $th) {
            flash()->success("Entry Doesn't exists");
            return redirect(route('admin.masters.service'));
        } 
    }

    // End Of service Methods


    // start gift Methods

    /**
     * 
     * 
     * @return View
     */
    public function DefaultGift(): View
    {
        $gift = Gift::all();
        return view('admin.master.default_gift', compact('gift'));
    }

    /**
     * 
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function DefaultGiftSubmit(Request $request): Redirector|RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'giftlogo' => 'required|image',
            'price' => 'required|numeric'
        ]);

        $gift_image = time() . '_' . rand(1000,10000000) . '_' .$request->giftlogo->getClientOriginalName();
        $request->giftlogo->move(public_path('gift'), $gift_image, 'real_publics');

        try {
            $gift = new Gift();
            $gift->name = $request->name;
            $gift->image = $gift_image;
            $gift->price = $request->price;
            $gift->save();

            flash()->success('Gift Created');
            return redirect(route('admin.masters.gift'));
        } catch (\Throwable $th) {
            flash()->error('Gift not created');
            return redirect(route('admin.masters.gift'));
        }
    }

    /**
     * 
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function DefaultGiftEdit(Request $request): Redirector|RedirectResponse
    {
        $request->validate([
            'newgiftlogo' => 'nullable|image',
            'newprice' => 'required|numeric',
            'newname' => 'required',
            'editid' => 'required'
        ]);

        try {
            $gift = Gift::find($request->editid);
            $gift->name = $request->newname;
            $gift->price = $request->newprice;
            if(isset($request->newgiftlogo) && !is_null($request->newgiftlogo))
            {
                if(File::exists(public_path('gift/').$gift->image))
                {
                    File::delete(public_path('gift/').$gift->image);
                }
                $gift_image = time() . '_' . rand(1000,10000000) . '_' .$request->newgiftlogo->getClientOriginalName();
                $request->newgiftlogo->move(public_path('gift'), $gift_image, 'real_publics');

                $gift->image = $gift_image;
            }
            $gift->save();

            flash()->success('Gift Edited Successfully');
            return redirect(route('admin.masters.gift'));
        } catch (\Throwable $th) {
            flash()->error('Gift not Edited');
            return redirect(route('admin.masters.gift'));
        }
    }

    /**
     * 
     * @param $id
     * @return Redirector|RedirectResponse
     */
    public function DefaultGiftStatus($id): Redirector|RedirectResponse
    {
        try {
            $gift = Gift::find($id);
            if($gift->status == 0){
                $gift->status = 1;
            }else{
                $gift->status = 0;
            }
            $gift->save();

            flash()->success('Status Edited Successfully');
            return redirect(route('admin.masters.gift'));
        } catch (\Throwable $th) {
            flash()->error('Unexpectec Error');
            return redirect(route('admin.masters.gift'));
        }
    }

    /**
     * 
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function DefaultGiftDelete(Request $request): Redirector|RedirectResponse
    {
        $request->validate([
            'id' => 'required'
        ]);

        try {
            $gift = Gift::find($request->id);
            if($gift->exists()){
                $gift->delete();
            }

            flash()->success('Gift Deleted');
            return redirect(route('admin.masters.gift'));
        } catch (\Throwable $th) {
            flash()->success("Entry Doesn't exists");
            return redirect(route('admin.masters.gift'));
        } 
    }

    // End Of gift Methods

    // start Category Methods

    /**
     * 
     * 
     * @return View
     */
    public function Category(): View
    {
        $category = Categories::all();
        return view('admin.master.category', compact('category'));
    }

    /**
     * 
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function CategorySubmit(Request $request): Redirector|RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'icon' => 'required|image',
        ]);

        $gift_image = time() . '_' . rand(1000,10000000) . '_' .$request->icon->getClientOriginalName();
        $request->icon->move(public_path('category'), $gift_image, 'real_publics');

        try {
            $gift = new Categories();
            $gift->name = $request->title;
            $gift->icon = $gift_image;
            $gift->save();

            flash()->success('Category Created');
            return redirect(route('admin.masters.category'));
        } catch (\Throwable $th) {
            flash()->error('Category not created');
            return redirect(route('admin.masters.category'));
        }
    }

    /**
     * 
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function CategoryEdit(Request $request): Redirector|RedirectResponse
    {
        $request->validate([
            'newicon' => 'nullable|image',
            'newtitle' => 'required',
            'editid' => 'required'
        ]);

        try {
            $category = Categories::find($request->editid);
            $category->name = $request->newtitle;

            if(isset($request->newicon) && !is_null($request->newicon))
            {
                if(File::exists(public_path('category/').$category->icon))
                {
                    File::delete(public_path('category/').$category->icon);
                }
                $gift_image = time() . '_' . rand(1000,10000000) . '_' .$request->newicon->getClientOriginalName();
                $request->newicon->move(public_path('category'), $gift_image, 'real_publics');

                $category->icon = $gift_image;
            }
            $category->save();

            flash()->success('Category Edited Successfully');
            return redirect(route('admin.masters.category'));
        } catch (\Throwable $th) {
            flash()->error('Category not Edited');
            return redirect(route('admin.masters.category'));
        }
    }

    /**
     * 
     * @param $id
     * @return Redirector|RedirectResponse
     */
    public function CategoryStatus($id): Redirector|RedirectResponse
    {
        try {
            $category = Categories::find($id);
            if($category->status == 0){
                $category->status = 1;
            }else{
                $category->status = 0;
            }
            $category->save();

            flash()->success('Category Edited Successfully');
            return redirect(route('admin.masters.category'));
        } catch (\Throwable $th) {
            flash()->error('Unexpectec Error');
            return redirect(route('admin.masters.category'));
        }
    }

    /**
     * 
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function CategoryDelete(Request $request): Redirector|RedirectResponse
    {
        $request->validate([
            'id' => 'required'
        ]);

        try {
            $category = Categories::find($request->id);
            if($category->exists()){
                $category->delete();
            }

            flash()->success('Category Deleted');
            return redirect(route('admin.masters.category'));
        } catch (\Throwable $th) {
            flash()->success("Entry Doesn't exists");
            return redirect(route('admin.masters.category'));
        } 
    }

    // End Of Category Methods
}
