<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
       $validateData = $request->validate([

            'name' => 'required',
            'username' => 'required',
            'contact' => 'required|min:10',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed',

        ]);
 
       $validateData['password'] = bcrypt($request->password);

       $user = User::create($validateData);

       $accessToken = $user->createToken('authToken')->accessToken;

       return response()->json([

            'user' => $user,
            'access_token' => $accessToken
       ]);


    }
    public function login(Request $request)
    {

        $loginData = $request->validate([

            'email' => 'email|required',
            'password' => 'required',

        ]);

        if(!auth()->attempt($loginData))
        {
            return response(['message' => 'Invalid credentials']);
        }

         $accessToken = auth()->user()->createToken('authToken')->accessToken;

         return response()->json([

            'user' => auth()->user(),
            'access_token' => $accessToken

         ]);

    }


}
