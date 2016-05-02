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

    public function about()
    {
        return view('about');
    }

    public function browse()
    {
        $customers = Customer::select(DB::raw("CONCAT(first_name, ' ', last_name, ', ', middle_name) AS full_name, id"))
            ->pluck('full_name', 'id');
        $customers->prepend(null, 0);
        $providers = Provider::pluck('name', 'id');
        $providers->prepend(null, 0);
        return view('browse', compact('customers', 'providers'));
    }

    public function account()
    {
        $showUser = false;
        $showCustomer = true;
        $requests = \Auth::user()->requests;
        return view('account', compact('showUser', 'showCustomer', 'requests'));
    }
}
