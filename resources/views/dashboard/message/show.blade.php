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
            <li><a href="{{adminUrl('/message')}}">Messages</a></li>
            <li class="active">All Message</li>
        </ol>
    </section>



    <section class="content">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Read Message</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="mailbox-read-info">
                            <h3>{{$message->title}}</h3>
                            <h5>From: {{$message->email}}
                                <span class="mailbox-read-time pull-right">{{$message->created_at->format('d M Y h:m A')}}</span></h5>
                        </div>
                        <!-- /.mailbox-read-info -->
                        <div class="mailbox-controls with-border text-center">

                        </div>
                        <!-- /.mailbox-controls -->
                        <div class="mailbox-read-message">
                            <p>Hello John,</p>

                            <p>{{$message->message}}</p>


                        </div>
                        <!-- /.mailbox-read-message -->
                    </div>
                    <!-- /.box-body -->
                    <!-- /.box-footer -->
                    <div class="box-footer">
                        <button type="button" class="btn btn-default"  data-toggle="modal" data-target="#delete{{$message->id}}"><i class="fa fa-trash-o"></i> Delete</button>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>

        @include('dashboard.layouts.messages')
        <!-- /.box-header -->
        <!-- form start -->
        <div class="modal modal-danger fade" id="delete{{$message->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Delete Message</h4>
                            </div>
                            <div class="modal-body">
                                <p>Are You Sure You Want To Delete Message <strong>{{$message->title}}</strong></p>
                            </div>
                            <div class="modal-footer">
                                <form action="{{route('message.destroy', $message->id)}}" method="post">
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
    </section>

@endsection
