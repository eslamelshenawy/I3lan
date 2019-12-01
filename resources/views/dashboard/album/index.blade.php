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
            Albums
            <small>All Albums</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/album')}}">Album</a></li>
            <li class="active">All Albums</li>
        </ol>
    </section>



    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box box-primary" style="padding: 15px">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Albums Info</h3>
                        <a href="{{adminUrl('album/create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Album </a>
                    </div>
                @include('dashboard.layouts.messages')
                <!-- /.box-header -->
                    <!-- form start -->
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Thumbnail</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Number of Items</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Thumbnail</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Number of Items</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @if($albums)
                            @foreach($albums as $album)
                                <tr>
                                    <td>{{$album->id}}</td>
                                    <td><img src="{{$album->image_id ? asset($album->image->path) : asset('dashboard/img/picture.png')}}" style="width: 50px" alt="slide image" > </td>
                                    <td>{{$album->album_en->title}}</td>
                                    <td>{{$album->type == 1 ? 'Images' : 'Videos'}}</td>
                                    <td>{{$album->type == 1 ? count($album->images) : count($album->videos)}}</td>
                                    <td>{{$album->created_at ? $album->created_at->diffForHumans() : ''}}</td>
                                    <td>{{$album->updated_at ? $album->updated_at->diffForHumans() : ''}}</td>
                                    <td>
                                        <a href="{{route('album.edit', $album->id)}}" class style="font-size: 20px"><i class="fa fa-pencil-square-o"></i> </a>
                                        @if($album->type == 1)
                                            <a href="{{adminUrl('album/'.$album->id)}}" class style="font-size: 20px"><i class="fa fa-file-image-o" title="Show Album Images"></i> </a>
                                        @elseif($album->type == 2)
                                            <a href="{{adminUrl('video/?album='.$album->id)}}" class style="font-size: 20px"><i class="fa fa-video-camera" title="Show Album Videos"></i> </a>
                                        @endif
                                        <a href="{{$album->type == 1 ? adminUrl('album/'.$album->id.'/upload-to-gallery') : adminUrl('video/create')}}" class style="font-size: 20px">
                                            <i class="fa {{$album->type == 1 ? 'fa-upload' : 'fa-plus'}}"></i> </a>
                                        <button type="button" class data-toggle="modal" data-target="#delete{{$album->id}}" style="font-size: 20px">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>

                    @if($albums)
                        @foreach($albums as $album)
                            <div class="modal modal-danger fade" id="delete{{$album->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Delete Album</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are You Sure You Want To Delete Album <strong>{{$album->album_en->title}}</strong></p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{route('album.destroy', $album->id)}}" method="post">
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
