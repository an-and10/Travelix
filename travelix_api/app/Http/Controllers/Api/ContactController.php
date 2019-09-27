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
}
