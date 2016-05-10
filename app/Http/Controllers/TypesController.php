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

    /**
     * Shows Alphabetical list of Insurance Types
     * Admin Only
     * @return view
     */
    public function index()
    {
        $types = InsuranceType::orderBy('name')->get();

        return view('types.index', compact('types'));
    }

    /**
     * Shows Add new Insurance Type form
     * Admin Only
     * @return view
     */
    public function create()
    {
        return view('types.create');
    }

    /**
     * Add new Insurance Type after validation
     * Admin Only
     * @param  Request $request
     * @return redirect to Insurance Types list
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->getRules());
        $type = InsuranceType::create($request->all());

        flash()->success('Type: ' . $type->name . ' has been created!');
        return redirect('types');
    }

    /**
     * Shows Edit Insurance Type form
     * Admin Only
     * @param  InsuranceType $type
     * @return view
     */
    public function edit(InsuranceType $type)
    {
        return view('types.edit', compact('type'));
    }

    /**
     * Updates Insurance Type after Validation
     * Admin Only
     * @param  InsuranceType $type
     * @param  Request       $request
     * @return redirect to Insurance Types list
     */
    public function update(InsuranceType $type, Request $request)
    {
        $rules = $this->getRules();
        $rules['name'] = 'required|regex:/^[(a-zA-Z\s)]+$/u|unique:insurance_types' . ',id,' . $type->id;

        $this->validate($request, $rules);
        $type->update($request->all());

        flash()->success('Type: ' . $type->name . ' has been updated!');
        return redirect('types');
    }

    /**
     * Deletes Insurance Type and sets foreign keys to null
     * @param  InsuranceType $type
     * @param  Request       $request
     * @return redirect to Insurance Types list
     */
    public function destroy(InsuranceType $type, Request $request)
    {
        $type->delete();

        flash()->success('Type: ' . $type->name . ' has been deleted!');
        return redirect('types');
    }

    /**
     * Validation Rules
     * @return array
     */
    private function getRules()
    {
        return [
            //alpha+space
            'name' => 'required|regex:/^[(a-zA-Z\s)]+$/u|unique:insurance_types'
        ];
    }
}
