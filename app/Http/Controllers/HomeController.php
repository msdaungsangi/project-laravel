<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Contracts\Services\LoginServiceInterface;

class HomeController extends Controller
{    
    /**
     * loginService
     *
     * @var mixed
     */
    protected $loginService;

    /**
     * __construct
     *
     * @param  mixed $loginService
     * @return void
     */
    public function __construct(LoginServiceInterface $loginService)
    {
        $this->middleware('auth');
        $this->loginService = $loginService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function passwordChange()
    {
        return view('auth.change');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|max:255',
            'new_password_confirmation' => 'required|max:255',
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with('error', 'Old password is incorrect.');
        }
        if ($request->new_password != $request->new_password_confirmation) {
            return back()->with('error', 'New password and confirm password must be the same.');
        }

        auth()->user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('home')->with('success', 'Password changed successfully.');
    }
}
