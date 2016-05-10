<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Provider;
use URL;

class ProvidersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => ['index', 'show']]);
    }

    // shows list of providers
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

    // shows details of each provider including plans
    public function show(Provider $provider)
    {
        return view('providers.show', compact('provider'));
    }

    // admin only
    // shows create provider form
    public function create()
    {
        return view('providers.create');
    }

    // admin only
    // processes create provider form
    public function store(Request $request)
    {
        $this->validate($request, $this->getRules());
        $provider = Provider::create($request->all());

        flash()->success($provider->name . ' has been added!');
        return redirect('providers');
    }

    // admin only
    // shows edit provider form
    public function edit(Provider $provider)
    {
        return view('providers.edit', compact('provider'));
    }

    // admin only
    // processes edit provider form
    public function update(Provider $provider, Request $request)
    {
        $rules = $this->getRules();
        $rules['name'] = 'required|unique:providers' . ',id,' . $provider->id;
        $rules['email'] = 'required|unique:providers' . ',id,' . $provider->id;
        $rules['phone_num'] = 'required|regex:/^\+?[^a-zA-Z]{5,}$/|unique:providers' . ',id,' . $provider->id;

        $this->validate($request, $rules);
        $provider->update($request->all());

        flash()->success($provider->name . ' has been updated!');
        return redirect(URL::route('providers.show', [$provider->id]));
    }

    // admin only
    // processes delete provider
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

    // validation rules
    private function getRules()
    {
        return [
            'name' => 'required|unique:providers',
            'location' => "regex:/[A-Za-z0-9'\.\-\s\,]/",
            'email' => 'required|unique:providers',
            'phone_num' => 'required|unique:providers|regex:/^\+?[^a-zA-Z]{5,}$/'
        ];
    }

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
