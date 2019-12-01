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
            Setting
            <small>Edit Setting</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('setting/edit')}}">Setting</a></li>
            <li class="active">Edit Setting</li>
        </ol>
    </section>


    <section class="content">
        @include('dashboard.layouts.messages')
        <form role="form" action="{{adminUrl('setting/update')}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('patch')
            <div class="row">
                <!-- English Side -->
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Update Setting Info</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">

                                <div class="col-lg-12 with-border">
                                    <label for="exampleInputEmail1">Website Name</label>
                                    <input type="text" class="form-control" name="website_name_en" id="exampleInputEmail1" placeholder="Enter Website Name" value="{{$info->setting_en->website_name}}">
                                    <p class="help-block"> Enter Name of website </p>
                                </div>

                                <div class="col-lg-12 with-border">
                                    <label for="exampleInputEmail1">Website Description</label>
                                    <textarea class="form-control" name="website_description_en" id="exampleInputEmail1" placeholder="Enter Website Description" rows="6">{{$info->setting_en->website_description}}</textarea>
                                    <p class="help-block"> Enter Description of website </p>
                                </div>

                                <div class="col-lg-12 with-border">
                                    <label for="status" class="set-block">Status</label>
                                    <div class="radio radio-info  radio-inline">
                                        <input type="radio" id="inlineRadio1" value="1" name="status" {{$info->status == 1 ? 'checked' : ''}}>
                                        <label for="inlineRadio1"> Publish </label>
                                    </div>
                                    <div class="radio radio-info  radio-inline">
                                        <input type="radio" id="inlineRadio2" value="0" name="status" {{$info->status == 0 ? 'checked' : ''}}>
                                        <label for="inlineRadio2"> Un Publish </label>
                                    </div>
                                    <p class="help-block">Select Website Status .</p>
                                </div>

                                <div class="col-lg-12 with-border">
                                    <label for="website-logo">Logo</label>
                                    <img src="{{$info->logo ? asset($info->image->path) : asset('dashboard/img/picture.png')}}" data-toggle="modal" data-target="#update-img" class="img-responsive change-logo">
                                    <p class="help-block">Current Logo</p>
                                </div>

                                <div class="col-lg-12">
                                    <label for="exampleInputEmail1"> Logo</label>
                                    <input type="file" class="form-control" name="logo" id="exampleInputEmail1" placeholder="Upload Website Logo">
                                    <p class="help-block"> Change Website Logo </p>
                                </div>

                                <div class="col-lg-12">
                                    <label for="exampleInputEmail1">Default Lang</label>
                                    <select name="default_lang" id="admin_type" class="form-control">
                                        <option value="0">Choose Default Lang</option>
                                        <option value="en" {{$info->default_lang == 'en' ? 'selected' : ''}}>English</option>
                                        <option value="ar"  {{$info->default_lang == 'ar' ? 'selected' : ''}}>Arabic</option>
                                    </select>
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
                            <h3 class="box-title">قم بتعديل اعدادات الموقع</h3>
                        </div>
                        <!-- .box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">

                                <div class="col-lg-12">
                                    <label for="exampleInputEmail1">اسم الموقع</label>
                                    <input type="text" class="form-control" name="website_name_ar" id="exampleInputEmail1" placeholder="ادخل اسم الموقع" value="{{$info->setting_ar->website_name}}">
                                </div>

                                <div class="col-lg-12 with-border">
                                    <label for="exampleInputEmail1">وصف الموقع</label>
                                    <textarea type="email" class="form-control" name="website_description_ar" id="exampleInputEmail1" placeholder="ادخل وصفا دقيقا للموقع" rows="6">{{$info->setting_ar->website_description}}</textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

@endsection
