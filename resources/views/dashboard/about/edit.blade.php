@extends('dashboard.layouts.layouts')
@section('title', 'Dashboard')
{{--Drop Your Customized Style Codes Here--}}
@section('customizedStyle')
@endsection
{{--Drop Your Customized Scripts Codes Here--}}
@section('customizedScript')
    <script src="{{assetPath('dashboard/AdminLte/bower_components/ckeditor/ckeditor.js')}}"></script>
    <script>
        //Initialize Select2 Elements
        //$('.select2').select2()
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor1');
            CKEDITOR.replace('editor2');
            CKEDITOR.replace('editor3');
            CKEDITOR.replace('editor4');
            CKEDITOR.replace('editor5');
            CKEDITOR.replace('editor6');
            CKEDITOR.replace('editor7');
            CKEDITOR.replace('editor8');
            //bootstrap WYSIHTML5 - text editor
        });

    </script>
@endsection
{{-- Start of page Content --}}
@section('content')

    <section class="content-header">
        <h1>
            Clients
            <small>Edit Client</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/about/edit')}}">About</a></li>
            <li class="active">Edit About Website</li>
        </ol>
    </section>


    <section class="content">
        @include('dashboard.layouts.messages')
        <form role="form" action="{{adminUrl('about/update')}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('patch')
            <div class="row">
                <!-- English Side -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit About Info</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">

                                <div class="col-lg-6">
                                    <label for="exampleInputEmail1">About Company</label>
                                    <textarea type="text" class="form-control" id="editor1" name="description_en" placeholder="Enter Mission of Website" rows="5">{{$about->about_en->description}}</textarea>
                                    <p class="help-block">Edit Mission of website</p>
                                </div>

                                <div class="col-lg-6">
                                    <label for="exampleInputEmail1">Mission</label>
                                    <textarea type="text" class="form-control" name="mission_en" id="editor2" rows="6" placeholder="Enter Mission of Website">{{$about->about_en->mission}}</textarea>
                                    <p class="help-block">Edit Mission of website</p>
                                </div>

                                <div class="col-lg-6">
                                    <label for="exampleInputEmail1">Vision</label>
                                    <textarea type="text" class="form-control" name="vision_en" id="editor3" rows="6" placeholder="Enter Vision of Website" >{{$about->about_en->vision}}</textarea>
                                    <p class="help-block">Edit Vision of website</p>
                                </div>

                                <div class="col-lg-6">
                                    <label for="exampleInputEmail1">Values</label>
                                    <textarea type="text" class="form-control editor1" name="values_en" id="editor4" rows="6" placeholder="Enter Values of Website" >{{$about->about_en->value}}</textarea>
                                    <p class="help-block">Edit Values of website</p>
                                </div>

                                <div class="col-lg-6">
                                    <label for="exampleInputEmail1"> About Us Image</label>
                                    <input type="file" class="form-control" name="about_image_id" id="exampleInputEmail1" placeholder="Update Mession Image">
                                    <p class="help-block"> Update The Image in Mission Section</p>
                                </div>


                                <div class="col-lg-6">
                                    <label for="exampleInputEmail1"> Mission Image</label>
                                    <input type="file" class="form-control" name="mission_image_id" id="exampleInputEmail1" placeholder="Update Mession Image">
                                    <p class="help-block"> Update The Image in Mission Section</p>
                                </div>

                                <div class="col-lg-6">
                                    <label for="exampleInputEmail1"> Vision Image</label>
                                    <input type="file" class="form-control" name="vision_image_id"  id="exampleInputEmail1" placeholder="Update Vision Image">
                                    <p class="help-block"> Update The Image in Vision Section</p>
                                </div>

                                <div class="col-lg-6">
                                    <label for="exampleInputEmail1"> Values Image</label>
                                    <input type="file" class="form-control" name="values_image_id" id="exampleInputEmail1" placeholder="Update Values Image">
                                    <p class="help-block"> Update The Image in Values Section</p>
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

                <!-- Arabic Side -->
            </div>
        </form>
    </section>

@endsection
