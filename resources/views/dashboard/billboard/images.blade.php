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
            Billboards
            <small><strong>{{$billboard->billboard_en->name}}</strong> Billboard Images</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/billboard')}}">Billboard</a></li>
            <li class="active">All Billboards</li>
        </ol>
    </section>


    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box box-primary" style="padding: 15px">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Billboards Images</h3>
                    </div>
                    @include('dashboard.layouts.messages')
                    <!-- /.box-header -->
                    <!-- form start -->

                    <div class="adminform">
                        <div class="row top-margin">
                            <div class="col-xs-12 deleteResult"></div>

                            @if($billboard)
                                @if(count($billboard->images) > 0)
                                    @foreach($billboard->images as $image)
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 imgnum34">
                                            <div class="albumImageContainer">
                                                <p class="thumbnail">
                                                    <img src="{{asset($image->path)}}" class="img-responsive albumImg">
                                                </p>
                                                <i title="Delete" data-toggle="modal" data-target="#delete{{$image->id}}" class="fa fa-trash deleteAlbumImage" data-id="34" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endif


                        </div>


                        @if($billboard)
                            @if(count($billboard->images) > 0)
                                @foreach($billboard->images as $image)

                                <div class="modal modal-danger fade" id="delete{{$image->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Delete Image</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are You Sure You Want To Delete Image <strong></strong></p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{adminUrl('billboard/image/'.$image->id.'/destroy')}}" method="post">
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
                                @endforeach
                            @endif
                        @endif
                    </div>

                    {{--@if($billboards)
                        @foreach($billboards as $billboard)
                            <div class="modal modal-danger fade" id="delete{{$billboard->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Delete User</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are You Sure You Want To Delete Billboard <strong>{{$billboard->billboard_en->name}}</strong></p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{route('billboard.destroy', $billboard->id)}}" method="post">
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
                    @endif--}}

                </div>
            </div>
        </div>
    </section>

@endsection
