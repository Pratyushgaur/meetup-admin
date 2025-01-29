<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\UserWalletTrasaction;
use Illuminate\Http\{Request,RedirectResponse};
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Redirector;

class transactionController extends Controller
{

    /**
     * @param Request $request
     * @return View
     */
    public function WalletTransaction(Request $request): View
    {
        $transactions = UserWalletTrasaction::query();
        if($request->has('date'))
        {
            $date = $request->get('date');
            $transactions = $transactions->whereDate('created_at', $date);
        }

        if($request->has('id') && $request->get('id') != 'All')
        {
            $search = $request->get('id');
            $transactions = $transactions->where('user_id', $request->id);
        }
        
        $transactions = $transactions->get();

        $influencers = User::orderBy('name' , 'asc')->get();
        return view('admin.transaction.wallet_transaction', compact('transactions', 'influencers'));
    }

     /**
     * @param Request $request
     * @return View
     */
    public function OrderTransaction(Request $request): View
    {
        $orders = Order::query();
        
        if($request->has('todate') && !is_null($request->get('todate')))
        {
            $date = $request->get('todate');
            $orders = $orders->whereDate('created_at' , '>=', $date);
        }

        if($request->has('fromdate') && !is_null($request->get('fromdate')))
        {
            $date = $request->get('fromdate');
            $orders = $orders->whereDate('created_at', '<=', $date);
        }

        if($request->has('influencer') && $request->get('influencer') != 'All')
        {
            $search = $request->get('influencer');
            $orders = $orders->where('influencer_id', $request->influencer);
        }

        if($request->has('user') && $request->get('user') != 'All')
        {
            $search = $request->get('user');
            $orders = $orders->where('userid', $request->user);
        }
        
        $orders = $orders->orderBy('id' , 'desc')->with(['influencer','user'])->get();
        
        $influencers = User::where('role' , '1')->orderBy('name' , 'asc')->get();
        $users = User::where('role' , '2')->orderBy('name' , 'asc')->get();
        return view('admin.transaction.order_transaction', compact('orders', 'influencers', 'users'));
    }
}
