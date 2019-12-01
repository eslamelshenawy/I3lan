@extends('website.layouts.layouts')
@section('title', 'Campaign')

@section('customizedScript')
@endsection

@section('content')


    <!--== Page Title Start ==-->
    <div class="transition-none">
        <section class="title-hero-bg parallax-effect" style="background-image: url({{asset('website/assets/images/services/camp_cover.jpg')}});">
            <div class="container">
                <div class="page-title text-center white-color">
                    <h1>Campaign Items</h1>
                    <h4 class="text-uppercase mt-30">All Campaign Items</h4>
                </div>
            </div>
        </section>
    </div>
    <!--== Page Title End ==-->

    <!--== Products Start ==-->

    <section>
        <div class="container">
            @if($requestedCampaign)

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered shop-cart">
                            <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Item</th>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Duration</th>
                                <th>Zone</th>
                                <th>Location</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($requestedCampaign)
                                @foreach($requestedCampaign->campaignItems as $item)
                                    <tr class="cart_item">
                                        <td><a href="#" title="Remove this item"><i class="ion-ios-close-outline"></i></a> </td>
                                        <td><a href="{{url('serviceDetails/' . $item->billboard_id)}}"> <img src="{{asset($item->requestedBillboard->image->path)}}" alt=""> </a> </td>
                                        <td><a href="{{url('serviceDetails/' . $item->billboard_id)}}">{{$item->requestedBillboard->code}}</a> </td>
                                        <td><span>{{$item->requestedBillboard->service->{'service_' . currentLang()}->title }}</span> </td>
                                        <td>
                                            From: <span style="font-weight: bold" class="black">{{$item->starts}}</span><br>
                                            To: <span style="font-weight: bold" class="black">{{$item->end}}</span><br>
                                        </td>
                                        <td><span>{{$item->requestedBillboard->parentLocation->parentLocation_en->location}}</span> </td>
                                        <td><span>{{$item->requestedBillboard->childLocation->childLocation_en->location}}</span> </td>
                                    </tr>
                                @endforeach
                            @endif
                            {{--<tr class="cart_item">
                                <td><a href="#" title="Remove this item"><i class="ion-ios-close-outline"></i></a> </td>
                                <td><a href="serviceDetails.html"> <img src="assets/images/services/Picture1.png" alt=""> </a> </td>
                                <td><a href="serviceDetails.html">#RMF008</a> </td>
                                <td><span>Billboard</span> </td>
                                <td>
                                    From: <span style="font-weight: bold" class="black">July 2019</span><br>
                                    To: <span style="font-weight: bold" class="black">December 2019</span><br>
                                </td>
                                <td><span>Greater Cairo</span> </td>
                                <td><span>Ramsees</span> </td>
                            </tr>

                            <tr class="cart_item">
                                <td><a href="#" title="Remove this item"><i class="ion-ios-close-outline"></i></a> </td>
                                <td><a href="serviceDetails.html"> <img src="assets/images/services/Picture3.png" alt=""> </a> </td>
                                <td><a href="serviceDetails.html">#SDF52</a> </td>
                                <td><span>Landmark</span> </td>
                                <td>
                                    From: <span style="font-weight: bold" class="black">August 2019</span><br>
                                    To: <span style="font-weight: bold" class="black">December 2019</span><br>
                                </td>
                                <td><span>Greater Cairo</span> </td>
                                <td><span>Abbasya</span> </td>
                            </tr>

                            <tr class="cart_item">
                                <td><a href="#" title="Remove this item"><i class="ion-ios-close-outline"></i></a> </td>
                                <td><a href="serviceDetails.html"> <img src="assets/images/services/Picture2.png" alt=""> </a> </td>
                                <td><a href="serviceDetails.html">#MOSI55</a> </td>
                                <td><span>Billboard</span> </td>
                                <td>
                                    From: <span style="font-weight: bold" class="black">November 2019</span><br>
                                    To: <span style="font-weight: bold" class="black">February 2020</span><br>
                                </td>
                                <td><span>Giza</span> </td>
                                <td><span>23 July Axis</span> </td>
                            </tr>--}}


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            @include('dashboard.layouts.messages')
            <form name="contact-form" method="POST" action="{{url('submit-campaign-request')}}">
                @csrf
                @method('post')
                <div class="checkout-form">
                    <div class="row">
                        <div class="col-md-12 mb-20 col-xs-12 col-sm-6">
                            <div class="mb-20">
                                <h5 class="upper-case">Complete Campaign Info</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Company</label>
                                    <input type="text" name="company_name" class="form-control"  required placeholder="Enter Your Company Name" data-error="Your Name is Required" value="{{old('company_name')}}">
                                    <div class="help-block with-errors mt-20"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Position/Title</label>
                                    <input class="form-control" id="address" name="position" type="text" required placeholder="Ex: Marketing Manager" data-error="Address is Required" value="{{old('position')}}">
                                    <div class="help-block with-errors mt-20"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input class="form-control" id="address_2" name="phone" type="text" required placeholder="(+20) 112 548 8884" data-error="Permanent Address is Required" value="{{old('phone')}}">
                                    <div class="help-block with-errors mt-20"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Campaign Name</label>
                                    <input class="form-control"  name="camp_name" type="text" required placeholder="Ex: Ramadan Campaign" data-error="Address is Required" value="{{old('camp_name')}}">
                                    <div class="help-block with-errors mt-20"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12" style="display: flex; flex-direction: row; justify-content: center">
                                    <div class="summary-cart no-border">
                                        <div class="check-btns">
                                            <button type="submit" class="btn btn-color btn-md btn-animate"><span>Send Request <i class="ion-checkmark"></i></span></button>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </form>
                @else
                <p class="text-center">No Selected Items</p>
            @endif

        </div>
    </section>
    <!--== Products End ==-->


@endsection
