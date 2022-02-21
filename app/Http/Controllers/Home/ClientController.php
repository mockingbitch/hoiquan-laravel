<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ClientService;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Models\Client;
class ClientController extends Controller
{
    /**
     * @var ClientService
     */
    protected $clientService;

    /**
     * @param ClientService $clientService
     */
    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){

        return view('home.client.login');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function registerForm(){

        return view('home.client.register');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request){
        $client = $this->clientService->create($request);
        if ($client){
            Mail::send('home.mail.mail-register',compact('client'),function ($email) use($client){
                $email->subject('HoiQuan - Xác nhận tài khoản của bạn!!!');
                $email->to($client->email,$client->name);
            });

            return redirect()->route('client-login');
        }

        return redirect()->back();
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Request $request){
        $credentials =  $request->only('email', 'password');
        if (Auth::guard('client')->attempt($credentials)) {
            if (Auth::guard('client')->user()->token=='1'){
                Auth::guard('client')->logout();

                return redirect()->route('client.login')->with('msg','Please <a href="https://gmail.com">verify</a> your account');
            }
            elseif (Auth::guard('client')->user()->token==''){

                return redirect('/home');
            }
            else{
                Auth::guard('client')->logout();

                return redirect()->route('client-login')->with('msg','Something went wrong');
            }
        }
        else{

            return view('home.client.login')->with('msg','Wrong username or password!!!');
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::guard('client')->logout();

        return redirect('/');
    }

    /**
     * @param Client $client
     * @param $token
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Client $client,$token){
        if ($client->rememberToken === $token){
            $client->update(['emailVerify'=>1,'rememberToken'=>null]);

            return redirect()->route('home.client.login')->with('msg','Verify Success');
        }else{

            return redirect()->route('home.client.login')->with('msg','Can not verify your email!');
        }
    }
}
