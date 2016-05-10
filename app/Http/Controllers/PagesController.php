<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \DB;

use App\Customer;
use App\Provider;

class PagesController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function account(Request $request)
    {
        $out = (new RequestsController)->sort($request);
        $sortby = $out['sortby'];
        $order = $out['order'];
        $sortMethod = 'PagesController@account';
        
        $showUser = false;
        $showCustomer = true;
        $old = \Auth::user()->requests;
        $requests = $out['requests']->intersect($old);
        
        return view('account', compact('showUser', 'showCustomer', 'requests', 'sortby', 'order', 'sortMethod'));



    }
}
