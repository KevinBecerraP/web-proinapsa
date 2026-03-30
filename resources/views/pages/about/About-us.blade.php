@extends('layouts.app-secondary')

@section('title', 'Inicio')

@section('content')
    <!-- Main content Start -->
    <div class="main-content">
        <!-- Banner -->
        <div class="rs-breadcrumbs breadcrumbs-overlay">
            @if ($banner?->image_url)
                <div class="breadcrumbs-img">
                    <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}">
                </div>
            @endif
            <div class="breadcrumbs-text" style="color: {{ $banner?->title_color ?? '#ffffff' }}">
                <h1 class="page-title" style="color: {{ $banner?->title_color ?? '#ffffff' }}">
                    {{ $banner?->title ?? 'Sobre Nosotros' }}
                </h1>
                <ul style="color: {{ $banner?->title_color ?? '#ffffff' }}">
                    <li>
                        <a class="active" href="{{ route('home') }}"
                            style="color: {{ $banner?->title_color ?? '#ffffff' }}">Inicio</a>
                    </li>
                    <li style="color: {{ $banner?->title_color ?? '#ffffff' }}">Sobre Nosotros</li>
                </ul>
            </div>
        </div>
        <!-- Banner -->

        <!-- Vision -->
        @if ($company?->vision_title || $company?->vision_description)
            <div id="rs-about" class="rs-about style1 pt-100 pb-100 md-pt-70 md-pb-70">
                <div class="container">
                    <div class="row align-items-center">
                        @if ($company->vision_image_url)
                            <div class="col-lg-6 order-last padding-0 md-pl-15 md-pr-15 md-mb-30">
                                <div class="img-part">
                                    <img src="{{ $company->vision_image_url }}" alt="{{ $company->vision_title }}">
                                </div>
                            </div>
                            <div class="col-lg-6 pr-70 md-pr-15">
                            @else
                                <div class="col-12">
                        @endif
                        <div class="sec-title mb-40 md-mb-20">
                            @if ($company->vision_title)
                                <h2 class="title mb-16">{{ $company->vision_title }}</h2>
                            @endif
                            @if ($company->vision_description)
                                <div class="desc" style="text-align: justify;">{!! $company->vision_description !!}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @endif
    <!-- Vision -->

    <!-- Mision -->
    @if ($company?->mission_title || $company?->mission_description)
        <div class="rs-cta style2">
            <div class="partition-bg-wrap inner-page">
                <div class="container">
                    <div class="row y-bottom">
                        @if ($company->video_link)
                            <div class="col-lg-6 pb-50 md-pt-70 md-pb-70">
                                <div class="video-wrap">
                                    <a class="popup-videos" href="{{ $company->video_link }}">
                                        <i class="fa fa-play"></i>
                                        <h4 class="title mb-0">{{ $company->business_name }}</h4>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 pl-62 pt-134 pb-150 md-pt-50 md-pb-50 md-pl-15">
                            @else
                                <div class="col-12 pt-50 pb-50">
                        @endif
                        <div class="sec-title mb-40 md-mb-20">
                            @if ($company->mission_title)
                                <h2 class="title mb-16">{{ $company->mission_title }}</h2>
                            @endif
                            @if ($company->mission_description)
                                <div class="desc" style="text-align: justify;">{!! $company->mission_description !!}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endif
    <!-- Mision -->

    <!-- Valores -->
    @if ($values->isNotEmpty())
        <div class="rs-faq-part style1 orange-color pt-100 pb-100 md-pt-70 md-pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 padding-0">
                        <div class="main-part">
                            <div class="title mb-40 md-mb-15">
                                <h2 class="text-part">Valores</h2>
                            </div>
                            <div class="faq-content">
                                <div id="accordion" class="accordion">
                                    @foreach ($values as $index => $value)
                                        @php $collapseId = 'collapse-' . $value->id; @endphp
                                        <div class="card">
                                            <div class="card-header">
                                                <a class="card-link {{ $index > 0 ? 'collapsed' : '' }}"
                                                    data-toggle="collapse" href="#{{ $collapseId }}"
                                                    aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                                    {{ $value->title }}
                                                </a>
                                            </div>
                                            <div id="{{ $collapseId }}"
                                                class="collapse {{ $index === 0 ? 'show' : '' }}" data-parent="#accordion">
                                                <div class="card-body" style="text-align: justify;">
                                                    {!! $value->description !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($company?->video_link)
                        <div class="col-lg-6 padding-0">
                            <div class="img-part media-icon orange-color">
                                <a class="popup-videos" href="{{ $company->video_link }}">
                                    <i class="fa fa-play"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    @if ($company?->trajectory_title || $company?->trajectory_description)
        <div id="rs-about" class="rs-about style1 pt-100 pb-100 md-pt-70 md-pb-70">
            <div class="container">
                <div class="row align-items-center">
                    @if ($company->vision_image_url)
                        <div class="col-lg-6 order-last padding-0 md-pl-15 md-pr-15 md-mb-30">
                            <div class="img-part">
                                <img src="{{ $company->trajectory_image }}" alt="{{ $company->trajectory_title }}">
                            </div>
                        </div>
                        <div class="col-lg-6 pr-70 md-pr-15">
                        @else
                            <div class="col-12">
                    @endif
                    <div class="sec-title mb-40 md-mb-20">
                        @if ($company->trajectory_title)
                            <h2 class="title mb-16">{{ $company->trajectory_title }}</h2>
                        @endif
                        @if ($company->trajectory_description)
                            <div class="desc" style="text-align: justify;">{!! $company->trajectory_description !!}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Talento Humano -->
    @if ($team->isNotEmpty())
        <div id="rs-team" class="rs-team style1 inner-style orange-color pt-94 pb-100 md-pt-64 md-pb-70 gray-bg">
            <div class="container">
                <div class="sec-title mb-50 md-mb-30 text-center">
                    <div class="sub-title orange">Talento Humano</div>
                    <h2 class="title mb-0">Equipo Proinapsa</h2>
                </div>
                <div class="row">
                    @foreach ($team as $member)
                        <div class="col-lg-4 col-sm-6 mb-30">
                            <div class="team-item">
                                @if ($member->image)
                                    <a href="{{ route('team.show', $member->slug) }}">
                                        <img src="{{ Storage::url($member->image) }}" alt="{{ $member->name }}">
                                    </a>
                                @endif
                                <div class="content-part">
                                    <h4 class="name"><a
                                            href="{{ route('team.show', $member->slug) }}">{{ $member->name }}</a></h4>
                                    <span class="designation">{{ $member->position }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- Talento Humano -->

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
