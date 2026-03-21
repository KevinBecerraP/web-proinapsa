@extends('layouts.app-secondary')

@section('title', $course->title)

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
                    {{ $course->title }}
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
                    <li>
                        <a href="{{ route('area.educacion-comunicacion') }}"
                            style="color: {{ $banner?->title_color ?? '#ffffff' }}">Educación y Comunicación</a>
                    </li>
                    <li>
                        <a href="{{ route('area.educacion-no-formal') }}"
                            style="color: {{ $banner?->title_color ?? '#ffffff' }}">Educación No Formal</a>
                    </li>
                    <li style="color: {{ $banner?->title_color ?? '#ffffff' }}">{{ $course->title }}</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumbs End -->



        <div id="rs-single-shop" class="rs-single-shop shop-rp orange-color pt-100 pb-100 md-pt-70 md-pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-12 sm-mb-30">
                        @if ($course->main_image)
                            <img src="{{ Storage::url($course->gallery_image_1) }}" alt="{{ $course->title }}"
                                style="width: 100%;">
                        @endif
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="single-price-info pl-30">
                            <h4 class="product-title">{{ $course->title }}</h4>
                            @if ($course->duration_hours)
                                <span class="single-price">{{ $course->duration_hours }} Horas</span>
                            @endif
                            @if ($course->short_description)
                                <p class="some-text" style="text-align: justify;">{!! $course->full_description !!}</p>
                            @endif
                            @if ($course->registration_link)
                                <a href="{{ $course->registration_link }}" target="_blank"
                                    class="btn-shop orange-color">Inscribirse</a>
                            @endif
                            @if ($course->pdf_file)
                                <a href="{{ Storage::url($course->pdf_file) }}" target="_blank"
                                    class="btn-shop orange-color">Ver documento</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($related->isNotEmpty())
        <div id="rs-popular-courses" class="rs-popular-courses style3 orange-color gray-bg pt-100 pb-100 md-pt-70 md-pb-70">
            <div class="container">
                <div class="row mb-50">
                    <div class="col-12">
                        <div class="sec-title">
                            <h2 class="title mb-0">Otros cursos</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($related as $item)
                        <div class="col-lg-4 col-md-6 col-sm-6 mb-40">
                            <div class="courses-item">
                                <div class="img-part">
                                    @if ($item->main_image)
                                        <img src="{{ Storage::url($item->main_image) }}" alt="{{ $item->title }}">
                                    @endif
                                </div>
                                <div class="content-part">
                                    @if ($item->duration_hours)
                                        <span><a class="categories" href="#">{{ $item->duration_hours }}
                                                Horas</a></span>
                                    @endif
                                    <h3 class="title">{{ $item->title }}</h3>
                                    <div class="bottom-part">
                                        <div class="btn-part">
                                            <a href="{{ route('course.show', $item->slug) }}">Ver más<i
                                                    class="flaticon-right-arrow"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

@endsection
