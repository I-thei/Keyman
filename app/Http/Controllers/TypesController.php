<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\InsuranceType;

class TypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    // admin only
    // shows list of insurance types
    public function index()
    {
        $types = InsuranceType::all();

        return view('types.index', compact('types'));
    }

    // admin only
    // shows create insurance type form
    public function create()
    {
        return view('types.create');
    }

    // admin only
    // processes create insurance type form
    public function store(Request $request)
    {
        $this->validate($request, $this->getRules());
        $type = InsuranceType::create($request->all());

        flash()->success('Insurance Type has been created!');
        return redirect('types');
    }

    // admin only
    // shows edit insurance type form
    public function edit(InsuranceType $type)
    {
        return view('types.edit', compact('type'));
    }

    // admin only
    // processes edit insurance type form
    public function update(InsuranceType $type, Request $request)
    {
        $rules = $this->getRules();
        $rules['name'] = 'required|regex:/^[(a-zA-Z\s)]+$/u|unique:insurance_types' . ',id,' . $type->id;

        $this->validate($request, $rules);
        $type->update($request->all());

        flash()->success('Insurance Type has been updated!');
        return redirect(route('types.index'));
    }

    // admin only
    // processes delete insurance type
    public function destroy(InsuranceType $type, Request $request)
    {
        $type->delete();

        flash()->success('Insurance Type has been deleted!');
        return redirect(route('types.index'));
    }

    // validation rules
    private function getRules()
    {
        return [
            'name' => 'required|regex:/^[(a-zA-Z\s)]+$/u|unique:insurance_types'
        ];
    }
}
