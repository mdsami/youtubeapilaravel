<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos=video::all();
        return view('home',compact('videos'));
    }
    public function saveVideo(Request $request)
    {
        $url= $request->url;
        
        if(strlen($url) > 11)
        {
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
            {
                $url= $match[1];
            }
        }

        $video=new Video;
        $video->video_id=$url;
        $video->save();

        return back();
    }
}
