<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
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

       $validateData = $request->validate([

            'name' => 'required',
            'contact' => 'required',
            'email' => 'email|required|unique:admins',
            'password' => 'required|confirmed',
 
        ]);
   
       $validateData['password'] = bcrypt($request->password);

       $user = Admin::create($validateData);

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

        dd(auth()->user());

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

}
