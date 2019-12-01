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
            Testimonial
            <small>All Testimonial</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/testimonial')}}">Testimonial</a></li>
            <li class="active">All Testimonial</li>
        </ol>
    </section>



    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box box-primary" style="padding: 15px">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Testimonial Info</h3>
                        <a href="{{adminUrl('testimonial/create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Testimonial </a>
                    </div>
                @include('dashboard.layouts.messages')
                <!-- /.box-header -->
                    <!-- form start -->
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Image</th>
                            <th>User Name</th>
                            <th>Testimonial</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Image</th>
                            <th>User Name</th>
                            <th>Testimonial</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @if($testimonials)
                            @foreach($testimonials as $testimonial)
                                <tr>
                                    <td>{{$testimonial->id}}</td>
                                    <td><img src="{{$testimonial->image_id ? assetPath($testimonial->image->path) : assetPath('dashboard/img/picture.png')}}}}"></td>
                                    <td>{{$testimonial->testimonial_en->username}}</td>
                                    <td>{{str_limit($testimonial->testimonial_en->text, 20, '...') }}</td>
                                    <td>{{$testimonial->created_at ? $testimonial->created_at->diffForHumans() : ''}}</td>
                                    <td>{{$testimonial->updated_at ? $testimonial->updated_at->diffForHumans() : ''}}</td>
                                    <td>
                                        <a href="{{route('testimonial.edit', $testimonial->id)}}" class style="font-size: 20px"><i class="fa fa-pencil-square-o"></i> </a>
                                        <button type="button" class data-toggle="modal" data-target="#delete{{$testimonial->id}}" style="font-size: 20px">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>

                    @if($testimonials)
                        @foreach($testimonials as $testimonial)
                            <div class="modal modal-danger fade" id="delete{{$testimonial->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Delete Testimonial</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are You Sure You Want To Delete Testimonial <strong>{{$testimonial->testimonial_en->username}}</strong></p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{route('testimonial.destroy', $testimonial->id)}}" method="post">
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
                    @endif

                </div>
            </div>
        </div>
    </section>

@endsection
