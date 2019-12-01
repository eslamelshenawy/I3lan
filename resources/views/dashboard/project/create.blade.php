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
            Projects
            <small>Add Project</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/project')}}">Project</a></li>
            <li class="active">Add Project</li>
        </ol>
    </section>



    <section class="content">
        @include('dashboard.layouts.messages')
        <form role="form" action="{{route('project.store')}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('post')
            <input type="hidden" name="created_by">
            <div class="row">
                <!-- English Side -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        <h3 class="box-title">Add Project Info</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-lg-6">
                                <label for="exampleInputEmail1"> Project Name</label>
                                <input type="text" class="form-control" name="name_en" id="exampleInputEmail1" placeholder="Enter Project Name" value="{{old('name_en')}}">
                                <p class="help-block">Enter Project Name</p>
                            </div>

                            <div class="col-lg-6">
                                <label for="exampleInputEmail1">Client</label>
                                <input type="text" class="form-control" name="client" id="exampleInputEmail1" placeholder="Enter Product slug" value="{{old('client')}}">
                                <p class="help-block">Enter Client Name</p>
                            </div>

                            <div class="col-lg-6">
                                <label for="exampleInputEmail1">Main Image</label>
                                <input type="file" class="form-control" name="image_id" id="exampleInputEmail1" placeholder="Enter Product text">
                                <p class="help-block"> Upload Project Image </p>
                            </div>

                            <div class="col-lg-6">
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
                            </div>

                            <div class="col-lg-6">
                                <label for="exampleInputEmail1"> Project Images</label>
                                <input type="file" class="form-control" name="images[]" multiple id="exampleInputEmail1" placeholder="Enter Product text">
                                <p class="help-block"> Upload Project Images </p>
                            </div>

                            <div class="col-lg-6">
                                <label for="exampleInputEmail1"> Related Images Display</label>
                                <select name="display" id="admin_type" class="form-control">
                                    <option value="0">Choose Display</option>
                                    <option value="1">Grid</option>
                                    <option value="2">List</option>
                                </select>
                                <p class="help-block">Choose Related Images</p>
                            </div>



                            <div class="col-lg-6">
                                <label for="exampleInputEmail1"> Project Description</label>
                                <textarea  class="form-control" name="description_en" id="exampleInputEmail1" placeholder="Enter Project Description" rows="6">{{old('description_en')}}</textarea>
                                <p class="help-block">Enter Description of Project</p>
                            </div>

                            {{--<div class="col-lg-6">
                                <label for="exampleInputEmail1"> Video Url</label>
                                <input type="url" class="form-control" name="video_id" id="exampleInputEmail1" placeholder="Enter Video Url">
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
