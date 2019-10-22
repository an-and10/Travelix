<?php

namespace App\Http\Controllers\Api;

use App\Models\Package;
use App\Models\PackageImage;
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
       
        $image_url = null;

        $data = Package::create([
            'package_name' => $request->package_name,
            'package_location' => $request->package_location,
            'package_price' => $request->package_price,
            'package_type' => $request->package_type,
            'package_details' => $request->package_details,
            'package_features' => $request->package_features,
            'package_day' => $request->package_days,
            'package_nights' => $request->package_nights,
            'package_header_image' => $image_url,
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
            'package_features' => $request->features,
            'package_day' => $request->days,
            'package_nights' => $request->nights,
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


    public function addHeaderImage(Request $request,$id)
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

        $data = Package::where('id',$id)->update([

            'package_header_image' => $image_url,
            
        ]);

        if ($request->file('package_header_image') != null) {
            $success = $Image->move($upload_path, $ImageSaveAsName);
        }

        return response()->json(
            [
                'success' => true,

            ], 200);
    }

    public function addMoreImage(Request $request,$id)
    {
        $count = 0;
        //************** image-1  */
        if ($request->file('image_1') != null) {
            $Image1 = $request->file('image_1');
            $ImageSaveAsName1 = time().$count++."-packageImage.".
                $Image1->getClientOriginalExtension();

            $upload_path1 = 'mainpackages/';
            $image_url1 =  $ImageSaveAsName1;
        } else {
            $image_url1 = null;
        }

        //************** image-2  */

        if ($request->file('image_2') != null) {
            $Image2 = $request->file('image_2');
            $ImageSaveAsName2 = time() .$count++."-packageImage.".
                $Image2->getClientOriginalExtension();

            $upload_path2 = 'mainpackages/';
            $image_url2 =  $ImageSaveAsName2;
        } else {
            $image_url2 = null;
        }

        //************** image-3  */

        if ($request->file('image_3') != null) {
            $Image3 = $request->file('image_3');
            $ImageSaveAsName3 = time().$count++ ."-packageImage." .
                $Image3->getClientOriginalExtension();

            $upload_path3 = 'mainpackages/';
            $image_url3 =  $ImageSaveAsName3;
        } else {
            $image_url3 = null;
        }

        //************** image-4  */

        if ($request->file('image_4') != null) {
            $Image4 = $request->file('image_4');
            $ImageSaveAsName4 = time().$count++ ."-packageImage." .
                $Image4->getClientOriginalExtension();

            $upload_path4 = 'mainpackages/';
            $image_url4 =  $ImageSaveAsName4;
        } else {
            $image_url4 = null;
        }

        //************** image-5  */

        if ($request->file('image_5') != null) {
            $Image5 = $request->file('image_5');
            $ImageSaveAsName5 = time().$count++ ."-packageImage." .
                $Image5->getClientOriginalExtension();

            $upload_path5 = 'mainpackages/';
            $image_url5 =  $ImageSaveAsName5;
        } else {
            $image_url5 = null;
        }
       

       
        //*************** add images */

        $data = PackageImage::create([

            'package_id' => $id,
            'image_1' => $image_url1,
            'image_2' => $image_url2,
            'image_3' => $image_url3,
            'image_4' => $image_url4,
            'image_5' => $image_url5,
            
        ]);

        //************ upade in public folder */

        if ($request->file('image_1') != null) {
            $success = $Image1->move($upload_path1, $ImageSaveAsName1);
        }

        if ($request->file('image_2') != null) {
            $success = $Image2->move($upload_path2, $ImageSaveAsName2);
        }

        if ($request->file('image_3') != null) {
            $success = $Image3->move($upload_path3, $ImageSaveAsName3);
        }

        if ($request->file('image_4') != null) {
            $success = $Image4->move($upload_path4, $ImageSaveAsName4);
        }

        if ($request->file('image_5') != null) {
            $success = $Image5->move($upload_path5, $ImageSaveAsName5);
        }


        return response()->json(
            [
                'success' => true,

            ], 200);
    }

    public function showImage($id)
    {
        return PackageImage::where('package_id',$id)->get();
    }

    
}

