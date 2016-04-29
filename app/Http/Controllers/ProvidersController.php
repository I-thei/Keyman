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

    public function index()
    {
        $providers = Provider::all();

        return view('providers.index', compact('providers'));
    }

    public function show(Provider $provider)
    {
        return view('providers.show', compact('provider'));
    }

    // admin only
    public function create()
    {
        return view('providers.create');
    }

    // admin only
    public function store(Request $request)
    {
        $this->validate($request, $this->getRules());
        $provider = Provider::create($request->all());

        flash()->success('Provider has been created!');
        return redirect('providers');
    }

    // admin only
    public function edit(Provider $provider)
    {
        return view('providers.edit', compact('provider'));
    }

    // admin only
    public function update(Provider $provider, Request $request)
    {
        $rules = $this->getRules();
        $rules['email'] = 'unique:providers' . ',id,' . $provider->id;
        $rules['phone_num'] = 'required|regex:/^\+?[^a-zA-Z]{5,}$/|unique:providers' . ',id,' . $provider->id;

        $this->validate($request, $rules);
        $provider->update($request->all());

        flash()->success('Provider has been updated!');
        return redirect(route('providers.show', [$provider->id]));
    }

    // admin only
    public function destroy(Provider $provider, Request $request)
    {
        $provider->delete();

        flash()->success('Provider has been deleted!');
        return redirect('providers');
    }

    private function getRules()
    {
        return [
            'name' => 'required|regex:/^[(a-zA-Z\s)]+$/u',
            'location' => "regex:/[A-Za-z0-9'\.\-\s\,]/",
            'email' => 'required|unique:providers',
            'phone_num' => 'required|unique:providers|regex:/^\+?[^a-zA-Z]{5,}$/'
        ];
    }
}
