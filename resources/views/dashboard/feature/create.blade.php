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
            <small>Add Feature</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/feature')}}">Feature</a></li>
            <li class="active">Add Feature</li>
        </ol>
    </section>


    <section class="content">
        @include('dashboard.layouts.messages')
        <form role="form" action="{{route('feature.store')}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('post')
            <input type="hidden" name="created_by">
            <div class="row">
                <!-- English Side -->
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        <h3 class="box-title">Add Feature Info</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <label for="exampleInputEmail1"> Title</label>
                                <input type="text" class="form-control" name="title_en" id="exampleInputEmail1" placeholder="Enter Feature Title" value="{{old('title_en')}}">
                                <p class="help-block">Enter title of feature</p>
                            </div>

                            <div class="col-lg-12">
                                <label for="exampleInputEmail1">Feature Slug</label>
                                <input type="text" class="form-control" name="slug_en" id="exampleInputEmail1" placeholder="Enter Feature slug" value="{{old('slug_en')}}">
                                <p class="help-block">Enter Title of Feature</p>
                            </div>

                            <div class="col-lg-12">
                                <label for="exampleInputEmail1"> Feature Description</label>
                                <textarea  class="form-control" name="description_en" id="exampleInputEmail1" placeholder="Enter Feature Description" rows="6">{{old('description_en')}}</textarea>
                                <p class="help-block">Enter Description of Feature</p>
                            </div>

                            {{--<div class="col-lg-12">
                                <label for="exampleInputEmail1"> Image</label>
                                <input type="file" class="form-control" name="image_id" id="exampleInputEmail1" placeholder="Enter Feature text">
                                <p class="help-block"> Upload Feature Image </p>
                            </div>

                            <div class="col-lg-12">
                                <label for="exampleInputEmail1"> Video Url</label>
                                <input type="url" class="form-control" name="video_id" id="exampleInputEmail1" placeholder="Enter Video Url">
                                <p class="help-block"> Enter Youtube Video Embed Url </p>
                            </div>--}}

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
                            <h3 class="box-title">أضف بيانات الصورة</h3>
                        </div>
                        <!-- .box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">

                                <div class="col-lg-12">
                                    <label for="exampleInputEmail1"> عنوان الميزة</label>
                                    <input type="text" class="form-control" name="title_ar" id="exampleInputEmail1" placeholder="ادخل عنوان الميزة" value="{{old('title_ar')}}">
                                    <p class="help-block">أضف عنوان الميزة</p>
                                </div>

                                <div class="col-lg-12">
                                    <label for="exampleInputEmail1"> نبذة عن الميزة</label>
                                    <input type="text" class="form-control" name="slug_ar" id="exampleInputEmail1" placeholder="ادخل  نبذة عن الميزة" value="{{old('slug_ar')}}">
                                    <p class="help-block">ادخل  نبذة عن الميزة</p>
                                </div>

                                <div class="col-lg-12">
                                    <label for="exampleInputEmail1">وصف الميزة</label>
                                    <textarea class="form-control" name="description_ar" id="exampleInputEmail1" placeholder="ادخل  وصف الميزة" rows="6" >{{old('description_ar')}}</textarea>
                                    <p class="help-block">ادخل وصفا دقيقا عن الميزة</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>


@endsection
