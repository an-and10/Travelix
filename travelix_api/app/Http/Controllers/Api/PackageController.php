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
        if ($request->file('package_header_image') != null) {
            $Image = $request->file('package_header_image');
            $ImageSaveAsName = time() ."-packageImage." .
                $Image->getClientOriginalExtension();

            $upload_path = 'mainpackages/';
            $image_url =  $ImageSaveAsName;
        } else {
            $image_url = null;
        }
           

        $data = Package::create([
            'package_name' => $request->package_name,
            'package_location' => $request->package_location,
            'package_price' => $request->package_price,
            'package_type' => $request->package_type,
            'package_details' => $request->package_details,
            'package_header_image' => $image_url,
        ]);
        if ($request->file('package_header_image') != null) {
            $success = $Image->move($upload_path, $ImageSaveAsName);
        }

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

