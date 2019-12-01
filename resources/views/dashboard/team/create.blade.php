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
            Team
            <small>Add Member</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/team')}}">Team</a></li>
            <li class="active">Add Member</li>
        </ol>
    </section>


    <section class="content">
        @include('dashboard.layouts.messages')
        <form role="form" action="{{route('team.store')}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('post')
            <input type="hidden" name="created_by">
            <div class="row">
                <!-- English Side -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        <h3 class="box-title">Add Member Info</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div class="form-group">

                            <div class="col-lg-6">
                                <label for="exampleInputEmail1"> Name</label>
                                <input type="text" class="form-control" name="name_en" id="exampleInputEmail1" placeholder="Enter Member Title" value="{{old('name_en')}}">
                                <p class="help-block">Enter Name of Member</p>
                            </div>

                            <div class="col-lg-6">
                                <label for="exampleInputEmail1">Job Title</label>
                                <input type="text" class="form-control" name="title_en" id="exampleInputEmail1" placeholder="Enter Member Title" value="{{old('title_en')}}">
                                <p class="help-block">Enter Job Title</p>
                            </div>

                            {{--<div class="col-lg-6">
                                <label for="exampleInputEmail1">Service Slug</label>
                                <input type="text" class="form-control" name="slug_en" id="exampleInputEmail1" placeholder="Enter Service slug" value="{{old('slug_en')}}">
                                <p class="help-block">Enter Title of Service</p>
                            </div>--}}

                            <div class="col-lg-6">
                                <label for="exampleInputEmail1"> Bio Description</label>
                                <textarea  class="form-control" name="description_en" id="exampleInputEmail1" placeholder="Enter Member Bio" rows="6">{{old('description_en')}}</textarea>
                                <p class="help-block">Enter Member Bio</p>
                            </div>

                            <div class="col-lg-6">
                                <label for="exampleInputEmail1"> Image</label>
                                <input type="file" class="form-control" name="image_id" id="exampleInputEmail1" placeholder="Enter Member text">
                                <p class="help-block"> Upload Member Image </p>
                            </div>

                            {{--<div class="col-lg-6">
                                <label for="exampleInputEmail1"> Related Service Name</label>
                                <select name="service_id" id="admin_type" class="form-control">
                                    <option value="0">Choose Service Name</option>
                                    @if($services)
                                        @foreach($services as $service)
                                            <option value="{{$service->id}}">{{$service->service_en->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <p class="help-block"> Choose Service for this Member</p>
                            </div>--}}

                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Arabic Side -->
            </div>
        </form>
    </section>


@endsection
