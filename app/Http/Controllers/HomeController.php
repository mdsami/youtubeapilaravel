<?php

namespace App\Http\Controllers;

use Alaouy\Youtube\Facades\Youtube;
use App\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allVideo=video::all();
        $videoIds=$allVideo->pluck('video_id')->all();
        $videos=Youtube::getVideoInfo($videoIds);
        return view('welcome',compact('videos'));
    }
}
