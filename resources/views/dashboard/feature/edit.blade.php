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
            Features
            <small>Edit Feature</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/feature')}}">Feature</a></li>
            <li class="active">Edit Feature</li>
        </ol>
    </section>


    <section class="content">
        @include('dashboard.layouts.messages')
        <form role="form" action="{{route('feature.update', $feature->id)}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('patch')
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
                                    <input type="text" class="form-control" name="title_en" id="exampleInputEmail1" placeholder="Enter Feature Title" value="{{$feature->feature_en->title}}">
                                    <p class="help-block">Enter title of feature</p>
                                </div>

                                <div class="col-lg-12">
                                    <label for="exampleInputEmail1">Feature Slug</label>
                                    <input type="text" class="form-control" name="slug_en" id="exampleInputEmail1" placeholder="Enter Feature slug" value="{{$feature->feature_en->slug}}">
                                    <p class="help-block">Enter Title of Feature</p>
                                </div>

                                <div class="col-lg-12">
                                    <label for="exampleInputEmail1"> Feature Description</label>
                                    <textarea class="form-control" name="description_en" id="exampleInputEmail1" placeholder="Enter Feature Description" rows="6">{{$feature->feature_en->description}}</textarea>
                                    <p class="help-block">Enter Description of Feature</p>
                                </div>

                                {{--<div class="col-lg-12">
                                    <label for="exampleInputEmail1"> Image</label>
                                    <input type="file" class="form-control" name="image_id" id="exampleInputEmail1" placeholder="Enter Feature text">
                                    <p class="help-block"> Upload Feature Image </p>
                                </div>

                                <div class="col-lg-12">
                                    <label for="exampleInputEmail1"> Video Url</label>
                                    <input type="text" class="form-control" name="video_url" id="exampleInputEmail1" placeholder="Enter Feature Title" value="{{$feature->video_id ? $feature->video->url : ''}}">
                                    <p class="help-block"> Enter Youtube Video Embed Url </p>
                                </div>
--}}

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
                                    <label for="exampleInputEmail1"> عنوان المنتج</label>
                                    <input type="text" class="form-control" name="title_ar" id="exampleInputEmail1" placeholder="ادخل عنوان المنتج" value="{{$feature->feature_ar->title}}">
                                    <p class="help-block">أضف عنوان المنتج</p>
                                </div>

                                <div class="col-lg-12">
                                    <label for="exampleInputEmail1"> نبذة عن المنتج</label>
                                    <input type="text" class="form-control" name="slug_ar" id="exampleInputEmail1" placeholder="ادخل  نبذة عن المنتج" value="{{$feature->feature_ar->slug}}">
                                    <p class="help-block">ادخل  نبذة عن المنتج</p>
                                </div>

                                <div class="col-lg-12">
                                    <label for="exampleInputEmail1">وصف المنتج</label>
                                    <textarea class="form-control" name="description_ar" id="exampleInputEmail1" placeholder="ادخل  وصف المنتج" rows="6">{{$feature->feature_ar->description}}</textarea>
                                    <p class="help-block">ادخل وصفا دقيقا عن المنتج</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

@endsection
