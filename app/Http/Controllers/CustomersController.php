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

    // shows list of customers
    public function index()
    {
        $customers = Customer::all();

        return view('customers.index', compact('customers'));
    }

    // shows details of each customer inclusing insurance and requests
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
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

        flash()->success('Customer has been created!');
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

        flash()->success('Customer has been updated!');
        return redirect(route('customers.show', [$customer->id]));
    }

    // admin only
    // processes delete customer to database
    public function destroy(Customer $customer, Request $request)
    {
        $customer->delete();

        flash()->success('Customer has been deleted!');
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
}
