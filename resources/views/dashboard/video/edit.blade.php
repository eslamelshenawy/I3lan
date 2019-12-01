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
            Video
            <small>Add New Video</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/video')}}">Gallery</a></li>
            <li class="active">Add New Video</li>
        </ol>
    </section>


    <section class="content">
        @include('dashboard.layouts.messages')
        <form role="form" action="{{route('video.update', $video->id)}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('patch')
            <input type="hidden" name="created_by">
            <div class="row">
                <!-- English Side -->
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Video URL</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">

                                <div class="col-lg-12">
                                    <label for="exampleInputEmail1"> Video Url</label>
                                    <input type="url" class="form-control" name="url" multiple id="exampleInputEmail1" placeholder="Enter Video Url" value="{{$video->url}}">
                                    <p class="help-block"> Enter Embed url </p>
                                </div>

                                <div class="col-lg-12">
                                    <label for="exampleInputEmail1"> Album Name</label>
                                    <select name="album_id" id="admin_type" class="form-control">
                                        <option value="0">Choose Album Name</option>
                                        @if($albums)
                                            @foreach($albums as $album)
                                                <option value="{{$album->id}}" {{$album->id == $video->album_id ? 'selected' : ''}}>{{$album->album_en->title}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p class="help-block"> Choose album for this video</p>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="col-lg-12">
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
