<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

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
     * @return Response
     */
    public function login(Request $request) : Response
    {
        $credentials =  $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.home');
        }
        else {
            return $this->errorResponse('Wrong username or password',403);
//            return view('admin.login')->with('msg','Wrong username or password!!!');
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function loginView()
    {
        if ($admin = Auth::guard('admin')->user()) {

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
