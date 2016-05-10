<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Customer;
use URL;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['only' => ['destroy']]);
    }

    // shows list of customers
    public function index(Request $request)
    {
        $out = $this->sort($request);
        $sortby = $out['sortby'];
        $order = $out['order'];
        $sortMethod = 'CustomersController@index';

        $old = Customer::all();
        $customers = $out['customers']->intersect($old);

        return view('customers.index', compact('customers', 'sortby', 'order', 'sortMethod'));
    }

    // shows details of each customer inclusing insurance and requests
    public function show(Request $request, Customer $customer)
    {
        $out = (new RequestsController)->sort($request);
        $sortby = $out['sortby'];
        $order = $out['order'];
        $sortMethod = 'CustomersController@show';
        $attach = $customer->id;

        $showUser = true;
        $showCustomer = false;
        $old = $customer->requests;
        $requests = $out['requests']->intersect($old);

        $count = $this->countRequests($customer);


        return view('customers.show', compact('customer', 'showUser', 'showCustomer', 'requests', 'sortby', 'order', 'sortMethod', 'attach', 'count'));
    }

    // shows create customer form
    public function create()
    {
        return view('customers.create');
    }

    // processes create customer form to database
    public function store(Request $request)
    {
        $this->validate($request, $this->getRules());
        $customer = Customer::create($request->all());

        flash()->success($customer->fullName . ' has been created!');
        return redirect('customers');
    }

    // shows edit customer form
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    // processes edit customer form to database
    public function update(Customer $customer, Request $request)
    {
        $rules = $this->getRules();
        $rules['email'] = 'unique:customers' . ',id,' . $customer->id;
        $rules['phone_num'] = 'required|regex:/^\+?[^a-zA-Z]{5,}$/|unique:customers' . ',id,' . $customer->id;

        $this->validate($request, $rules);
        $customer->update($request->all());

        flash()->success($customer->fullName . ' has been updated!');
        return redirect(URL::route('customers.show', [$customer->id]));
    }

    // admin only
    // processes delete customer to database
    public function destroy(Customer $customer, Request $request)
    {
        $name = $customer->fullName;
        $customer->delete();

        flash()->success($name . ' has been deleted!');
        return redirect('customers');
    }

    // validation rules
    private function getRules()
    {
        return [
            'first_name' => 'required|regex:/^[(a-zA-Z\s)]+$/u',
            'last_name' => 'required|regex:/^[(a-zA-Z\s)]+$/u',
            'middle_name' => 'regex:/^[(a-zA-Z\s)]+$/u',
            'email' => 'unique:customers',
            'phone_num' => 'required|unique:customers|regex:/^\+?[^a-zA-Z]{5,}$/'
        ];
    }

    private function sort(Request $request)
    {
        // sortby = total_requests, name, email
        $sortby = $request->input('sortby');
        $order = $request->input('order');
        if (!$order) {
            $order = 'asc';
        }
        if ($sortby) {
            if ($sortby == 'name') {
                $customers = Customer::orderByName($order)->get();
            } elseif ($sortby == 'requests') {
                $customers = Customer::orderByRequests($order)->get();
            } else {
                $customers = Customer::orderBy($sortby, $order)->get();
            }

        } else {
            $sortby = 'name';
            $customers = Customer::orderByName($order)->get();
        }

        return ['sortby' => $sortby, 'order' => $order, 'customers' => $customers];
    }

    private function countRequests(Customer $customer)
    {
        $completedList = $customer->requests()->where('status', '=', 'COMPLETED')->get();
        $overdue = 0;
        $early = 0;
        $onTime = 0;
        foreach ($completedList as $completed) {
            $ideal = $completed->created_at->addDays($completed->type->ideal_turnaround)->startOfDay();

            if ($completed->turnaround_date->startOfDay()->gt($ideal)) {
                $overdue += 1;

            } elseif ($completed->turnaround_date->startOfDay()->lt($ideal)) {
                $early += 1;

            } else {
                $onTime += 1;
            }
        }

        return ['overdue' => $overdue, 'early' => $early, 'on time' => $onTime];
    }
}
