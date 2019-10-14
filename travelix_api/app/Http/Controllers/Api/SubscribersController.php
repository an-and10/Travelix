<?php

namespace App\Http\Controllers\Api;

use App\Models\Subscribers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscribersController extends Controller
{
    public function add(Request $request)
    {   
        
        $email = $request->email;
       if(Subscribers::where('email', $email)->exists()){
            return response()->json([
                'success' => false,
            ]);
       }else{
           Subscribers::create([
               'email'=> $email,
           ]);

            return response()->json([
                'success' => true,


            ]);

       } 
    }
    public function index()
    {

       return Subscribers:: all();
    }

    public function destroy($id)
    {
        Subscribers::where('id', $id)->delete();
        return response()->json([

            'success' => true,


        ]);
    }
}
