<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Album;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $albumID = Input::get('album');
        if ($albumID)
        {
            $videos = Video::with('album')->where('album_id', $albumID)->get();
            return view('dashboard.video.campaign', compact('videos'));
        }
        else
        {
            $videos = Video::all();
            return view('dashboard.video.campaign', compact('videos'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $albums = Album::with('album_en')->where('type', 2)->get();
        return view('dashboard.video.create', compact('albums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        $request->validate([
            'url'               => 'bail|required|url|max:200',
            'type'              => 'bail|int|max:4',
        ], [], [

        ]);


        $video = new Video();
        $video->url = $input['url'];
        $video->album_id = $input['album_id'];
        $video->created_by = $input['created_by'];
        $video->save();

        Session::flash('create', 'Video  Has Been Created Successfully');
        return redirect(adminUrl('video'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::find($id);
        $albums = Album::with('album_en')->where('type', 1)->get();
        return view('dashboard.video.edit', compact('video', 'albums'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $video = Video::find($id);
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        $request->validate([
            'url'               => 'bail|required|url|max:200',
            'type'              => 'bail|int|max:4',
        ], [], [

        ]);

        $video->url = $input['url'];
        $video->album_id = $input['album_id'];
        $video->created_by = $input['created_by'];
        $video->save();

        Session::flash('create', 'Video  Has Been Updated Successfully');
        return redirect(adminUrl('video'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::find($id);

        $video->delete();


        Session::flash('delete', 'Video ' . $video->id . ' Has Been Deleted Successfully');
        return redirect(adminUrl('video'));
    }
}
