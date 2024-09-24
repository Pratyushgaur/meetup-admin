<?php

namespace App\Http\Controllers\influencer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    function index(){
        return view('influencer.home.links');
    }
}
