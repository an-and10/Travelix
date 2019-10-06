<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{

    public function index()
    {
        return Blog::get();
    }
    public function show(Request $request)
    {
        $id = Destination::where('name',$request->city)->first();
        $data = Blog::where('destination_id',$id['id'])->get();

        $image = $id['destination_image'];

        return response()->json([

            'data' => $data,
            'image' => $image,

        ], 200);
        }

    public function getCity()
    {
        return Destination::get();
    }

    public function addCity(Request $request)
    {
        if ($request->file('destination_image') != null) {
            $Image = $request->file('destination_image');
            $ImageSaveAsName = time() ."-blogImage." .
                $Image->getClientOriginalExtension();

            $upload_path = 'mainblogs/';
            $image_url =  $ImageSaveAsName;
        } else {
            $image_url = null;
        }

        $data = Destination::create([

            'name' => $request->name,
            'destination_image' => $image_url,

        ]);


        if ($request->file('destination_image') != null) {
            $success = $Image->move($upload_path, $ImageSaveAsName);
        }

        return response()->json([

            'success' => true,
            'data' => $data,

        ], 200);
    }

    public function addPlace(Request $request)
    {
        $id = Destination::where('name',$request->city)->first();   

        if ($request->file('image') != null) {
            $Image = $request->file('image');
            $ImageSaveAsName = time() ."-blogImage." .
                $Image->getClientOriginalExtension();

            $upload_path = 'mainblogs/';
            $image_url =  $ImageSaveAsName;
        } else {
            $image_url = null;
        }


        $data = Blog::create([

            'city' => $request->city,
            'destination_id' => $id['id'],
            'place' => $request->place,
            'description' => $request->description,
            'blog_image' => $image_url,
        ]);

        if ($request->file('image') != null) {
            $success = $Image->move($upload_path, $ImageSaveAsName);
        }

        return response()->json([

            'success' => true,
            'data' => $data,

        ], 200);
    }
}
