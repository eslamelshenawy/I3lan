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
                'lengthChange': false,
                'searching'   : false,
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
            Services
            <small>All Services</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/service')}}">Service</a></li>
            <li class="active">All Services</li>
        </ol>
    </section>


    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box box-primary" style="padding: 15px">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Services Info</h3>
                        <a href="{{adminUrl('service/create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Service </a>
                    </div>
                    @include('dashboard.layouts.messages')
                    <!-- /.box-header -->
                    <!-- form start -->
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Slug</th>
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
                            <th>Slug</th>
                            <th>Created By</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @if($services)
                            @foreach($services as $service)
                                <tr>
                                    <td>{{$service->id}}</td>
                                    <td><img src="{{$service->image_id ? asset($service->image->path) : asset('dashboard/img/picture.png')}}" style="width: 50px" alt="slide image" > </td>
                                    <td>{{$service->service_en->title}}</td>
                                    <td>{{$service->service_en->slug}}</td>
                                    <td>{{$service->createdBy->name}}</td>
                                    <td>{{$service->created_at ? $service->created_at->diffForHumans() : ''}}</td>
                                    <td>{{$service->updated_at ? $service->updated_at->diffForHumans() : ''}}</td>
                                    <td>
                                        <a href="{{route('service.edit', $service->id)}}" class style="font-size: 20px"><i class="fa fa-pencil-square-o"></i> </a>
                                        <a href="{{adminUrl('service/'.$service->id . '/create')}}" class style="font-size: 20px"><i class="fa fa-plus" title="Add Mini Services to this service"></i> </a>
                                        <a href="{{adminUrl('service/'.$service->id)}}" class style="font-size: 20px"><i class="fa fa-eye" title="Show Sub-Services"></i> </a>
                                        <button type="button" class data-toggle="modal" data-target="#delete{{$service->id}}" style="font-size: 20px">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                    @if($services)
                        @foreach($services as $service)
                            <div class="modal modal-danger fade" id="delete{{$service->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Delete User</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are You Sure You Want To Delete Service <strong>{{$service->service_en->title}}</strong></p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{route('service.destroy', $service->id)}}" method="post">
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
