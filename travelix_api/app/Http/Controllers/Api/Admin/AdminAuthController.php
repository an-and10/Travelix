<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class AdminAuthController extends Controller
{
    use HasApiTokens;

    public function register(Request $request)
    {
        if ($request->file('profile_img') != null) {
            //dd('enter');
            $Image = $request->file('profile_img');
            $ImageSaveAsName = time() . "-AdminProfileImage." .
                $Image->getClientOriginalExtension();

            $upload_path = 'AdminProfileImage/';
            $image_url =  $ImageSaveAsName;
            $Image->move($upload_path, $ImageSaveAsName);
        } else {
            $image_url = 'default-profile.png';
        }
           

        $request->profile_img = $image_url;
       $validateData = $request->validate([

            'firstname' => 'required',
            'lastname' => 'required',
            'contact' => 'required',
            'email' => 'email|required|unique:admins',
            'password' => 'required|confirmed',
            'DOB' => 'required',
         

 
        ]);

       $validateData['profile_img'] = $image_url;
            

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

        if(!auth('admin')->attempt($loginData))
        {
           return response()->json(['message' => 'Invalid credentials']);
        }

         $accessToken = auth('admin')->user()->createToken('authToken')->accessToken;

         return response()->json([
            'success' => true,
            'user' => auth('admin')->user(),
            'meta' => [
                'token' => $accessToken,
            ]
         ]);

    }

    public function mepoint()
    {
        return response()->json([
            'data' =>Auth::guard('admin-api')->user(), 
           
        ]);
     
    }

    public function out()
    {
       
            auth('admin-api')->user()->token()->revoke();

            return response()->json([
                'success' => true,
            ]);
       
     
        
    }

    public function index()
    {
        return Admin::orderBy('created_at', 'desc')->get();
    }

   

}
