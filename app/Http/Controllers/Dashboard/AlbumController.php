<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Album;
use App\Models\Client;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albumType = Input::get('type');
        if ($albumType == 'images')
        {
            $albums = Album::with('album_en', 'createdBy', 'image')->where('type', 1)->get();
            return view('dashboard.album.campaign', compact('albums'));
        }
        elseif ($albumType == 'videos')
        {
            $albums = Album::with('album_en', 'createdBy', 'image')->where('type', 2)->get();
            return view('dashboard.album.campaign', compact('albums'));
        }
        else
        {
            $albums = Album::with('album_en', 'createdBy', 'image')->get();
            return view('dashboard.album.campaign', compact('albums'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.album.create');
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
            'title_en'           => 'bail|required|max:200',
            'title_ar'           => 'bail|max:200',
            'type'               => 'bail|required|int',
            'image_id'           => 'bail|required|mimes:jpeg,jpg,png,gif',
        ], [], [
            'title_en'           => ' Name in English',
            'title_ar'           => ' Name in Arabic',
            'image_id'           => ' Image',
            'type'               => ' Album Type',
        ]);

        //Upload Slide Image
        if ($uploadedFile = $request->file('image_id'))
        {
            $fileName = time() . $uploadedFile->getClientOriginalName();
            $uploadedFile->move('dashboardImages/album', $fileName);
            $filePath = 'dashboardImages/album/'.$fileName;
            $image = Image::create(['name' => $fileName, 'path' => $filePath]);
            $input['image_id'] = $image->id;
        }

        $album = new Album();
        $album->image_id = $input['image_id'];
        $album->created_by = $input['created_by'];
        $album->type = $input['type'];
        $album->save();

        $album->album_ar()->create(['album_id' => $album->id, 'title' => $input['title_ar'],]);
        $album->album_en()->create(['album_id' => $album->id, 'title' => $input['title_en'],]);

        Session::flash('create', 'Album  Has Been Created Successfully');
        return redirect(adminUrl('album'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function uploadPage($id)
    {
        $album = Album::with('album_en')->find($id);
        return view('dashboard.album.upload', compact('album'));
    }



    public function upload(Request $request, $id)
    {
        $input = $request->all();
        $this->validate($request,[
            'image_id.*'       => 'mimes:jpeg,jpg,png,gif',
            'image_id'         => 'required',
        ], [], [
            'image_id.*'         => 'Images',
        ]);

        try
        {
            if ($request->hasFile('image_id'))
            {
                foreach ($request->image_id as $image) {

                    $name =  time() . $image->getClientOriginalName();

                    $image->move('dashboardImages/album', $name);

                    $path = 'dashboardImages/album/' .$name;

                    $image = Image::create(['name' => $name, 'path' => $path, 'album_id' => $id]);

                    $input['image_id'] = $image->id;

                    //Gallery::create($input);
                    Session::flash('create', 'Images Has Been Uploaded Successfully');

                }
            }
        }
        catch (\Exception $e)
        {
            Session::flash('exception', 'Can\'t Add Images To Album');
            return redirect(adminUrl('gallery'));
        }

        return redirect(adminUrl('album/'.$id));
    }



    public function show($id)
    {
        $albumImages = Image::with('album')->where('album_id', $id)->get();
        return view('dashboard.album.show', compact('albumImages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album = Album::with('createdBy', 'image', 'album_en')->find($id);
        return view('dashboard.album.edit', compact('album'));
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
        $album = Album::with('createdBy', 'image', 'album_en')->find($id);
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        $request->validate([
            'title_en'           => 'bail|required|max:200',
            'title_ar'           => 'bail|max:200',
            'type'               => 'bail|required|int',
            'image_id'           => 'bail|mimes:jpeg,jpg,png,gif',
        ], [], [
            'title_en'           => ' Name in English',
            'title_ar'           => ' Name in Arabic',
            'image_id'           => ' Image',
            'type'               => ' Album Type',
        ]);

        //Upload Slide Image
        if ($uploadedFile = $request->file('image_id'))
        {
            $fileName = time() . $uploadedFile->getClientOriginalName();
            $uploadedFile->move('dashboardImages/album', $fileName);
            $filePath = 'dashboardImages/album/'.$fileName;
            $image = Image::create(['name' => $fileName, 'path' => $filePath]);
            $input['image_id'] = $image->id;
            $album->image_id = $input['image_id'];
        }


        $album->created_by = $input['created_by'];
        $album->type = $input['type'];
        $album->save();

        $album->album_ar()->update(['album_id' => $album->id, 'title' => $input['title_ar'],]);
        $album->album_en()->update(['album_id' => $album->id, 'title' => $input['title_en'],]);

        Session::flash('update', 'Album  Has Been Updated Successfully');
        return redirect(adminUrl('album'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = Album::find($id);

        $album->delete();

        try
        {
            if ($album->image_id)
            {
                unlink(public_path() . '/' . $album->image->path);
                DB::table('image')->where('id', $album->image_id)->delete();
            }
        }
        catch (\Exception $e)
        {
            Session::flash('exception', 'Error, Can\'t Delete Album Because The Slide is related to another table');
            return redirect()->back();
        }

        Session::flash('delete', 'Album ' . $album->id . ' Has Been Deleted Successfully');
        return redirect(adminUrl('album'));
    }
}
