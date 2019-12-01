@extends('dashboard.layouts.layouts')
@section('title', 'Dashboard')
{{--Drop Your Customized Style Codes Here--}}
@section('customizedStyle')
@endsection
{{--Drop Your Customized Scripts Codes Here--}}
@section('customizedScript')
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>
@endsection
{{-- Start of page Content --}}
@section('content')

    <section class="content-header">
        <h1>
            Slider
            <small>All Slides</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/slider')}}">Slider</a></li>
            <li class="active">All Slides</li>
        </ol>
    </section>



    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box box-primary" style="padding: 15px">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Slides Info</h3>
                        <a href="{{adminUrl('slider/create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Slide </a>
                    </div>
                @include('dashboard.layouts.messages')
                <!-- /.box-header -->
                    <!-- form start -->
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Created By</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Created By</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>

                        @foreach($slides as $slide)
                            <tr>
                                <td>{{$slide->id}}</td>
                                <td><img src="{{$slide->image_id ? asset($slide->image->path) : asset('dashboard/img/picture.png')}}" style="width: 50px" alt="slide image" > </td>
                                <td>{{$slide->slider_en->title}}</td>
                                <td>{{$slide->createdBy->name}}</td>
                                <td>{{$slide->created_at ? $slide->created_at->diffForHumans() : ''}}</td>
                                <td>{{$slide->updated_at ? $slide->updated_at->diffForHumans() : ''}}</td>
                                <td>
                                    <a href="{{route('slider.edit', $slide->id)}}" class style="font-size: 20px"><i class="fa fa-pencil-square-o"></i> </a>
                                    <button type="button" class data-toggle="modal" data-target="#delete{{$slide->id}}" style="font-size: 20px">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    @foreach($slides as $slide)
                            <div class="modal modal-danger fade" id="delete{{$slide->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Delete Slide</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are You Sure You Want To Delete Slide <strong>{{$slide->slider_en->title}}</strong></p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{route('slider.destroy', $slide->id)}}" method="post">
                                                @method('delete')
                                                @csrf
                                                <div class="d-flex flex-row">
                                                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal" style="margin-right: 5px">
                                                        cancel
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">
                                                        Delete
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                    @endforeach

                </div>
            </div>
        </div>
    </section>

@endsection
