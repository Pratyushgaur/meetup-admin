<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request,RedirectResponse};
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Redirector;

class transactionController extends Controller
{

    /**
     * 
     * 
     * @return View
     */
    public function transactionUserList(): View
    {
       
        return view('admin.transaction.user_list');
    }

     /**
     * 
     * 
     * @return View
     */
    public function transactionInfluncerList(): View
    {
       
        return view('admin.transaction.influncer_list');
    }
}
