<?php

namespace App\Http\Controllers\influencer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
class OrderController extends Controller
{
    function pending(){
        $orders = Order::where('order_type','=','service_purchase')->leftJoin('service_bookings','orders.detail_id','=','service_bookings.id')->join('users','orders.userid','=','users.id')->where('orders.influencer_id','=',auth()->user()->id)->where('order_status','=','0')->orderBy('orders.id','desc')->select('orders.*','users.name','service_bookings.price as service_price','title','description')->get();
        
        return view('influencer.orders.pending',compact('orders'));
    }
    function history(){
        return view('influencer.orders.order_history');
    }

    function orderDelivered($orderid){
        Order::where('id','=',$orderid)->where('orders.influencer_id','=',auth()->user()->id)->update([
            'order_status' => '1'
        ]);
        return redirect()->back();
    }
}
