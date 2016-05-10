<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Customer;
use App\Insurance;
use URL;
use Carbon\Carbon;

class CustomerInsurancesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['only' => ['destroy']]);
    }

    /**
     * Shows Add Insurance To Customer form
     * @param  Request $request
     * @return view
     */
    public function create(Request $request)
    {
        $customer = Customer::findOrFail($request->segment(2));
        $plans = \DB::table('insurances')->join('providers', 'providers.id', '=', 'insurances.provider_id')->select(\DB::raw("CONCAT(insurances.name, ' -- ', providers.name) AS full_name, insurances.id"))->pluck('full_name', 'id');
        $plans = collect($plans);
        $plans->prepend(null, 0);

        return view('customers.insurances.create', compact('plans', 'customer'));
    }

    /**
     * Adds Insurance to Customer after validation
     * @param  Request $request
     * @return redirect to Customer Details page
     */
    public function store(Request $request)
    {
        $customer = Customer::findOrFail($request->segment(2));
        $this->validate($request, $this->getRules());
        $input = $request['name'];
        $request->merge(['insurance_id' => $input]);
        $valid = Carbon::now()->addYear()->toDateTimeString();
        
        if (!$customer->insurances->contains($request['insurance_id'])) {
            $customer->insurances()->attach($request['insurance_id'], ['valid_until' => $valid]);
            flash()->success(Insurance::findOrFail($request['insurance_id'])->name . ' has been added!');
        } else {
            flash()->error(Insurance::findOrFail($request['insurance_id'])->name . ' already exists!');
        }
        return redirect()->route('customers.show', [$customer]);

    }

    /**
     * Removes Insurance from Customer
     * Admin only
     * @param  Customer  $customer
     * @param  Insurance $insurance
     * @return redirect to Customer Details page
     */
    public function destroy(Customer $customer, Insurance $insurance)
    {
        $customer->insurances()->detach($insurance->id);
        $ids = $customer->requests()->where('insurance_id', $insurance->id)->pluck('insurance_id')->all();
        $deletedRows = $customer->requests()->whereIn('insurance_id', $ids)->delete();
        $customer->total_requests = $customer->requests()->count();
        $customer->save();

        flash()->success($insurance->name . ' has been removed!');
        return redirect()->route('customers.show', [$customer]);
    }

    /**
     * Validation Rules
     * @return array
     */
    private function getRules()
    {
        return [
            'name' => 'required|not_in:0',
        ];
    }
}
