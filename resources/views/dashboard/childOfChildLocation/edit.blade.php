@extends('dashboard.layouts.layouts')
@section('title', 'Dashboard')
{{--Drop Your Customized Style Codes Here--}}
@section('customizedStyle')
@endsection
{{--Drop Your Customized Scripts Codes Here--}}
@section('customizedScript')
    <script>
        //Initialize Select2 Elements
        $('.select2').select2()
    </script>
@endsection
{{-- Start of page Content --}}
@section('content')

    <section class="content-header">
        <h1>
            Location
            <small>Update Location</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/child-of-child-location')}}">Locations</a></li>
            <li class="active">Update Locations</li>
        </ol>
    </section>



    <section class="content">
        @include('dashboard.layouts.messages')
        <form role="form" action="{{route('child-of-child-location.update', $location->id)}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('patch')
            <input type="hidden" name="created_by">
            <div class="row">
                <!-- English Side -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Location Info</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <label for="exampleInputEmail1"> Location Name</label>
                                    <input type="text" class="form-control" name="location" id="exampleInputEmail1" placeholder="Enter Location Name" value="{{$location->childOfChildLocation_en->location}}">
                                    <p class="help-block">Enter Location Name</p>
                                </div>

                                <div class="col-lg-6">
                                    <label for="exampleInputEmail1"> Choose Zone</label>
                                    <select name="child_location_id" id="admin_type" class="form-control">
                                        <option value="0">Choose Zone</option>
                                        @if($childLocations)
                                            @foreach($childLocations as $childLocation)
                                                <option value="{{$childLocation->id}}" {{$childLocation->id == $location->child_location_id ? 'selected' : ''}}>{{$childLocation->childLocation_en->location}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p class="help-block"> Choose Zone for this Location</p>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </section>


@endsection
