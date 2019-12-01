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
            Services
            <small>Edit Service</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/service')}}">Service</a></li>
            <li class="active">Edit Service</li>
        </ol>
    </section>


    <section class="content">
        @include('dashboard.layouts.messages')
        <form role="form" action="{{route('service.update', $service->id)}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('patch')
            <div class="row">
                <!-- English Side -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Service Info</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">

                                @if($service->parent_service_id)
                                    <div class="col-lg-6">
                                        <label for="exampleInputEmail1"> Main Service</label>
                                        <input type="text" class="form-control" disabled="disabled" name="main_service" id="exampleInputEmail1" placeholder="Enter Service Title" value="{{$service->parentService->service_en->title}}">
                                        <p class="help-block">This is The Parent service of the one you will add</p>
                                    </div>
                                @endif

                                <div class="col-lg-6">
                                    <label for="exampleInputEmail1"> Title</label>
                                    <input type="text" class="form-control" name="title_en" id="exampleInputEmail1" placeholder="Enter Service Title" value="{{$service->service_en->title}}">
                                    <p class="help-block">Enter title of service</p>
                                </div>

                                    <div class="col-lg-6">
                                        <label for="exampleInputEmail1">Icon Code</label>
                                        <input type="text" class="form-control" name="icon_code" id="exampleInputEmail1" placeholder="Enter Service IconCode" value="{{$service->icon_code}}">
                                        <p class="help-block">Enter Icon Code </p>
                                    </div>

                                <div class="col-lg-6">
                                    <label for="exampleInputEmail1"> Service Description</label>
                                    <textarea class="form-control" name="description_en" id="exampleInputEmail1" placeholder="Enter Service Description" rows="6">{{$service->service_en->description}}</textarea>
                                    <p class="help-block">Enter Description of Service</p>
                                </div>

                                <div class="col-lg-6">
                                    <label for="exampleInputEmail1"> Image</label>
                                    <input type="file" class="form-control" name="image_id" id="exampleInputEmail1" placeholder="Enter Service text">
                                    <p class="help-block"> Upload Service Image </p>
                                </div>

                                {{--<div class="col-lg-6">
                                    <label for="exampleInputEmail1"> Video Url</label>
                                    <input type="text" class="form-control" name="video_url" id="exampleInputEmail1" placeholder="Enter Service Title" value="{{$service->video_id ? $service->video->url : ''}}">
                                    <p class="help-block"> Enter Youtube Video Embed Url </p>
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

            </div>
        </form>
    </section>

@endsection
