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
            Request Details
            <small><strong>{{$request->campaignDetails->name}} </strong>Request</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/campaign-request')}}">Campaigns Requests</a></li>
            <li class="active">All Requests</li>
        </ol>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary" style="padding: 15px">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Requests Items</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>

                            @if($campaignItems)
                                @foreach($campaignItems as $campaignItem)
                                    <tr>
                                        <td>{{$campaignItem->billboard_id}}</td>
                                        <td>{{$campaignItem->requestedBillboard->code}}</td>
                                        <td>{{$campaignItem->starts->format('M Y')}}</td>
                                        <td>{{$campaignItem->end->format('M Y')}}</td>
                                        <td><a href="{{adminUrl('billboard/' . $campaignItem->billboard_id)}}"><i class="fa fa-eye"></i> </a> </td>
                                    </tr>
                                @endforeach
                            @endif


                            </tbody>
                        </table>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary" style="padding: 15px">
                    <div class="box-header with-border">
                        <h3 class="box-title">Request INFO</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <div class="col-md-12">
                            <div class="box">

                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <th class="text-center">Attribute</th>
                                            <th class="text-center">Details</th>
                                        </tr>
                                        <tr>
                                            <td><strong>User Name</strong> </td>
                                            <td>{{$request->user->name}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Company</strong> </td>
                                            <td>{{$request->campaignDetails->company}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Phone</strong> </td>
                                            <td>{{$request->campaignDetails->phone}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Position</strong> </td>
                                            <td>{{$request->campaignDetails->position}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Campaign Name</strong> </td>
                                            <td>{{$request->campaignDetails->name}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong> Requested at</strong></td>
                                            <td>{{$request->created_at->diffForHumans()}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                            <!-- /.box -->
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

@endsection
