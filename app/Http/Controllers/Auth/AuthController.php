<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RequestsController;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/account';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => ['logout', 'index', 'edit', 'showRegistrationForm', 'register', 'update', 'show', 'setAdmin']]);
        $this->middleware('admin', ['only' => ['showRegistrationForm', 'register', 'setAdmin', 'index']]);
    }

    // validation rules
    private function getRules()
    {
        return [
            'name' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'phone_num' => 'required|numeric|unique:users',
            'password' => 'required|min:6|confirmed',
        ];
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_num' => $data['phone_num'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $rules = $this->getRules();
        $this->validate($request, $rules);

        $user = $this->create($request->all());

        flash()->success($user->name . ' has been registered!');
        return redirect('users');
    }

    public function index(Request $request)
    {
        $out = $this->sort($request);
        $sortby = $out['sortby'];
        $order = $out['order'];
        $sortMethod = 'Auth\AuthController@index';

        $old = User::all();
        $users = $out['users']->intersect($old);
        return view('auth.index', compact('users', 'sortby', 'order', 'sortMethod'));
    }

    public function edit(User $user)
    {
        return view('auth.edit', compact('user'));
    }
    
    public function update(Request $request)
    {
        $rules = $this->getRules();
        $rules['name'] = 'required|max:255|unique:users' . ',id,' . \Auth::id();
        $rules['email'] = 'required|email|max:255|unique:users' . ',id,' . \Auth::id();
        $rules['phone_num'] = 'required|numeric|unique:users' . ',id,' . \Auth::id();
        $rules['password'] = 'min:6|confirmed';
        $this->validate($request, $rules);

        $request['password'] = bcrypt($request['password']);
        \Auth::user()->update($request->all());

        flash()->success('Account has been updated!');
        return redirect('account');
    }

    public function show(Request $request, User $user)
    {
        if ($user->id == \Auth::id()) {
            return redirect('account');
        }

        $out = (new RequestsController)->sort($request);
        $sortby = $out['sortby'];
        $order = $out['order'];
        $sortMethod = 'Auth\AuthController@show';
        $attach = $user->id;

        $showUser = false;
        $showCustomer = true;
        $old = $user->requests;
        $requests = $out['requests']->intersect($old);

        return view('auth.show', compact('user', 'showUser', 'showCustomer', 'requests', 'sortby', 'order', 'sortMethod', 'attach'));
    }

    public function setAdmin(User $user)
    {
        $s = "set";
        if ($user->isAdmin()) {
            $user->is_admin = 0;
            $s = "unset";
        } else {
            $user->is_admin = 1;
        }
        $user->save();

        flash()->success($user->name . ' has been '. $s .' as admin!');
        return redirect('users');
    }

    private function sort(Request $request)
    {
        // sortby = is_admin, name, email
        $sortby = $request->input('sortby');
        $order = $request->input('order');
        if (!$order) {
            $order = 'asc';
        }
        if ($sortby) {
            $users = User::orderBy($sortby, $order)->get();

        } else {
            $sortby = 'name';
            $users = User::orderBy($sortby, $order)->get();
        }

        return ['sortby' => $sortby, 'order' => $order, 'users' => $users];
    }
}
