<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        if ($request->file('profile_img') != null) {
            $Image = $request->file('profile_img');
            $ImageSaveAsName = time() . "-UserProfileImage." .
                $Image->getClientOriginalExtension();

            $upload_path = 'UserProfileImage/';
            $image_url =  $ImageSaveAsName;
        } else {
            $image_url = 'null';
        }
           

        $request->profile_img = $image_url;
   // dd($request->profile_img);
       $validateData = $request->validate([

            'name' => 'required',
            'username' => 'required',
            'contact' => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed',
           // 'profile_img'  => 'required',


        ]);
       // dd($validateData);
   // $validateData = $request->all();
       // dd("hello");
 
       $validateData['password'] = bcrypt($request->password);
      // $validateData['profile_img'] = $image_url;

       $user = User::create($validateData);

       $accessToken = $user->createToken('authToken')->accessToken;

       return response()->json([
            'success' => true,
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
             'success' => true,
            'user' => auth()->user(),
            'meta' => [
                'token' => $accessToken,
            ]
         ]);

    }

    public function mepoint()
    {
        return response()->json([
            'success' => true,
           
            'data' =>Auth::guard('api')->user(), 
           
        ]);
     
    }

    public function out()
    {
        Auth::logout();
        return response()->json([
            'success' => true,
        ]);
    }



}
