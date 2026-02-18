@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <!-- Slider Section Start -->
        <div class="rs-slider main-home">
            <div class="rs-carousel owl-carousel" data-loop="true" data-items="1" data-margin="0" data-autoplay="true"
                data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="false"
                data-nav="false" data-nav-speed="false" data-center-mode="false" data-mobile-device="1"
                data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="1"
                data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="1"
                data-ipad-device-nav2="false" data-ipad-device-dots2="false" data-md-device="1"
                data-md-device-nav="true" data-md-device-dots="false">
                <div class="slider-content slide1">
                    <div class="container">
                        <div class="content-part">
                            <div class="sl-sub-title wow bounceInLeft" data-wow-delay="300ms"
                                data-wow-duration="2000ms">Start to learning today</div>
                            <h1 class="sl-title wow fadeInRight" data-wow-delay="600ms" data-wow-duration="2000ms">
                                Online Courses From Leading Experts</h1>
                            <div class="sl-btn wow fadeInUp" data-wow-delay="900ms" data-wow-duration="2000ms">
                                <a class="readon orange-btn main-home" href="#">Find Courses</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider-content slide2">
                    <div class="container">
                        <div class="content-part">
                            <div class="sl-sub-title wow bounceInLeft" data-wow-delay="300ms"
                                data-wow-duration="2000ms">Start to learning today</div>
                            <h1 class="sl-title wow fadeInRight" data-wow-delay="600ms" data-wow-duration="2000ms">
                                Explore Interests and Career With Courses</h1>
                            <div class="sl-btn wow fadeInUp" data-wow-delay="900ms" data-wow-duration="2000ms">
                                <a class="readon orange-btn main-home" href="#">Find Courses</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Section start -->
            <div id="rs-features" class="rs-features main-home">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 md-mb-30">
                            <div class="features-wrap">
                                <div class="icon-part">
                                    <img src="assets/images/features/icon/3.png" alt="">
                                </div>
                                <div class="content-part">
                                    <h4 class="title">
                                        <span class="watermark">Proyección Social</span>
                                    </h4>
                                    <p class="dese">
                                        Enjoy a variety of fresh topics
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 md-mb-30">
                            <div class="features-wrap">
                                <div class="icon-part">
                                    <img src="assets/images/features/icon/2.png" alt="">
                                </div>
                                <div class="content-part">
                                    <h4 class="title">
                                        <span class="watermark">Educación y Comunicación</span>
                                    </h4>
                                    <p class="dese">
                                        Find the right instructor
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="features-wrap">
                                <div class="icon-part">
                                    <img src="assets/images/features/icon/1.png" alt="">
                                </div>
                                <div class="content-part">
                                    <h4 class="title">
                                        <span class="watermark">Investigación</span>
                                    </h4>
                                    <p class="dese">
                                        Learn on your schedule
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Features Section End -->
        </div>
        <!-- Slider Section End -->


        <!-- Services Section Start -->
            <div class="rs-services style2 pt-100 md-pt-80">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 md-mb-30">
                            <div class="service-item wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms">
                                <div class="content-part">
                                    <span class="icon-part"><i class="flaticon-analysis"></i></span>
                                    <h4 class="title"><a href="#">Proinapsa en Cifras</a></h4>
                                    <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor inci didunt ut labore et dolore magna</p>
                                    <a class="service-btn" href="/assets/doc/CV KEVIN BECERRA.pdf" target="_blank">Read More <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 md-mb-30">
                            <div class="service-item wow fadeInUp" data-wow-delay="600ms" data-wow-duration="2000ms">
                                <div class="content-part">
                                    <span class="icon-part"><i class="flaticon-document"></i></span>
                                    <h4 class="title"><a href="#">Oferta Educativa</a></h4>
                                    <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor inci didunt ut labore et dolore magna</p>
                                    <a class="service-btn" href="#">Read More <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="service-item wow fadeInUp" data-wow-delay="900ms" data-wow-duration="2000ms">
                                <div class="content-part">
                                    <span class="icon-part"><i class="flaticon-tax"></i></span>
                                    <h4 class="title"><a href="#">Portafolio</a></h4>
                                    <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor inci didunt ut labore et dolore magna</p>
                                    <a class="service-btn" href="/assets/doc/CV KEVIN BECERRA.pdf" target="_blank">Read More <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Services Section End -->

            <!-- Testimonial Section Start -->
            <div class="rs-testimonial style3">
                <div class="container">
                    <div class="sec-title mb-60 text-center md-mb-30">
                        <div class="sub-title primary">Student Reviews</div>
                        <h2 class="title mb-0">What Our Students Says</h2>
                    </div>
                    <div class="rs-carousel owl-carousel" data-loop="true" data-items="2" data-margin="30" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="true" data-nav="false" data-nav-speed="false" data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="2" data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="1" data-ipad-device-nav2="false" data-ipad-device-dots2="false" data-md-device="2" data-md-device-nav="false" data-md-device-dots="true">
                        <div class="testi-item">
                            <div class="row y-middle no-gutter">
                                <div class="col-md-4">
                                    <div class="user-info">
                                        <img src="assets/images/testimonial/style3/1.png" alt="">
                                        <h4 class="name">Saiko Najran</h4>
                                        <span class="designation">Student</span>
                                        <ul class="ratings">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="desc">The charms of pleasure of the moment so blinded by desire that they cannot foresee the pain and trouble that are bound ensue and equal blame belongs to those who fail in their duty.</div>
                                </div>
                            </div>
                        </div>
                        <div class="testi-item">
                            <div class="row y-middle no-gutter">
                                <div class="col-md-4">
                                    <div class="user-info">
                                        <img src="assets/images/testimonial/style3/2.png" alt="">
                                        <h4 class="name">Saiko Najran</h4>
                                        <span class="designation">Student</span>
                                        <ul class="ratings">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="desc">The charms of pleasure of the moment so blinded by desire that they cannot foresee the pain and trouble that are bound ensue and equal blame belongs to those who fail in their duty.</div>
                                </div>
                            </div>
                        </div>
                        <div class="testi-item">
                            <div class="row y-middle no-gutter">
                                <div class="col-md-4">
                                    <div class="user-info">
                                        <img src="assets/images/testimonial/style3/3.png" alt="">
                                        <h4 class="name">Saiko Najran</h4>
                                        <span class="designation">Student</span>
                                        <ul class="ratings">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="desc">The charms of pleasure of the moment so blinded by desire that they cannot foresee the pain and trouble that are bound ensue and equal blame belongs to those who fail in their duty.</div>
                                </div>
                            </div>
                        </div>
                        <div class="testi-item">
                            <div class="row y-middle no-gutter">
                                <div class="col-md-4">
                                    <div class="user-info">
                                        <img src="assets/images/testimonial/style3/4.png" alt="">
                                        <h4 class="name">Saiko Najran</h4>
                                        <span class="designation">Student</span>
                                        <ul class="ratings">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="desc">The charms of pleasure of the moment so blinded by desire that they cannot foresee the pain and trouble that are bound ensue and equal blame belongs to those who fail in their duty.</div>
                                </div>
                            </div>
                        </div>
                        <div class="testi-item">
                            <div class="row y-middle no-gutter">
                                <div class="col-md-4">
                                    <div class="user-info">
                                        <img src="assets/images/testimonial/style3/5.png" alt="">
                                        <h4 class="name">Saiko Najran</h4>
                                        <span class="designation">Student</span>
                                        <ul class="ratings">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="desc">The charms of pleasure of the moment so blinded by desire that they cannot foresee the pain and trouble that are bound ensue and equal blame belongs to those who fail in their duty.</div>
                                </div>
                            </div>
                        </div>
                        <div class="testi-item">
                            <div class="row y-middle no-gutter">
                                <div class="col-md-4">
                                    <div class="user-info">
                                        <img src="assets/images/testimonial/style3/6.png" alt="">
                                        <h4 class="name">Saiko Najran</h4>
                                        <span class="designation">Student</span>
                                        <ul class="ratings">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="desc">The charms of pleasure of the moment so blinded by desire that they cannot foresee the pain and trouble that are bound ensue and equal blame belongs to those who fail in their duty.</div>
                                </div>
                            </div>
                        </div>
                        <div class="testi-item">
                            <div class="row y-middle no-gutter">
                                <div class="col-md-4">
                                    <div class="user-info">
                                        <img src="assets/images/testimonial/style3/7.png" alt="">
                                        <h4 class="name">Saiko Najran</h4>
                                        <span class="designation">Student</span>
                                        <ul class="ratings">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="desc">The charms of pleasure of the moment so blinded by desire that they cannot foresee the pain and trouble that are bound ensue and equal blame belongs to those who fail in their duty.</div>
                                </div>
                            </div>
                        </div>
                        <div class="testi-item">
                            <div class="row y-middle no-gutter">
                                <div class="col-md-4">
                                    <div class="user-info">
                                        <img src="assets/images/testimonial/style3/8.png" alt="">
                                        <h4 class="name">Saiko Najran</h4>
                                        <span class="designation">Student</span>
                                        <ul class="ratings">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="desc">The charms of pleasure of the moment so blinded by desire that they cannot foresee the pain and trouble that are bound ensue and equal blame belongs to those who fail in their duty.</div>
                                </div>
                            </div>
                        </div>
                        <div class="testi-item">
                            <div class="row y-middle no-gutter">
                                <div class="col-md-4">
                                    <div class="user-info">
                                        <img src="assets/images/testimonial/style3/9.png" alt="">
                                        <h4 class="name">Saiko Najran</h4>
                                        <span class="designation">Student</span>
                                        <ul class="ratings">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="desc">The charms of pleasure of the moment so blinded by desire that they cannot foresee the pain and trouble that are bound ensue and equal blame belongs to those who fail in their duty.</div>
                                </div>
                            </div>
                        </div>
                        <div class="testi-item">
                            <div class="row y-middle no-gutter">
                                <div class="col-md-4">
                                    <div class="user-info">
                                        <img src="assets/images/testimonial/style3/10.png" alt="">
                                        <h4 class="name">Saiko Najran</h4>
                                        <span class="designation">Student</span>
                                        <ul class="ratings">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="desc">The charms of pleasure of the moment so blinded by desire that they cannot foresee the pain and trouble that are bound ensue and equal blame belongs to those who fail in their duty.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Testimonial Section End -->

@endsection