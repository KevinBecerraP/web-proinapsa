@extends('layouts.app-secondary')

@section('title', 'Educación No Formal')

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
                    Educación No Formal
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
                    <li style="color: {{ $banner?->title_color ?? '#ffffff' }}">Educación No Formal</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumbs End -->

        <div class="rs-about style9 pt-100 pb-20 md-pt-70 md-pb-70">
            <div class="container">
                <div class="row align-items-center">
                    @if ($area->non_formal_education_image)
                        <div class="col-lg-6 col-md-12 md-mb-40">
                            <div class="img-part js-tilt"
                                style="will-change: transform; transform: perspective(300px) rotateX(0deg) rotateY(0deg);">
                                <img src="{{ Storage::url($area->non_formal_education_image) }}" alt="Educación No Formal">
                            </div>
                        </div>
                        <div class="col-lg-6 pl-100 md-pl-15 col-md-12">
                        @else
                            <div class="col-12">
                    @endif
                    <div class="content">
                        <div class="sub-title mb-20">Educación No Formal</div>
                        @if ($area->non_formal_education_description)
                            <div class="desc mb-50" style="text-align: justify;">{!! $area->non_formal_education_description !!}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="rs-testimonial style3 orange-color pt-90 md-pt-70">
        <div class="container">
            <div class="sec-title mb-60 md-mb-30 text-center">
                <div class="sub-title orange">Student Reviews</div>
                <h2 class="title mb-0">What Our Students Says</h2>
            </div>
        </div>
    </div>

    @if ($courses->isNotEmpty())
        <div id="rs-popular-courses" class="rs-popular-courses style3 orange-color pt-100 pb-100 md-pt-70 md-pb-70">
            <div class="container">
                <div class="row">
                    @foreach ($courses as $course)
                        <div class="col-lg-4 col-md-6 col-sm-6 mb-40">
                            <div class="courses-item">
                                <div class="img-part">
                                    @if ($course->main_image)
                                        <img src="{{ Storage::url($course->main_image) }}" alt="{{ $course->title }}">
                                    @endif
                                </div>
                                <div class="content-part">
                                    @if ($course->duration_hours)
                                        <span><a class="categories" href="#">{{ $course->duration_hours }}
                                                Horas</a></span>
                                    @endif
                                    <h3 class="title"><a href="{{ route('course.show', $course->slug) }}">{{ $course->title }}</a></h3>
                                    @if ($course->short_description)
                                        <p style="text-align: justify;">{{ $course->short_description }}</p>
                                    @endif
                                    <div class="bottom-part">
                                        <div class="btn-part">
                                            <a href="{{ route('course.show', $course->slug) }}">Ver más<i
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
