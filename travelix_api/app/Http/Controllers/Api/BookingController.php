<?php

namespace App\Http\Controllers\Api;

use App\Models\Booking;
use App\Mail\BookingMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function add(Request $request)
    {
        $request->amount_paid = "4523";
        $request->amount_balance = "300";
        $dataBooking = Booking::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'contact'=> $request->contact,
            'amount_paid' =>"345",
            'amount_balance' =>"123",
            'picked_facility' => $request->picked_facility,
            'address' => $request->address,
            'adult' => $request->adult,
            'children' => $request->children,
            'package_id' => $request->package_id,
            'package_name' => $request->package_name

        ]);

        Mail::to($request->email)->send(new BookingMail($dataBooking));

        return response()->json([

            'success' => true,
            'data' => $dataBooking,
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
