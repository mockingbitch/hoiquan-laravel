<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if ($admin = Auth::guard('admin')->user())
        {
            return view('admin.index',['user'=>$admin]);
        }

        return redirect()->route('admin.login');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Request $request)
    {
        $credentials =  $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {

            return redirect()->route('admin.home');
        }
        else{

            return view('admin.login')->with('msg','Wrong username or password!!!');
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function loginView()
    {
        if ($admin = Auth::guard('admin')->user())
        {

            return redirect()->route('admin.home');
        }

        return view('admin.login');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect('admin/login');
    }
}
