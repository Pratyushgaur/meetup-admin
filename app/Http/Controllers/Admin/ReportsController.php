<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserWalletTrasaction;
use Carbon\Carbon;
use Illuminate\Http\{Request,RedirectResponse};
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function Income(Request $request): View
    {
        if($request->has('search')) 
        {
            $users = UserWalletTrasaction::select('user_id' , DB::raw('SUM(amount) AS amount'))
            ->where('transction_type', '1')->groupBy('user_id')
            ->whereDate('created_at', $request->search)->with('user')->get();
        }else{
            $users = UserWalletTrasaction::select('user_id' , DB::raw('SUM(amount) AS amount'))
            ->where('transction_type', '1')->groupBy('user_id')
            ->whereDate('created_at', Carbon::now()->format('Y-m-d'))->with('user')->get();
        }
        
        return view('admin.reports.income', compact('users'));
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function Deposit(Request $request): View
    {
        if($request->has('search')) 
        {
            $users = PaymentTransaction::select('user_id' , DB::raw('SUM(amount) AS amount'))
            ->where('transaction_status', '1')->groupBy('user_id')
            ->whereDate('created_at', $request->search)->with('user')->get();
        }else{
            $users = PaymentTransaction::select('user_id' , DB::raw('SUM(amount) AS amount'))
            ->where('transaction_status', '1')->groupBy('user_id')
            ->whereDate('created_at', Carbon::now()->format('Y-m-d'))->with('user')->get();
        }
        
        return view('admin.reports.deposit', compact('users'));
    }
}
