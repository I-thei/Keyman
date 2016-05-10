<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\KeymanRequest;
use App\RequestType;
use App\Insurance;
use App\Customer;
use \DB;
use Carbon\Carbon;

class RequestsController extends Controller
{
    /**
     * Shows Sorted list of Requests
     * @param  Request $request
     * @return view
     */
    public function index(Request $request)
    {
        $out = $this->sort($request);
        $sortby = $out['sortby'];
        $order = $out['order'];
        $sortMethod = 'RequestsController@index';
        
        $requests = $out['requests'];
        $showUser = true;
        $showCustomer = true;

        return view('requests.index', compact('requests', 'showUser', 'showCustomer', 'sortby', 'order', 'sortMethod'));
    }

    /**
     * Shows Add new Request to Customer form
     * @param  Request $request
     * @return view
     */
    public function create(Request $request)
    {
        $customer = Customer::findOrFail($request->segment(2));
        $plans = DB::table('insurances')->join('providers', 'providers.id', '=', 'insurances.provider_id')->join('customer_insurances', 'customer_insurances.insurance_id', '=', 'insurances.id')->where('customer_insurances.customer_id', '=', $customer->id)->select(DB::raw("CONCAT(insurances.name, ' -- ', providers.name) AS full_name, insurances.id"))->pluck('full_name', 'id');
        $plans = collect($plans);
        $plans->prepend(null, 0);
        $types = RequestType::pluck('name', 'id');
        $types->prepend(null, 0);

        return view('customers.requests.create', compact('types', 'plans', 'customer'));
    }

    /**
     * Adds Request to Customer after validation
     * @param  Request  $request
     * @param  Customer $customer
     * @return refirect to Customer Details page
     */
    public function store(Request $request, Customer $customer)
    {
        $this->validate($request, $this->getRules());
        $ideal = RequestType::findOrFail($request['request_type_id'])->ideal_turnaround;
        $request['turnaround_date'] = Carbon::parse($request['turnaround_date'])->addDays($ideal)->toDateTimeString();
        $request['status'] = 'ONGOING';

        $request['customer_id'] = $customer->id;
        $insurance = Insurance::findOrFail($request['insurance_id']);
        $type = RequestType::findOrFail($request['request_type_id']);

        $krequest = new KeymanRequest($request->all());
        $customer->requests()->save($krequest);
        $customer->total_requests = $customer->requests->count();
        $customer->save();
        $insurance->requests()->save($krequest);
        $type->requests()->save($krequest);

        $krequest->customer()->associate($customer);
        $krequest->insurance()->associate($insurance);
        $krequest->type()->associate($type);
        $krequest->users()->attach(\Auth::user()->id, ['progress' => 'created']);


        flash()->success('Request has been added!');
        return redirect()->route('customers.show', [$customer]);
    }

    /**
     * Sets Status To Pending
     * Flashes Provider Info
     * @param  Request       $request
     * @param  Customer      $customer
     * @param  KeymanRequest $krequest
     * @return redirects to previous page
     */
    public function update(Request $request, Customer $customer, KeymanRequest $krequest)
    {
        $krequest->users()->sync([\Auth::user()->id => ['progress' => 'sent request']]);
        $krequest->status = 'PENDING';
        $krequest->save();

        $provider = $krequest->insurance->provider;
        flash()->info('Send request to ' . $provider->name . ' at ' . $provider->email .' or ' . $provider->phone_num);
        return redirect()->back();
    }

    /**
     * Deletes Request
     * Admin Only
     * @param  Request       $request
     * @param  Customer      $customer
     * @param  KeymanRequest $krequest
     * @return redirects to previous page
     */
    public function destroy(Request $request, Customer $customer, KeymanRequest $krequest)
    {
        $krequest->users()->detach();
        $krequest->delete();
        $customer->total_requests = $customer->requests->count();
        $customer->save();

        flash()->success('Request has been deleted!');
        return redirect()->back();
    }

    /**
     * Sets Status to Complete
     * @param  Request       $request
     * @param  Customer      $customer
     * @param  KeymanRequest $krequest
     * @return redirects to previous page
     */
    public function complete(Request $request, Customer $customer, KeymanRequest $krequest)
    {
        $tdate = $krequest->turnaround_date->startOfDay();

        if (Carbon::now()->startOfDay()->gt($tdate)) {
            $completed = 'overdue';

        } elseif (Carbon::now()->startOfDay()->lt($tdate)) {
            $completed = 'early';

        } else {
            $completed = 'on time';
        }


        $krequest->users()->sync([\Auth::user()->id => ['progress' => $completed]]);
        $krequest->status = 'COMPLETED';
        $krequest->turnaround_date = Carbon::now()->toDateTimeString();
        $krequest->save();

        flash()->info('Notify ' . $customer->fullName . ' at ' . $customer->email .' or ' . $customer->phone_num);
        return redirect()->back();
    }

    /**
     * Validation Rules
     * @return array
     */
    private function getRules()
    {
        return [
            'insurance_id' => 'required|not_in:0',
            'request_type_id' => 'required|not_in:0'
        ];
    }

    /**
     * Helper method to sort Requests list
     * @param  Request $request
     * @return array
     */
    public function sort(Request $request)
    {
        // sortby = id, customer, insurance, type, turnaround, consultant, status
        $sortby = $request->input('sortby');
        $order = $request->input('order');
        if (!$order) {
            $order = 'asc';
        }
        if ($sortby) {
            if ($sortby == 'customer') {
                $requests = KeymanRequest::orderByCustomer($order)->get();
            } elseif ($sortby == 'insurance') {
                $requests = KeymanRequest::orderByInsurance($order)->get();
            } elseif ($sortby == 'type') {
                $requests = KeymanRequest::orderByType($order)->get();
            } elseif ($sortby == 'consultant') {
                $requests = KeymanRequest::orderByConsultant($order)->get();
            } elseif ($sortby == 'status') {
                $requests = KeymanRequest::orderByStatus($order)->get();
            } elseif ($sortby == 'turnaround') {
                $requests = KeymanRequest::orderByTurnaround($order)->get();
            } else {
                $requests = KeymanRequest::orderBy($sortby, $order)->get();
            }

        } else {
            $sortby = 'id';
            $order = 'desc';
            $requests = KeymanRequest::orderBy($sortby, $order)->get();
        }

        return ['sortby' => $sortby, 'order' => $order, 'requests' => $requests];
    }
}
