<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Customer;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['only' => ['destroy']]);
    }

    /**
     * Shows Sorted list of Customers
     * @param  Request $request
     * @return view
     */
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

    /**
     * Shows Customer Details page
     * including Insurance List and Request List
     * @param  Request  $request
     * @param  Customer $customer
     * @return view
     */
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

    /**
     * Shows Add Customer form
     * @return view
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Adds new Customer after validation
     * @param  Request $request
     * @return redirect to Customers list
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->getRules());
        $customer = Customer::create($request->all());

        flash()->success($customer->fullName . ' has been created!');
        return redirect('customers');
    }

    /**
     * Shows Edit Customer form
     * @param  Customer $customer
     * @return view
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Updates Customer profile after validation
     * @param  Customer $customer
     * @param  Request  $request
     * @return redirect to Customer Details page
     */
    public function update(Customer $customer, Request $request)
    {
        $rules = $this->getRules();
        $rules['email'] = 'unique:customers' . ',id,' . $customer->id;
        $rules['phone_num'] = 'required|regex:/^\+?[^a-zA-Z]{5,}$/|unique:customers' . ',id,' . $customer->id;

        $this->validate($request, $rules);
        $customer->update($request->all());

        flash()->success($customer->fullName . ' has been updated!');
        return redirect()->route('customers.show', [$customer]);
    }

    /**
     * Deletes Customer and all their Requests
     * Admin Only
     * @param  Customer $customer
     * @param  Request  $request
     * @return redirect to Customers list
     */
    public function destroy(Customer $customer, Request $request)
    {
        $name = $customer->fullName;
        $customer->delete();

        flash()->success($name . ' has been deleted!');
        return redirect('customers');
    }

    /**
     * Validation Rules
     * @return array
     */
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

    /**
     * Helper method to sort Customers list
     * @param  Request $request
     * @return array
     */
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

    /**
     * Helper method to count requests that were completed
     * Early, On Time, or Overdue
     * @param  Customer $customer
     * @return array
     */
    private function countRequests(Customer $customer)
    {
        $completedList = $customer->requests()->where('status', '=', 'COMPLETED')->get();
        $overdue = 0;
        $early = 0;
        $onTime = 0;
        foreach ($completedList as $completed) {
            if ($completed->type) {
                $ideal = $completed->created_at->addDays($completed->type->ideal_turnaround)->startOfDay();
            } else {
                $ideal = $completed->created_at->startOfDay();
            }

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
