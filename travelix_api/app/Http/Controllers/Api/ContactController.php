<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use App\Mail\WelcomeMail;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function add(Request $request)
    {
       $token =  rand(1000, 9999);
        $data = Contact::create([

            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'token' => $token,
           
            //'package_details' => $request->details,
        ]);

        $enquiry_data =  $request->name . " has request a enquiry on " . $request->subject;

        Notification::create([
            'title' => "Enquiry",
            'action' => $enquiry_data,
        ]);

         Mail::to($request->email)->send(new WelcomeMail($data));

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

    public function send_mail()
    {
        return view('welcome');
    }






   
}
