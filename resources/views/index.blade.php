@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <!-- Slider Section Start -->
    <div class="rs-slider main-home">
        <div class="rs-carousel owl-carousel" data-loop="true" data-items="1" data-margin="0" data-autoplay="true"
            data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="false" data-nav="false"
            data-nav-speed="false" data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="false"
            data-mobile-device-dots="false" data-ipad-device="1" data-ipad-device-nav="false" data-ipad-device-dots="false"
            data-ipad-device2="1" data-ipad-device-nav2="false" data-ipad-device-dots2="false" data-md-device="1"
            data-md-device-nav="true" data-md-device-dots="false">
            @foreach ($banners as $banner)
                <div class="slider-content"
                    style="background-image: url('{{ $banner->image_url }}'); background-size: cover; background-position: center;">
                    <div class="container">
                        <div class="content-part">
                            @if ($banner->subtitle)
                                <div class="sl-sub-title wow bounceInLeft" data-wow-delay="300ms" data-wow-duration="2000ms"
                                    style="color: {{ $banner->subtitle_color ?? '#ffffff' }}">
                                    {{ $banner->subtitle }}
                                </div>
                            @endif
                            @if ($banner->title)
                                <h1 class="sl-title wow fadeInRight" data-wow-delay="600ms" data-wow-duration="2000ms"
                                    style="color: {{ $banner->title_color ?? '#ffffff' }}">
                                    {{ $banner->title }}
                                </h1>
                            @endif
                            @if ($banner->button_link)
                                <div class="sl-btn wow fadeInUp" data-wow-delay="900ms" data-wow-duration="2000ms">
                                    <a class="readon orange-btn main-home" href="{{ $banner->button_link }}"
                                        @if ($banner->button_color) style="background-color: {{ $banner->button_color }}; border-color: {{ $banner->button_color }}" @endif>
                                        Ver más
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Features Section start -->
        <div id="rs-features" class="rs-features main-home">
            <div class="container">
                <div class="row">
                    @foreach ($areas as $index => $area)
                        <div class="col-lg-4 col-md-12 {{ $index < $areas->count() - 1 ? 'md-mb-30' : '' }}">
                            <a href="{{ route('area.' . $area->slug) }}" style="text-decoration: none; color: inherit;">
                                <div class="features-wrap">
                                    <div class="icon-part">
                                        @if ($area->logo)
                                            <img src="{{ Storage::url($area->logo) }}" alt="{{ $area->name }}">
                                        @elseif ($area->icon)
                                            <img src="{{ Storage::url($area->icon) }}" alt="{{ $area->name }}">
                                        @endif
                                    </div>
                                    <div class="content-part">
                                        <h4 class="title">
                                            <span class="watermark">{{ $area->name }}</span>
                                        </h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
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
                @foreach ($homeCards as $index => $card)
                    @php $delay = ($index + 1) * 300; @endphp
                    <div class="col-lg-4 {{ !$loop->last ? 'md-mb-30' : '' }}">
                        <div class="service-item wow fadeInUp" data-wow-delay="{{ $delay }}ms"
                            data-wow-duration="2000ms">
                            <div class="content-part">
                                @if ($card->icon)
                                    <span class="icon-part"><img src="{{ Storage::url($card->icon) }}"
                                            alt="{{ $card->title }}"></span>
                                @endif
                                <h4 class="title"><a href="{{ $card->link ?? '#' }}">{{ $card->title }}</a></h4>
                                @if ($card->description)
                                    <p class="desc">{{ $card->description }}</p>
                                @endif
                                @if ($card->link)
                                    <a class="service-btn" href="{{ $card->link }}" target="_blank">
                                        {{ $card->button_text ?? 'Ver más' }} <i class="fa fa-arrow-right"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Services Section End -->

    @if ($latestNews->isNotEmpty())
        <div id="rs-blog" class="rs-blog main-home pb-100 pt-100 md-pt-70 md-pb-70">
            <div class="container">
                <div class="sec-title3 text-center mb-50">
                    <div class="sub-title">Noticias</div>
                    <h2 class="title">Últimas Noticias</h2>
                </div>
                <div class="rs-carousel owl-carousel" data-loop="true" data-items="3" data-margin="30" data-autoplay="true"
                    data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="false"
                    data-nav="false" data-nav-speed="false" data-center-mode="false" data-mobile-device="1"
                    data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="2"
                    data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="1"
                    data-ipad-device-nav2="false" data-ipad-device-dots2="false" data-md-device="3"
                    data-md-device-nav="false" data-md-device-dots="false">
                    @foreach ($latestNews as $news)
                        <div class="blog-item">
                            <div class="image-part">
                                @if ($news->image)
                                    <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}">
                                @endif
                            </div>
                            <div class="blog-content">
                                <ul class="blog-meta">
                                    <li><i class="fa fa-calendar"></i> {{ $news->created_at->format('d M, Y') }}</li>
                                </ul>
                                <h3 class="title"><a href="{{ route('news.show', $news->id) }}">{{ $news->title }}</a>
                                </h3>
                                @if ($news->excerpt)
                                    <div class="desc">{{ Str::limit($news->excerpt, 100) }}</div>
                                @endif
                                <div class="btn-btm">
                                    <div class="rs-view-btn">
                                        <a href="{{ route('news.show', $news->id) }}">Ver más</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach






                </div>
            </div>
        </div>
    @endif

    <!-- Testimonial Section Start -->
    @if ($testimonials->isNotEmpty())
        <div class="rs-testimonial style3 mb-60">
            <div class="container">
                <div class="sec-title mb-60 text-center md-mb-30">
                    <div class="sub-title primary">Testimonios</div>
                    <h2 class="title mb-0">Lo que dicen sobre nosotros</h2>
                </div>
                <div class="rs-carousel owl-carousel" data-loop="true" data-items="2" data-margin="30"
                    data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800"
                    data-dots="true" data-nav="false" data-nav-speed="false" data-center-mode="false"
                    data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="false"
                    data-ipad-device="2" data-ipad-device-nav="false" data-ipad-device-dots="false"
                    data-ipad-device2="1" data-ipad-device-nav2="false" data-ipad-device-dots2="false"
                    data-md-device="2" data-md-device-nav="false" data-md-device-dots="true">
                    @foreach ($testimonials as $testimonial)
                        <div class="testi-item">
                            <div class="row y-middle no-gutter">
                                <div class="col-md-4">
                                    <div class="user-info">
                                        <h4 class="name">{{ $testimonial->name }}</h4>
                                        <span class="designation">{{ $testimonial->profile }}</span>
                                        @if ($testimonial->rating)
                                            <ul class="ratings">
                                                @for ($i = 0; $i < $testimonial->rating; $i++)
                                                    <li><i class="fa fa-star"></i></li>
                                                @endfor
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="desc">{{ $testimonial->testimonial }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- Testimonial Section End -->


    @if ($partners->isNotEmpty())
        <div class="rs-partner pt-100 pb-100 md-pt-70 md-pb-70 gray-bg">
            <div class="container">
                <div class="rs-carousel owl-carousel" data-loop="true" data-items="5" data-margin="30"
                    data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800"
                    data-dots="false" data-nav="false" data-nav-speed="false" data-center-mode="false"
                    data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="false"
                    data-ipad-device="3" data-ipad-device-nav="false" data-ipad-device-dots="false"
                    data-ipad-device2="2" data-ipad-device-nav2="false" data-ipad-device-dots2="false"
                    data-md-device="5" data-md-device-nav="false" data-md-device-dots="false">
                    @foreach ($partners as $partner)
                        <div class="partner-item">
                            <a href="{{ $partner->url ?? '#' }}" {{ $partner->url ? 'target="_blank"' : '' }}>
                                @if ($partner->image)
                                    <img src="{{ Storage::url($partner->image) }}" alt="{{ $partner->name }}">
                                @endif
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection
