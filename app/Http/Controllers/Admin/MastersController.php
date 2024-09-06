<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Service,Price};
use Illuminate\Http\{Request,RedirectResponse};
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Redirector;

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
        $price = Price::all();
        return view('admin.master.default_pricess', compact('price'));
    }

    /**
     * 
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function DefaultPlanSubmit(Request $request): Redirector|RedirectResponse
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
    public function DefaultPlanEdit(Request $request): Redirector|RedirectResponse
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
    public function DefaultPlanStatus($id): Redirector|RedirectResponse
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
    public function DefaultPlanDelete(Request $request): Redirector|RedirectResponse
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

    // End Of Plan Methods
}
