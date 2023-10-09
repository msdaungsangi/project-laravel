<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Contracts\Services\LoginServiceInterface;

/**
 * HomeController
 */
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

    /**
     * passwordChange
     *
     * @return void
     */
    public function passwordChange()
    {
        return view('auth.change');
    }
    
    /**
     * updatePassword
     *
     * @param  mixed $request
     * @return void
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|max:255',
            'new_password_confirmation' => 'required|max:255',
        ]);

        $password = $request->only(
            'new_password',
        );

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            $oldPass = config('messages.login.old_pass_incorrect');
            return back()->with('error', $oldPass);
        } else if ($request->new_password != $request->new_password_confirmation) {
            $samePass = config('messages.login.pass_same');
            return back()->with('error', $samePass);
        } else {
            $success = config('messages.login.pass_change_success');
            $this->loginService->updatePassword($request, $password);
            return redirect()->route('home')->with('success', $success);
        }
    }
}
