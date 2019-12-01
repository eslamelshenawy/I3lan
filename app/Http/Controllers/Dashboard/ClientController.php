<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Client;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::with('client_en', 'createdBy', 'image')->get();
        return view('dashboard.client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.client.create');
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
            'name_en'           => 'bail|required|max:200',
            'image_id'          => 'bail|required|mimes:jpeg,jpg,png,gif',
        ], [], [
            'name_en'           => ' Name in English',
            'image_id'          => ' Image',
        ]);

        //Upload Slide Image
        if ($uploadedFile = $request->file('image_id'))
        {
            $fileName = time() . $uploadedFile->getClientOriginalName();
            $uploadedFile->move('dashboardImages/client', $fileName);
            $filePath = 'dashboardImages/client/'.$fileName;
            $image = Image::create(['name' => $fileName, 'path' => $filePath]);
            $input['image_id'] = $image->id;
        }

        $client = new Client();
        $client->image_id = $input['image_id'];
        $client->created_by = $input['created_by'];
        $client->save();

        $client->client_en()->create(['client_id' => $client->id, 'name' => $input['name_en'],]);

        Session::flash('create', 'Client  Has Been Created Successfully');
        return redirect(adminUrl('client'));

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
        $client = Client::with('createdBy', 'image', 'client_en')->find($id);
        return view('dashboard.client.edit', compact('client'));
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
        $client = Client::with('createdBy', 'image', 'client_en')->find($id);
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        $request->validate([
            'name_en'           => 'bail|required|max:200',
            'image_id'          => 'mimes:jpeg,jpg,png,gif',
        ], [], [
            'name_en'           => ' Name in English',
            'image_id'          => ' Image',
        ]);

        //Upload Slide Image
        if ($uploadedFile = $request->file('image_id'))
        {
            $fileName = time() . $uploadedFile->getClientOriginalName();
            $uploadedFile->move('dashboardImages/client', $fileName);
            $filePath = 'dashboardImages/client/'.$fileName;
            $image = Image::create(['name' => $fileName, 'path' => $filePath]);
            $input['image_id'] = $image->id;
            $client->image_id = $input['image_id'];
        }

        $client->created_by = $input['created_by'];
        $client->save();

        $client->client_en()->update(['client_id' => $client->id, 'name' => $input['name_en'],]);

        Session::flash('update', 'Client  Has Been Updated Successfully');
        return redirect(adminUrl('client'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);

        $client->delete();

        try
        {
            if ($client->image_id)
            {
                unlink(public_path() . '/' . $client->image->path);
                DB::table('image')->where('id', $client->image_id)->delete();
            }
        }
        catch (\Exception $e)
        {
            Session::flash('exception', 'Error, Can\'t Delete Client Because The Slide is related to another table');
            return redirect()->back();
        }

        Session::flash('delete', 'Client ' . $client->id . ' Has Been Deleted Successfully');
        return redirect(adminUrl('client'));
    }
}
