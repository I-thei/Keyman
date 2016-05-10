<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\RequestType;

class RequestTypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Shows Alphabetical list of RequestTypes
     * Admin Only
     * @return view
     */
    public function index()
    {
        $types = RequestType::orderBy('name')->get();

        return view('request_types.index', compact('types'));
    }

    /**
     * Shows Add new Request Type form
     * Admin Only
     * @return view
     */
    public function create()
    {
        return view('request_types.create');
    }

    /**
     * Adds Request Type after validation
     * Admin Only
     * @param  Request $request
     * @return redirect to Request Types list
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->getRules());
        $type = RequestType::create($request->all());

        flash()->success($type->name . ' has been created!');
        return redirect('request_types');
    }

    /**
     * Shows Edit Request Type form
     * Admin Only
     * @param  RequestType $type
     * @return view
     */
    public function edit(RequestType $type)
    {
        return view('request_types.edit', compact('type'));
    }

    /**
     * Updates Request Type after validation
     * Admin Only
     * @param  RequestType $type
     * @param  Request     $request
     * @return redirect to Request Types list
     */
    public function update(RequestType $type, Request $request)
    {
        $rules = $this->getRules();
        $rules['name'] = 'required|regex:/^[(a-zA-Z\s)]+$/u|unique:request_types' . ',id,' . $type->id;

        $this->validate($request, $rules);
        $type->update($request->all());

        flash()->success($type->name . ' has been updated!');
        return redirect('request_types');
    }

    /**
     * Deletes Request Types and sets foreign keys to null
     * @param  RequestType $type
     * @param  Request     $request
     * @return redirect to Request Types list
     */
    public function destroy(RequestType $type, Request $request)
    {
        $type->delete();

        flash()->success($type->name . ' has been deleted!');
        return redirect('request_types');
    }

    /**
     * Validation Rules
     * @return array
     */
    private function getRules()
    {
        return [
            // alphabetical + spaces
            'name' => 'required|regex:/^[(a-zA-Z\s)]+$/u|unique:request_types',
            'ideal_turnaround' => 'required|integer|min:0'
        ];
    }
}
