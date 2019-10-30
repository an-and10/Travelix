<?php

namespace App\Http\Controllers\Api;

use App\Models\Booking;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function add(Request $request)
    {
        $data = Booking::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'contact'=> $request->contact,
            'amount_paid' => $request->amount_paid,
            'amount_balance' => $request->amount_balance,
            'picked_facility' => $request->picked_facility,
            'address' => $request->address,
            'adult' => $request->adult,
            'children' => $request->children,
            'package_id' => $request->package_id, 
            'package_name' => $request->package_name
                       
        ]);

        Mail::to($request->email)->send(new WelcomeMail($data));

        return response()->json([

            'success' => true,
            'data' => $data,
        ]);


    }

    public function cancelBooking(Request $request, $id)
    {
        $data = Booking::where('id', $request->id)->update([
            'status' => 'Cancelled'
        ]);
        return response()->json([

            'success' => true,
            'data' => $data,
        ]);



    }
    public function getIndex()
    {
        return Booking::all();
        
    }
}
