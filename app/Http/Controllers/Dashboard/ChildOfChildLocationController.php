<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Child_of_child_location;
use App\Models\Child_location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChildOfChildLocationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Child_of_child_location::with('childOfChildLocation_en')->get();
        return view('dashboard.childOfChildLocation.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $childLocations = Child_location::with('childLocation_en')->get();
        //$parent_locations = Parent_location::with('parentLocation_en')->get();

        return view('dashboard.childOfChildLocation.create', compact('childLocations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'location'               => 'required',
        ], [], [
        ]);

        $location = new Child_of_child_location();
        $location->child_location_id =  \request('child_location_id');
        $location->save();

        $location->childOfChildLocation_en()->create(['location' => \request('location')]);
        return redirect(adminUrl('child-of-child-location'))->with('create', 'Area Created Successfully');
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
        $location = Child_of_child_location::with('childOfChildLocation_en')->find($id);
        $childLocations = Child_location::with('childLocation_en')->get();
        return view('dashboard.childOfChildLocation.edit', compact('location', 'childLocations'));
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
        $location = Child_of_child_location::with('childOfChildLocation_en')->find($id);

        $request->validate([
            'location'               => 'required',
        ], [], [
        ]);

        $location->child_location_id = \request('child_location_id');
        $location->save();

        $location->childOfChildLocation_en()->update(['location' => \request('location')]);

        return redirect(adminUrl('child-of-child-location'))->with('update', 'Area Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Child_of_child_location::with('childOfChildLocation_en')->find($id);

        try{
            $location->delete();
        }

        catch (\Exception $e)
        {
            Session::flash('exception', 'Error, Can\'t Delete Area Because There are related Zones');
            return redirect()->back();
        }

        return redirect(adminUrl('child-of-child-location'))->with('delete', 'Area Deleted Successfully');
    }
}
