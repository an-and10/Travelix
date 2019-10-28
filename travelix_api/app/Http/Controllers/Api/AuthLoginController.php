<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AuthLoginController extends Controller
{
    public function loginRoute(Request $request)
    {

        $user['password'] = $request->password;


        // return $request->authentication;
        if ($request->authentication == 'customer') {
            $user['email'] = $request->email;

            return redirect()->action('Api\UserAuthController@login', $user);
  
        }

        if ($request->authentication == 'admin') {
            $user['email'] = $request->email;

            return redirect()->action('Api\Admin\AdminAuthController@login', $user);
         
        }
    }
    public function check_user(Request $request)
    {
        if (Auth::guard('api')->check()) {

            return redirect()->action('Api\UserAuthController@mepoint');
        }

        if (Auth::guard('admin-api')->check()) {

            return redirect()->action('Api\Admin\AdminAuthController@mepoint');
        }


    }
    public function check_out(Request $request)
    {
        if (Auth::guard('api')->check()) {

            return redirect()->action('Api\UserAuthController@out');
        }

        if (Auth::guard('admin-api')->check()) {

            return redirect()->action('Api\Admin\AdminAuthController@out');
        }
    }


}
