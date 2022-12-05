<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;

class AuthController extends Controller
{

    public function index(){

        return view('auth::login');
    }

    public function credentialValidate(Request $request){

        if($request->ajax()){

            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                $message = 'Wrong email or password.';
                return $message;
            }
        }
    }

    public function login(Request $request){

        $credentials = request(['email', 'password']);

        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email' => 'exists:users,email'
            ],
            'password' => [
                'required',
            ]
        ]);
        if ($validator->fails()) {
            return redirect()->route('loginView')
                        ->withErrors($validator)
                        ->withInput();
        }
        /**
         * Validation pass
         */
        if(Auth::attempt($credentials)){
            return redirect('/blog');
        }
        return redirect()->route('loginView');
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth::logout();
        return redirect(RouteServiceProvider::HOME);
    }

}
