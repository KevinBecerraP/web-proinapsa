@extends('layouts.app-secondary')

@section('title', 'Inicio')

@section('content')
    <!-- Main content Start -->
    <div class="main-content">
        <!-- Banner -->
        <div class="rs-breadcrumbs breadcrumbs-overlay">
            <div class="breadcrumbs-img">
                <img src="{{ asset('images/breadcrumbs/2.jpg') }}" alt="Breadcrumbs Image">
            </div>
            <div class="breadcrumbs-text white-color">
                <h1 class="page-title">Sobre Nosotros</h1>
                <ul>
                    <li>
                        <a class="active" href="">Home</a>
                    </li>
                    <li>About Us</li>
                </ul>
            </div>
        </div>
        <!-- Banner -->

        <!-- vision -->
        <div id="rs-about" class="rs-about style1 pt-100 pb-100 md-pt-70 md-pb-70">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 order-last padding-0 md-pl-15 md-pr-15 md-mb-30">
                        <div class="img-part">
                            <img class="" src="{{ asset('images/about/about2orange.png') }}" alt="About Image">
                        </div>
                    </div>
                    <div class="col-lg-6 pr-70 md-pr-15">
                        <div class="sec-title mb-40 md-mb-20">
                            <h2 class="title mb-16">Visión</h2>
                            <div class="desc">Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos
                                de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el
                                año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido
                                usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos
                                especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno
                                en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado
                                en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de
                                Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus
                                PageMaker, el cual incluye versiones de Lorem Ipsum.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vision -->
        <!-- Mision -->
        <div class="rs-cta style2">
            <div class="partition-bg-wrap inner-page">
                <div class="container">
                    <div class="row y-bottom">
                        <div class="col-lg-6 pb-50 md-pt-70 md-pb-70">
                            <div class="video-wrap">
                                <a class="popup-videos" href="https://www.youtube.com/watch?v=atMUy_bPoQI">
                                    <i class="fa fa-play"></i>
                                    <h4 class="title mb-0">Take a Video Tour at Educavo</h4>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 pl-62 pt-134 pb-150 md-pt-50 md-pb-50 md-pl-15">
                            <div class="sec-title mb-40 md-mb-20">
                                <h2 class="title mb-16">Visión</h2>
                                <div class="desc">Lorem Ipsum es simplemente el texto de relleno de las imprentas y
                                    archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las
                                    industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a
                                    la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que
                                    logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que
                                    tambien ingresó como texto de relleno en documentos electrónicos, quedando
                                    esencialmente igual al original. Fue popularizado en los 60s con la creación de las
                                    hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente
                                    con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye
                                    versiones de Lorem Ipsum.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mision -->

        <!-- aun no se para que se puede usa -->
        <!--<div id="rs-about" class="rs-about style3 pt-100 md-pt-70">
                        <div class="container">
                            <div class="row y-middle">
                                <div class="col-lg-4 lg-pr-0 md-mb-30">
                                    <div class="about-intro">
                                        <div class="sec-title">
                                            <div class="sub-title orange">About Us</div>
                                            <h2 class="title mb-21">The End Result of All True Learning</h2>
                                            <div class="desc big">The key to success is to appreciate how people learn, understand the thought process that goes into instructional design, what works well, and a range of differen</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 pl-83 md-pl-15">
                                    <div class="row rs-counter couter-area">
                                        <div class="col-md-4 sm-mb-30">
                                            <div class="counter-item one">
                                                <img class="count-img" src="assets/images/about/style3/icons/1.png" alt="">
                                                <h2 class="number rs-count kplus">2</h2>
                                                <h4 class="title mb-0">Students</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-4 sm-mb-30">
                                            <div class="counter-item two">
                                                <img class="count-img" src="assets/images/about/style3/icons/2.png" alt="">
                                                <h2 class="number rs-count">3.50</h2>
                                                <h4 class="title mb-0">Average CGPA</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="counter-item three">
                                                <img class="count-img" src="assets/images/about/style3/icons/3.png" alt="">
                                                <h2 class="number rs-count percent">95</h2>
                                                <h4 class="title mb-0">Graduates</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Counter Section End -->

        <!-- Valores -->
        <div class="rs-faq-part orange-color pt-100 pb-100 md-pt-70 md-pb-70">
            <div class="container">
                <div class="content-part mb-50 md-mb-30">
                    <div class="title mb-40 md-mb-15">
                        <h3 class="text-part">Valores</h3>
                    </div>
                    <div id="accordion" class="accordion">
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#collapseOne">What do you mean by item and
                                    end product?</a>
                            </div>
                            <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                <div class="card-body">
                                    Aenean massa. Cum sociis natoque penatibus et magnis dis partu rient to montes, nascetur
                                    ridiculus mus. Donec quam felis, ultricies nec, pellen of the tesque services Donec quam
                                    felis, ultricies nec, pellentesque eu, pretium quis,pede justo, of fringilla vel,
                                    aliquet nec
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapseTwo"
                                    aria-expanded="false">What does non-exclusive mean?</a>
                            </div>
                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    Aenean massa. Cum sociis natoque penatibus et magnis dis partu rient to montes, nascetur
                                    ridiculus mus. Donec quam felis, ultricies nec, pellen of the tesque services Donec quam
                                    felis, ultricies nec, pellentesque eu, pretium quis,pede justo, of fringilla vel,
                                    aliquet nec
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapseThree"
                                    aria-expanded="false">What are some examples of permitted end products?</a>
                            </div>
                            <div id="collapseThree" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    Aenean massa. Cum sociis natoque penatibus et magnis dis partu rient to montes, nascetur
                                    ridiculus mus. Donec quam felis, ultricies nec, pellen of the tesque services Donec quam
                                    felis, ultricies nec, pellentesque eu, pretium quis,pede justo, of fringilla vel,
                                    aliquet nec.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Video Proinapsa -->
        <div id="rs-about-video" class="rs-about-video pt-100 pb-100 md-pt-70 md-pb-70">
            <div class="container">
                <div class="video-img-part media-icon orange-color2">
                    <img src="assets/images/about/about-video-bg-orange.png" alt="Video Bg Image">
                    <a class="popup-videos" href="https://www.youtube.com/watch?v=atMUy_bPoQI">
                        <i class="fa fa-play"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- Video Proinapsa -->

        <!-- Talento Humano -->
        <div id="rs-team" class="rs-team style1 inner-style orange-color pt-94 pb-100 md-pt-64 md-pb-70 gray-bg">
            <div class="container">
                <div class="sec-title mb-50 md-mb-30 text-center">
                    <div class="sub-title orange">Talento Humano</div>
                    <h2 class="title mb-0">Equipo Proinapsa</h2>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-6 mb-30">
                        <div class="team-item">
                            <img src="assets/images/team/1.jpg" alt="">
                            <div class="content-part">
                                <h4 class="name"><a href="team-single.html">Jhon Pedrocas</a></h4>
                                <span class="designation">Professor</span>
                                <ul class="social-links">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-30">
                        <div class="team-item">
                            <img src="assets/images/team/2.jpg" alt="">
                            <div class="content-part">
                                <h4 class="name"><a href="team-single.html">Jhon Pedrocas</a></h4>
                                <span class="designation">Professor</span>
                                <ul class="social-links">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-30">
                        <div class="team-item">
                            <img src="assets/images/team/3.jpg" alt="">
                            <div class="content-part">
                                <h4 class="name"><a href="#">Jhon Pedrocas</a></h4>
                                <span class="designation">Professor</span>
                                <ul class="social-links">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 md-mb-30">
                        <div class="team-item">
                            <img src="assets/images/team/2.jpg" alt="">
                            <div class="content-part">
                                <h4 class="name"><a href="team-single.html">Jhon Pedrocas</a></h4>
                                <span class="designation">Professor</span>
                                <ul class="social-links">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 xs-mb-30">
                        <div class="team-item">
                            <img src="assets/images/team/3.jpg" alt="">
                            <div class="content-part">
                                <h4 class="name"><a href="#">Jhon Pedrocas</a></h4>
                                <span class="designation">Professor</span>
                                <ul class="social-links">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="team-item">
                            <img src="assets/images/team/1.jpg" alt="">
                            <div class="content-part">
                                <h4 class="name"><a href="team-single.html">Jhon Pedrocas</a></h4>
                                <span class="designation">Professor</span>
                                <ul class="social-links">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Talento Humano -->

        <!-- Testimonial Section Start -->
        <!--<div class="rs-testimonial style3 orange-color pt-90 md-pt-70">
                        <div class="container">
                            <div class="sec-title mb-60 md-mb-30 text-center">
                                <div class="sub-title orange">Student Reviews</div>
                                <h2 class="title mb-0">What Our Students Says</h2>
                            </div>
                            <div class="rs-carousel owl-carousel" data-loop="true" data-items="2" data-margin="30" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="true" data-nav="false" data-nav-speed="false" data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="2" data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="2" data-ipad-device-nav2="false" data-ipad-device-dots2="false" data-md-device="2" data-md-device-nav="false" data-md-device-dots="true">
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

        <!-- Blog Section Start -->
        <div id="rs-blog" class="rs-blog orange-color style1 modify1 pt-85 pb-100 md-pt-70 md-pb-70">
            <div class="container">
                <div class="sec-title mb-60 md-mb-30 text-center">
                    <div class="sub-title orange">News Update </div>
                    <h2 class="title mb-0">Latest News & Events</h2>
                </div>
                <div class="row">
                    <div class="col-lg-7 pr-60 md-pr-15 md-mb-30">
                        <div class="row no-gutter white-bg blog-item mb-35">
                            <div class="col-md-6">
                                <div class="image-part">
                                    <a href="#"><img src="assets/images/blog/style3/1.jpg" alt=""></a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="blog-content">
                                    <ul class="blog-meta">
                                        <li><i class="fa fa-user-o"></i> Admin</li>
                                        <li><i class="fa fa-calendar"></i>June 15, 2019</li>
                                    </ul>
                                    <h3 class="title"><a href="blog-single.html">Modern School The Lovely Valley Team
                                            Work</a></h3>
                                    <div class="btn-part">
                                        <a class="readon-arrow" href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row no-gutter white-bg blog-item">
                            <div class="col-md-6 order-last">
                                <div class="image-part">
                                    <a href="#"><img src="assets/images/blog/style3/2.jpg" alt=""></a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="blog-content">
                                    <ul class="blog-meta">
                                        <li><i class="fa fa-user-o"></i> Admin</li>
                                        <li><i class="fa fa-calendar"></i>June 15, 2019</li>
                                    </ul>
                                    <h3 class="title"><a href="blog-single.html">High School Program Starting Soon
                                            2021</a></h3>
                                    <div class="btn-part">
                                        <a class="readon-arrow" href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 lg-pl-0">
                        <div class="events-short mb-28">
                            <div class="date-part bgc1">
                                <span class="month">June</span>
                                <div class="date">20</div>
                            </div>
                            <div class="content-part">
                                <div class="categorie">
                                    <a href="#">Math</a> & <a href="#">English</a>
                                </div>
                                <h4 class="title mb-0"><a href="blog-single.html">Educational Technology and Mobile
                                        Accessories Learning</a></h4>
                            </div>
                        </div>
                        <div class="events-short mb-28">
                            <div class="date-part bgc2">
                                <span class="month">June</span>
                                <div class="date">21</div>
                            </div>
                            <div class="content-part">
                                <div class="categorie">
                                    <a href="#">Math</a> & <a href="#">English</a>
                                </div>
                                <h4 class="title mb-0"><a href="blog-single.html">Educational Technology and Mobile
                                        Accessories Learning</a></h4>
                            </div>
                        </div>
                        <div class="events-short mb-28">
                            <div class="date-part bgc3">
                                <span class="month">June</span>
                                <div class="date">22</div>
                            </div>
                            <div class="content-part">
                                <div class="categorie">
                                    <a href="#">Math</a> & <a href="#">English</a>
                                </div>
                                <h4 class="title mb-0"><a href="blog-single.html">Educational Technology and Mobile
                                        Accessories Learning</a></h4>
                            </div>
                        </div>
                        <div class="events-short">
                            <div class="date-part bgc4">
                                <span class="month">June</span>
                                <div class="date">23</div>
                            </div>
                            <div class="content-part">
                                <div class="categorie">
                                    <a href="#">Math</a> & <a href="#">English</a>
                                </div>
                                <h4 class="title mb-0"><a href="blog-single.html">Educational Technology and Mobile
                                        Accessories Learning</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Blog Section End -->

        <!-- Aun no se en que usar -->
        <div class="rs-newsletter style1 orange-color mb--90 sm-mb-0 sm-pb-70">
            <div class="container">
                <div class="newsletter-wrap">
                    <div class="row y-middle">
                        <div class="col-lg-6 col-md-12 md-mb-30">
                            <div class="content-part">
                                <div class="sec-title">
                                    <div class="title-icon md-mb-15">
                                        <img src="assets/images/newsletter.png" alt="images">
                                    </div>
                                    <h2 class="title mb-0 white-color">Subscribe to Newsletter</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <form class="newsletter-form">
                                <input type="email" name="email" placeholder="Enter Your Email" required="">
                                <button type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Aun no se en que usar -->
    </div>
    <!-- Main content End -->

@endsection
