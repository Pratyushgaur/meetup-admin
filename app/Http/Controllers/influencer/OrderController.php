<?php

namespace App\Http\Controllers\influencer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function pending(){
        return view('influencer.orders.pending');
    }
    function history(){
        return view('influencer.orders.order_history');
    }
}
