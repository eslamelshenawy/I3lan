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
            Billboard Sizes
            <small>All Billboard Sizes</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/size')}}">Billboard Sizes</a></li>
            <li class="active">All Billboard Sizes</li>
        </ol>
    </section>


    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box box-primary" style="padding: 15px">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Billboard Sizes Info</h3>
                        <a href="{{adminUrl('size/create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Billboard Size </a>
                    </div>
                    @include('dashboard.layouts.messages')
                    <!-- /.box-header -->
                    <!-- form start -->
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Billboard Size</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Billboard Size</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @if($sizes)
                            @foreach($sizes as $size)
                                <tr>
                                    <td>{{$size->id}}</td>
                                    <td>{{$size->size}}</td>
                                    <td>{{$size->created_at ? $size->created_at->diffForHumans() : ''}}</td>
                                    <td>{{$size->updated_at ? $size->updated_at->diffForHumans() : ''}}</td>
                                    <td>
                                        <a href="{{route('size.edit', $size->id)}}" class style="font-size: 20px"><i class="fa fa-pencil-square-o"></i> </a>
                                        <button type="button" class data-toggle="modal" data-target="#delete{{$size->id}}" style="font-size: 20px">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                    @if($sizes)
                        @foreach($sizes as $size)
                            <div class="modal modal-danger fade" id="delete{{$size->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Delete Billboard Size</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are You Sure You Want To Delete Size <strong>{{$size->size}}</strong></p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{route('size.destroy', $size->id)}}" method="post">
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
