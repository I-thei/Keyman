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
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login
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

    /**
     * Validation Rules
     * @return array
     */
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

    /**
     * Shows New User form for Admins only
     * @return view
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Creates new User after validation
     * @param  Request $request
     * @return redirect to User list
     */
    public function register(Request $request)
    {
        $rules = $this->getRules();
        $this->validate($request, $rules);

        $user = $this->create($request->all());

        flash()->success($user->name . ' has been registered!');
        return redirect('users');
    }

    /**
     * Shows sorted list of registered Users
     * @param  Request $request
     * @return view
     */
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

    /**
     * Shows Edit Account form for logged in User
     * @param  User   $user
     * @return view
     */
    public function edit(User $user)
    {
        if ($user->id != \Auth::id()) {
            return redirect('users');
        }

        return view('auth.edit', compact('user'));
    }
    
    /**
     * Updates User info after validation
     * @param  Request $request
     * @return redirect back to account
     */
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

    /**
     * Show details page of a User
     * @param  Request $request
     * @param  User    $user
     * @return view
     */
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

    /**
     * Sets or Unsets User as Admin
     * @param User $user
     * @return redirect back to Users list
     */
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

    /**
     * Helper method to sort Users in Users list
     * @param  Request $request
     * @return array
     */
    private function sort(Request $request)
    {
        // sortby = is_admin, name, email
        $sortby = $request->input('sortby');
        $order = $request->input('order');
        if (!$order) {
            $order = 'asc';
        }
        if (!$sortby) {
            $sortby = 'name';
        }
        $users = User::orderBy($sortby, $order)->get();

        return ['sortby' => $sortby, 'order' => $order, 'users' => $users];
    }
}
