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
        $samePass = config('messages.login.pass_same');
        $oldPass = config('messages.login.old_pass_incorrect');
        $success = config('messages.login.pass_change_success');

        $password = $request->only(
            'new_password',
        );

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with('error', $oldPass);
        } else if ($request->new_password != $request->new_password_confirmation) {
            return back()->with('error', $samePass);
        } else {
            $this->loginService->updatePassword($request, $password);
            return redirect()->route('home')->with('success', $success);
        }
    }

}
