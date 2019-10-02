<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function add(Request $request)
    {
        $data = Contact::create([

            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
           
            //'package_details' => $request->details,
        ]);

        return response()->json([

            'success' => true,
            'data' => $data,
        ]);
    }

    public function index()
    {
        return Contact::all();
    }

    public function update(Request $request, $id)
    {
        Contact::where('id', $id)->update([

            'status' => $request->status,
         

        ]);

        return response()->json([

            'success' => true,


        ]);
    }
    public function destroy($id)
    {
        Contact::where('id', $id)->delete();
        return response()->json([

            'success' => true,


        ]);
    }






   
}
