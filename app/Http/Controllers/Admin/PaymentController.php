<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Redirector;

class PaymentController extends Controller
{
    // start payment list method

    /**
     * 
     * 
     * @return View
     */
    public function paymentList(): View
    {
       
        return view('admin.payments.payment_list');
    }
}
