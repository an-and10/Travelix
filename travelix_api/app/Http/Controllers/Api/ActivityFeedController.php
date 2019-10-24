<?php

namespace App\Http\Controllers\Api;

use App\Models\ActivityFeed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityFeedController extends Controller
{
    public function index()
    {
        return ActivityFeed::orderBy('id','desc')->get();
    }
}
