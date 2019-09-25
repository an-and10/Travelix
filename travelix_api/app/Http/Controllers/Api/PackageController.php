<?php

namespace App\Http\Controllers\Api;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
    public function index()
    {
        return Package::all();
    }

    public function show($id)
    {
       return Package::where('id',$id)->first();
    }

    public function add(Request $request)
    {
        $data = Package::create([

            'package_name' => $request->name,
            'package_location' => $request->location,
            'package_price' => $request->price,
            'package_type' => $request->type,
            'package_details' => $request->details,
        ]);

        return response()->json([

            'success' => true,
            'data' => $data,
        ]);
    }

    public function Update(Request $request,$id)
    {
        $data = Package::where('id',$id)->update([

            'package_name' => $request->name,
            'package_location' => $request->location,
            'package_price' => $request->price,
            'package_type' => $request->type,
            'package_details' => $request->details,
        ]);

        return response()->json([

            'success' => true,
        ]);
        
    }

    public function destroy($id)
    {
        return Package::where('id',$id)->delete();
    }

    public function showFilterDestination(Request $request)
    {
        return Package::where('package_location',$request->location)->get();
    }

    
}

