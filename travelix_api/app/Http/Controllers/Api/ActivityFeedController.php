<?php

namespace App\Http\Controllers\Api;

use App\Models\ActivityFeed;
use App\Models\Notification;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ActivityFeedController extends Controller
{
    public function index()
    {
        return ActivityFeed::orderBy('id','desc')->get();
    }

    public function show_notification()
    {
        return Notification::orderBy('id', 'desc')->get();
    }
    public function delete_notification()
    {
        DB::table('notifications')->delete();
    }
}
