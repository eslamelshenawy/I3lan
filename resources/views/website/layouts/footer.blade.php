<!--== Footer Start ==-->
<footer class="footer dark-block">
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="widget widget-text">
                        <div class="logo logo-footer"><a href="index.html"> <img class="logo logo-display" src="{{url('website')}}/assets/images/logo/Light.png" style="max-height: 100px" alt=""></a> </div>
{{--                        <p>Objectively innovate empowered manufactured products whereas parallel platforms. Holisticly predominate extensible testing procedures for reliable supply chains. Dramatically engage top-line web services vis-a-vis cutting-edge deliverables.</p>--}}
                    </div>
                </div>
                <div class="col-sm-6 col-md-2">
                    <div class="widget widget-links">
                        <h5 class="widget-title">Useful Links</h5>
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><a href="{{url('about')}}">About Us</a></li>
                            <li><a href="{{url('services')}}">Our Services</a></li>
                            <li><a href="{{url('contact')}}">Contact</a></li>
                            {{--<li><a href="#">Gallery</a></li>--}}
                            <li><a href="{{url('buildCamp')}}">Start Your Campaign</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="widget widget-links">
                        <h5 class="widget-title">Contact Us</h5>
                        <div class="widget-links">
                            <ul>
                                <li>{{$contact->address_en}}</li>
                                <li>{{$contact->phone}}</li>
                                <li>{{$contact->email}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-2">
                    <div class="widget widget-links">
                        <h5 class="widget-title">Our Services</h5>
                        <ul>
                            @foreach($services as $service)
                                <li><a href="{{url('services?service=' . $service->{'service_' . currentLang()}->title)}}">{{$service->{'service_' . currentLang()}->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="copy-right text-left">© 2019 <i class="icon icofont icofont-heart-alt"></i> E3lan Misr. All rights reserved</div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <ul class="social-media">
                        <li><a href="#" class="icofont icofont-social-facebook"></a></li>
                        <li><a href="#" class="icofont icofont-social-twitter"></a></li>
                        <li><a href="#" class="icofont icofont-social-behance"></a></li>
                        <li><a href="#" class="icofont icofont-social-dribble"></a></li>
                        <li><a href="#" class="icofont icofont-social-linkedin"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--== Footer End ==-->
