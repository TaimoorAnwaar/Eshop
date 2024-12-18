<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/about';  // Default redirect route (change this if needed)

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return mixed
     */
    protected function authenticated($request, $user)
    {
        // Redirect based on user role
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        elseif($user->hasRole('manager')){
            return redirect()->route('manager.products.index');
        }
        else{

        // Default to home route for other users
        return redirect()->route('about');
        }
    }
}
