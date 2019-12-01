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
            Album
            <small>Update Album</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/album')}}">Album</a></li>
            <li class="active">Update Album</li>
        </ol>
    </section>


    <section class="content">
        @include('dashboard.layouts.messages')
        <form role="form" action="{{route('album.update', $album->id)}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('patch')
            <div class="row">
                <!-- English Side -->
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Update Album Info</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">

                                <div class="col-lg-12">
                                    <label for="exampleInputEmail1">Album Name</label>
                                    <input type="text" class="form-control" name="title_en" id="exampleInputEmail1" placeholder="Enter Client Name" value="{{$album->album_en->title}}">
                                    <p class="help-block">Enter Name of Album</p>
                                </div>

                                <div class="col-lg-12">
                                    <label for="exampleInputEmail1"> Album Type</label>
                                    <select name="type" id="admin_type" class="form-control">
                                        <option value="0">Choose Album Type</option>
                                        <option value="1" {{$album->type == 1 ? 'selected' : ''}}>Images</option>
                                        <option value="2" {{$album->type == 0 ? 'selected' : ''}}>Videos</option>
                                    </select>
                                    <p class="help-block"> Choose type of album </p>
                                </div>

                                <div class="col-lg-12">
                                    <label for="exampleInputEmail1"> Image</label>
                                    <input type="file" class="form-control" name="image_id" id="exampleInputEmail1" placeholder="Enter button text">
                                    <p class="help-block"> Upload Album Thumb Logo </p>
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
                <div class="col-md-6 arab_dir">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">أضف بيانات الألبوم</h3>
                        </div>
                        <!-- .box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">

                                <div class="col-lg-12">
                                    <label for="exampleInputEmail1">اسم الألبوم</label>
                                    <input type="text" class="form-control" name="title_ar" id="exampleInputEmail1" placeholder="ادخل اسم العميل" value="{{$album->album_ar->title}}">
                                    <p class="help-block">أدخل اسم الألبوم</p>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

@endsection
