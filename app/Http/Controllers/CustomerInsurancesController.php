<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Customer;
use App\InsuranceType;
use App\Insurance;
use App\Provider;
use URL;

class CustomerInsurancesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['only' => ['destroy']]);
    }

    public function create()
    {
        $types = InsuranceType::pluck('name', 'id');
        $types->prepend(null);
        $providers = Insurance::pluck('name', 'id');
        $plans = Insurance::pluck('name', 'id');
        $plans->prepend(null);
        return view('customers.insurances.create', compact('plans', 'types', 'providers'));
    }

    public function store(Request $request)
    {
        $provider = Provider::findOrFail($request->segment(2));
        $this->validate($request, $this->getRules());
        $input = $request['type'];
        $request->merge(['insurance_type_id' => $input]);
        $insurance = $provider->insurances()->create($request->except(['type']));

        flash()->success('Insurance Plan has been created!');
        return redirect()->route('providers.show', [$provider]);
    }

    public function edit(Provider $provider, Insurance $insurance)
    {
        $types = InsuranceType::pluck('name', 'id');
        $types = $types->all();
        $selected = $insurance->insuranceType->id;

        return view('insurances.edit', compact('insurance', 'types', 'selected'));
    }

    public function update(Provider $provider, Insurance $insurance, Request $request)
    {
        $this->validate($request, $this->getRules());
        $input = $request['type'];
        $request->merge(['insurance_type_id' => $input]);

        $insurance->update($request->except(['type']));

        flash()->success('Insurance Plan has been updated!');
        return redirect()->route('providers.show', [$provider]);
    }

    // admin only
    public function destroy(Provider $provider, Insurance $insurance)
    {
        $insurance->delete();

        flash()->success('Insurance Plan has been deleted!');
        return redirect()->route('providers.show', [$provider]);
    }

    private function getRules()
    {
        return [
            'name' => 'required',
            'type' => 'required|not_in:0'
        ];
    }
}
