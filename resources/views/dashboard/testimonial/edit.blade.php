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
            Testimonial
            <small>Add New Testimonial</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/testimonial')}}">Testimonial</a></li>
            <li class="active">Add Testimonial</li>
        </ol>
    </section>


    <section class="content">
        @include('dashboard.layouts.messages')
        <form role="form" action="{{route('testimonial.update', $testimonial->id)}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('patch')
            <div class="row">
                <!-- English Side -->
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Testimonial Info</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">

                                <div class="col-lg-12">
                                    <label for="exampleInputEmail1">Client Name</label>
                                    <input type="text" class="form-control" name="username_en" id="exampleInputEmail1" placeholder="Enter Client Name" value="{{$testimonial->testimonial_en->username}}">
                                    <p class="help-block">Enter Username of Testimonial</p>
                                </div>

                                <div class="col-lg-12">
                                    <label for="exampleInputEmail1">Text of Testimonial</label>
                                    <textarea type="text" class="form-control" name="text_en" id="editor1" placeholder="Enter Text of Testimonial" rows="6">{{$testimonial->testimonial_en->text}}</textarea>
                                    <p class="help-block">Text of Testimonial</p>
                                </div>

                                <div class="col-lg-12">
                                    <label for="exampleInputEmail1"> Image</label>
                                    <input type="file" class="form-control" name="image_id" id="exampleInputEmail1" placeholder="Enter button text">
                                    <p class="help-block"> Upload Testimonial </p>
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
                            <h3 class="box-title">أضف التوصيات</h3>
                        </div>
                        <!-- .box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <label for="exampleInputEmail1">اسم صاحب التوصية</label>
                                    <input type="text" class="form-control" name="username_ar" id="exampleInputEmail1" placeholder="ادخل اسم صاحب التوصية" value="{{$testimonial->testimonial_ar->username}}">
                                    <p class="help-block">ادخل اسم المستخدم صاحب التوصية</p>
                                </div>

                                <div class="col-lg-12">
                                    <label for="exampleInputEmail1">نص التوصية</label>
                                    <textarea type="text" class="form-control" name="text_ar" id="editor1" placeholder="ادخل نص التوصية" rows="6">{{$testimonial->testimonial_ar->text}}</textarea>
                                    <p class="help-block">ادخل نص التوصية</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

@endsection
