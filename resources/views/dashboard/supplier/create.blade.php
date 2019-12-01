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
            Suppliers
            <small>Create New Supplier</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/supplier')}}">Suppliers</a></li>
            <li class="active">Create Supplier</li>
        </ol>
    </section>



    <section class="content">
        @include('dashboard.layouts.messages')
        <form role="form" action="{{route('supplier.store')}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('post')
            <input type="hidden" name="created_by">
            <div class="row">
                <!-- English Side -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        <h3 class="box-title">Add Supplier Info</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-lg-5">
                                <label for="exampleInputEmail1"> Supplier Name</label>
                                <input type="text" class="form-control" name="supplier" id="exampleInputEmail1" placeholder="Enter Supplier Name" required value="{{old('supplier')}}">
                                <p class="help-block">Enter Supplier Name</p>
                            </div>

                            <div class="col-lg-5">
                                <label for="exampleInputEmail1"> Owner Name</label>
                                <input type="text" class="form-control" name="owner" id="exampleInputEmail1" placeholder="Enter Owner Name" required value="{{old('owner')}}">
                                <p class="help-block">Enter Owner Name</p>
                            </div>

                            <div class="col-lg-2">
                                <label for="exampleInputEmail1"> Letter</label>
                                <input type="text" class="form-control" name="letter" id="exampleInputEmail1" placeholder="Enter Letter" required value="{{old('letter')}}">
                                <p class="help-block">Enter Code/Letter</p>
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

            </div>
        </form>
    </section>


@endsection
