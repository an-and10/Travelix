<?php

namespace App\Http\Controllers\Api;

use App\Models\Story;
use App\Models\AddLikes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class StoryController extends Controller
{

    public function index()
    {
        return Story::all();
    }

    public function getStoriesTop()
    {
        return Story::orderBy('id', 'desc')->take(3)->get();
    }
   public function addStories(Request $request)
   {
        if ($request->file('image_1') != null) {
            $Image = $request->file('image_1');
            $ImageSaveAsName = time() . "-StoriesImage." .
                $Image->getClientOriginalExtension();

            $upload_path = 'storiesImage/';
            $image_url =  $ImageSaveAsName;
        } else {
            $image_url = null;
        }
      $data =  Story::create([
           'user_id' => $request->user_id,
           'package_name' => $request->package_name,
           'experience' => $request->experience,
           'tour_date' => $request->tour_date,
           'image_1' => $image_url,
           'status' => 'Review',
            'likes' => 0,
            'author' => $request->author,
           
           
       ]);
        if ($request->file('image_1') != null) {
            $success = $Image->move($upload_path, $ImageSaveAsName);
        }
        return response()->json(
            [
                'success' => true,
                'message' => 'Your Stories is Added Successfully! Be Patient your exerience will be update soon',
                'data' => $data,
            ],
            200
        );





   }


   public function updateStatus(Request $request, $id)
   {
       Story:: where('id',$id)->update([
           'status' => $request->status,
       ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Your Stories is Updated Successfully! Be Patient your exerience will be update soon',
               
            ], 200
        );
   }

   public function deleteStories($id)
   {
      Story::where('id', $id)->delete();
        return response()->json(
            [
                'success' => true,
              

            ],
            200
        );


   }

   public function addLikes(Request $request)
   {
       
    $storiesid = $request->s_id;
    $userid = $request->u_id;
    if(AddLikes::where(['stories_id' => $storiesid,

            'user_id' => $userid])->exists())
                {
                    $delete = AddLikes::where([
                    'stories_id' => $storiesid,
                    'user_id' => $userid
                        ])->delete();
                         return response()->json(
                        [
                            'success' => false,
                            'message' => 'You Dislike the post',
                        ],
                        200
                     );
                }else
                        {
                            $data = AddLikes::create([
                                'stories_id' => $storiesid,
                                'user_id' => $userid,

                            ]);
                            return response()->json(
                                [
                                    'success' => true,
                                    'message' => 'You Like the post',
                                ],
                                200
                            );

                        }
                 }

    public function getAllLikes()
    {
        $user =  AddLikes::all();
        return response()->json(
                    [
                        'success' => true,
                        'data' => $user,
                    ],
                    200
            );


    }
    public function getlikes(Request $request, $s_id,$u_id)
    {
        
        if(AddLikes::where(['stories_id' => $s_id,

            'user_id' => $u_id])->exists())
                {
                   
                         return response()->json(
                        [
                            'success' => false,
                           
                        ],
                        200
                     );
                }else
                        {
                            return response()->json(
                                [
                                    'success' => true,
                                    
                                ],
                                200
                            );

                        }
    }
  


}
