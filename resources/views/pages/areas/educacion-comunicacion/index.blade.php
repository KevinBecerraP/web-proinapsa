@extends('layouts.app-secondary')

@section('title', 'Areas - Educación y Comunicación')

@section('content')
    <div class="main-content">
        <!-- Breadcrumbs Start -->
        <div class="rs-breadcrumbs breadcrumbs-overlay">
            @if ($banner?->image_url)
                <div class="breadcrumbs-img">
                    <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}">
                </div>
            @endif
            <div class="breadcrumbs-text" style="color: {{ $banner?->title_color ?? '#ffffff' }}">
                <h1 class="page-title" style="color: {{ $banner?->title_color ?? '#ffffff' }}">
                    {{ $banner?->title ?? $area->name }}
                </h1>
                <ul style="color: {{ $banner?->title_color ?? '#ffffff' }}">
                    <li>
                        <a class="active" href="{{ route('home') }}"
                            style="color: {{ $banner?->title_color ?? '#ffffff' }}">Inicio</a>
                    </li>
                    <li>
                        <a href="{{ route('what-we-do.index') }}"
                            style="color: {{ $banner?->title_color ?? '#ffffff' }}">Que hacemos</a>
                    </li>
                    <li style="color: {{ $banner?->title_color ?? '#ffffff' }}">{{ $area->name }}</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumbs End -->

        @if ($area->image || $area->description)
            <div class="rs-about style9 pt-100 pb-100 md-pt-70 md-pb-70">
                <div class="container">
                    <div class="row align-items-center">
                        @if ($area->image)
                            <div class="col-lg-6 col-md-12 md-mb-40">
                                <div class="img-part js-tilt"
                                    style="will-change: transform; transform: perspective(300px) rotateX(0deg) rotateY(0deg);">
                                    <img src="{{ Storage::url($area->image) }}" alt="{{ $area->name }}">
                                </div>
                            </div>
                            <div class="col-lg-6 pl-100 md-pl-15 col-md-12">
                            @else
                                <div class="col-12">
                        @endif
                        <div class="content">
                            <div class="sub-title mb-20">Área</div>
                            <h2 class="sl-title mb-40 md-mb-20">{{ $area->name }}</h2>
                            @if ($area->description)
                                <div class="desc mb-50" style="text-align: justify;">{!! $area->description !!}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @endif

    @if ($area->coordinator)
        @php $coordinator = $area->coordinator; @endphp
        <div id="rs-about" class="rs-about style1 pb-100 md-pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 pr-50 md-pr-15">
                        <div class="about-part">
                            <div class="sec-title mb-40">
                                <div class="sub-title primary wow fadeInUp" data-wow-delay="300ms"
                                    data-wow-duration="2000ms">
                                    {{ $coordinator->profesion }}
                                </div>
                                <h2 class="title wow fadeInUp" data-wow-delay="400ms" data-wow-duration="2000ms">
                                    Explora parte de mi recorrido profesional
                                </h2>
                                @if ($coordinator->description)
                                    <div class="desc wow fadeInUp" data-wow-delay="500ms" data-wow-duration="2000ms"
                                        style="text-align: justify;">
                                        {!! $coordinator->description !!}
                                    </div>
                                @endif
                            </div>
                            <div class="sign-part wow fadeInUp" data-wow-delay="600ms" data-wow-duration="2000ms">
                                @if ($coordinator->image_url)
                                    <div class="img-part">
                                        <img src="{{ $coordinator->image_url }}" alt="{{ $coordinator->name }}"
                                            style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                                    </div>
                                @endif
                                <div class="author-part">
                                    <span class="sign mb-10"
                                        style="font-size: 16px; font-weight: 600;">{{ $coordinator->name }}</span>
                                    <span class="post" style="font-size: 13px;">{{ $coordinator->position }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="rs-event modify1 orange-color pt-20 pb-100 md-pt-70 md-pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-30 col-md-6">
                    <div class="event-item">
                        <div class="event-short">
                            <div class="featured-img">
                                <img src="{{ Storage::url($area->formal_education_image) }}"
                                    alt="{{ $area->formal_education_image }}">
                                <div class="dates">
                                    <a href="{{ route('area.educacion-formal') }}" style="color: inherit;">Ver más</a>
                                </div>
                            </div>
                            <div class="content-part">
                                <h4 class="title"><a href="{{ route('area.educacion-formal') }}">Educación Formal</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-30 col-md-6">
                    <div class="event-item">
                        <div class="event-short">
                            <div class="featured-img">
                                <img src="{{ Storage::url($area->non_formal_education_image) }}"
                                    alt="{{ $area->non_formal_education_image }}">
                                <div class="dates">
                                    <a href="{{ route('area.educacion-no-formal') }}" style="color: inherit;">Ver más</a>
                                </div>
                            </div>
                            <div class="content-part">
                                <h4 class="title"><a href="{{ route('area.educacion-no-formal') }}">Educación No
                                        Formal</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-30 col-md-6">
                    <div class="event-item">
                        <div class="event-short">
                            <div class="featured-img">
                                <img src="{{ Storage::url($area->educational_materials_image) }}"
                                    alt="{{ $area->educational_materials_image }}">
                                <div class="dates">
                                    Ver más
                                </div>
                            </div>
                            <div class="content-part">
                                <h4 class="title"><a href="#">Materiales de Educación y Comunicación</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
