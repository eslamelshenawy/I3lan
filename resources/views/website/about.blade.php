@extends('website.layouts.layouts')
@section('title', 'Contact')

@section('content')

<body>

<!--== Video Start ==-->
  <section class="parallax-bg fixed-bg" data-parallax-bg-image="website/assets/images/video/parallax-bg-9.jpg" data-parallax-speed="0.8" data-parallax-direction="up">
    <div class="parallax-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center parallax-content">
                <div class="center-layout">
              <div class="v-align-middle">
                   <a class="popup-youtube" href="https://www.youtube.com/watch?v=sU3FkzUKHXU">
                    <div class="play-button">
                        <i class="tr-icon ion-android-arrow-dropright"></i>
                    </div>
                   </a>
                <h3 class="font-30px font-600 white-color">About Us</h3>
{{--                <p class="grey-color mt-30">--}}
{{--                    A media & an advertising agency specialized in Outdoors’ advertisements, building our portfolio through Egypt’s main roads, streets and areas since 2005.--}}
{{--                    E3lan Misr has a distinct array of clientele history in various fields, and have broken a few records here and there over the past 14 years.--}}
{{--                    Not only does E3lan Misr execute eye catching outdoors, but we have also managed to excel in executing a perfectly finished production concepts too.--}}
{{--                </p>--}}
              </div>

            </div>
            </div>
        </div>
    </div>
</section>
<!--== Video End ==-->



    <!--== Tabs Start ==-->
  <section class="white-bg" style="padding-top: 30px; padding-bottom: 50px;">
    <div class="container">
    	 <div class="row tabs-style-02">
          <div class="col-md-8 col-md-offset-2">
              <p class="text-center mt-30">
                  A media & an advertising agency specialized in Outdoors’ advertisements, building our portfolio through Egypt’s main roads, streets and areas since 2005.
                  E3lan Misr has a distinct array of clientele history in various fields, and have broken a few records here and there over the past 14 years.
                  Not only does E3lan Misr execute eye catching outdoors, but we have also managed to excel in executing a perfectly finished production concepts too.
              </p>
{{--            <div class="light-tabs">--}}
{{--              <!--== Nav tabs ==-->--}}
{{--              <ul class="nav nav-tabs text-center" role="tablist">--}}
{{--                <li role="presentation" class="active"><a href="#mission" role="tab" data-toggle="tab">Mission</a></li>--}}
{{--                <li role="presentation"><a href="#history" role="tab" data-toggle="tab">History</a></li>--}}
{{--                <li role="presentation"><a href="#vision" role="tab" data-toggle="tab">Vision</a></li>--}}
{{--                <li role="presentation"><a href="#review" role="tab" data-toggle="tab">Review</a></li>--}}
{{--              </ul>--}}
{{--              <!--== Tab panes ==-->--}}
{{--              <div class="tab-content text-center">--}}
{{--                <div role="tabpanel" class="tab-pane fade in active" id="mission">--}}
{{--                  <p>@if(app()->getLocale() == "en") {!! $about->about_en->mission !!} @else {!! $about->about_ar->mission !!} @endif</p>--}}
{{--                </div>--}}
{{--                <div role="tabpanel" class="tab-pane fade" id="history">--}}
{{--                <p>@if(app()->getLocale() == "en") {!! $about->about_en->description !!} @else {!! $about->about_ar->description !!} @endif</p>--}}
{{--                </div>--}}
{{--                <div role="tabpanel" class="tab-pane fade" id="vision">--}}
{{--                <p>@if(app()->getLocale() == "en") {!! $about->about_en->vision !!} @else {!! $about->about_ar->vision !!} @endif</p>--}}
{{--                </div>--}}
{{--                <div role="tabpanel" class="tab-pane fade" id="review">--}}
{{--                <p>@if(app()->getLocale() == "en") {!! $about->about_en->value !!} @else {!! $about->about_ar->value !!} @endif</p>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
          </div>
        </div>
    </div>
  </section>
  <!--== Tabs End ==-->








@endsection
