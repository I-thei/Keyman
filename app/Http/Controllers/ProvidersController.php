<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Provider;

class ProvidersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => ['index', 'show']]);
    }

    /**
     * Shows sorted list of Providers
     * @param  Request $request
     * @return view
     */
    public function index(Request $request)
    {
        $out = $this->sort($request);
        $sortby = $out['sortby'];
        $order = $out['order'];
        $sortMethod = 'ProvidersController@index';

        $old = Provider::all();
        $providers = $out['providers']->intersect($old);

        return view('providers.index', compact('providers', 'sortby', 'order', 'sortMethod'));
    }

    /**
     * Shows Provider Details Page
     * including Insurance List
     * @param  Provider $provider
     * @return view
     */
    public function show(Provider $provider)
    {
        return view('providers.show', compact('provider'));
    }

    /**
     * Shows Add New Provider form
     * Admin Only
     * @return view
     */
    public function create()
    {
        return view('providers.create');
    }

    /**
     * Adds Provider after validation
     * Admin Only
     * @param  Request $request
     * @return redirects to Providers list
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->getRules());
        $provider = Provider::create($request->all());

        flash()->success($provider->name . ' has been added!');
        return redirect('providers');
    }

    /**
     * Shows Edit Provider form
     * Admin Only
     * @param  Provider $provider
     * @return view
     */
    public function edit(Provider $provider)
    {
        return view('providers.edit', compact('provider'));
    }

    /**
     * Updates Provider Info after validation
     * Admin Only
     * @param  Provider $provider
     * @param  Request  $request
     * @return redirect to Provider Details page
     */
    public function update(Provider $provider, Request $request)
    {
        $rules = $this->getRules();
        $rules['name'] = 'required|unique:providers' . ',id,' . $provider->id;
        $rules['email'] = 'required|unique:providers' . ',id,' . $provider->id;
        $rules['phone_num'] = 'required|regex:/^\+?[^a-zA-Z]{5,}$/|unique:providers' . ',id,' . $provider->id;

        $this->validate($request, $rules);
        $provider->update($request->all());

        flash()->success($provider->name . ' has been updated!');
        return redirect()->route('providers.show', [$provider->id]);
    }

    /**
     * Deletes Provider and all its Insurances and Requests
     * @param  Provider $provider
     * @param  Request  $request
     * @return redirect to Providers list
     */
    public function destroy(Provider $provider, Request $request)
    {
        $name = $provider->name;
        foreach ($provider->insurances as $insurance) {
            $customers = $insurance->customers;
            $insurance->delete();
            foreach ($customers as $customer) {
                $customer->total_requests = $customer->requests()->count();
                $customer->save();
            }
        }
        $provider->delete();
        flash()->success($name . ' has been deleted!');
        return redirect('providers');
    }

    /**
     * Validation Rules
     * @return array
     */
    private function getRules()
    {
        return [
            'name' => 'required|unique:providers',
            'location' => "regex:/[A-Za-z0-9'\.\-\s\,]/",
            'email' => 'required|unique:providers',
            'phone_num' => 'required|unique:providers|regex:/^\+?[^a-zA-Z]{5,}$/'
        ];
    }

    /**
     * Helper method to sort Providers list
     * @param  Request $request
     * @return array
     */
    private function sort(Request $request)
    {
        // sortby = name, email
        $sortby = $request->input('sortby');
        $order = $request->input('order');
        if (!$order) {
            $order = 'asc';
        }
        if ($sortby) {
            $providers = Provider::orderBy($sortby, $order)->get();

        } else {
            $sortby = 'name';
            $providers = Provider::orderBy($sortby, $order)->get();
        }

        return ['sortby' => $sortby, 'order' => $order, 'providers' => $providers];
    }
}
