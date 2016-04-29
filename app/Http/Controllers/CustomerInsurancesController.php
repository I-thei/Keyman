<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Customer;
use App\Insurance;
use URL;

class CustomerInsurancesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['only' => ['destroy']]);
    }

    public function create()
    {
        $plans = Insurance::pluck('name', 'id');
        $plans->prepend(null);
        return view('customers.insurances.create', compact('plans'));
    }

    public function store(Request $request)
    {
        $customer = Customer::findOrFail($request->segment(2));
        $this->validate($request, $this->getRules());
        $input = $request['name'];
        $request->merge(['insurance_id' => $input]);
        if (!$customer->insurances->contains($request['insurance_id'])) {
            $customer->insurances()->attach($request->only(['insurance_id']));
            flash()->success('Insurance has been added!');
            return redirect()->route('customers.show', [$customer]);
        }
        flash()->error('Insurance already exists!');
        return redirect()->route('customers.show', [$customer]);

    }

    // admin only
    public function destroy(Customer $customer, Insurance $insurance)
    {
        $customer->insurances()->detach($insurance->id);
        flash()->success('Insurance Plan has been deleted!');
        return redirect()->route('customers.show', [$customer]);
    }

    private function getRules()
    {
        return [
            'name' => 'required|not_in:0',
            // 'type' => 'required|not_in:0'
        ];
    }
}
