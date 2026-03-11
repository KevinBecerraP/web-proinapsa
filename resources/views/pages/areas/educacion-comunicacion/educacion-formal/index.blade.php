@extends('layouts.app-secondary')

@section('title', 'Educación Formal')

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
                    Educación Formal
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
                    <li style="color: {{ $banner?->title_color ?? '#ffffff' }}">Educación Formal</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumbs End -->


        <div class="rs-about style9 pt-100 pb-100 md-pt-70 md-pb-70">
            <div class="container">
                <div class="row align-items-center">
                    @if ($area->formal_education_image)
                        <div class="col-lg-6 col-md-12 md-mb-40">
                            <div class="img-part js-tilt"
                                style="will-change: transform; transform: perspective(300px) rotateX(0deg) rotateY(0deg);">
                                <img src="{{ Storage::url($area->formal_education_image) }}" alt="Educación Formal">
                            </div>
                        </div>
                        <div class="col-lg-6 pl-100 md-pl-15 col-md-12">
                        @else
                            <div class="col-12">
                    @endif
                    <div class="content">
                        <div class="sub-title mb-20">Educación Formal</div>
                        @if ($area->formal_education_description)
                            <div class="desc mb-50" style="text-align: justify;">{!! $area->formal_education_description !!}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if ($sections->isNotEmpty())
        <div id="rs-categories" class="rs-categories gray-bg style1 pt-20 pb-70 md-pt-64 md-pb-40">
            <div class="container">
                <div class="row y-middle mb-50 md-mb-30">
                    <div class="col-md-6 sm-mb-30">
                        <div class="sec-title">
                            <div class="sub-title primary">CONTENIDO DISPONIBLE</div>
                            <h2 class="title mb-0">Accede a la información y documentos de cada sección</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($sections as $section)
                        <div class="col-lg-4 col-md-6 mb-30 wow fadeInUp" data-wow-duration="2000ms">
                            <a class="categories-item"
                                href="{{ $section->pdf_file ? Storage::url($section->pdf_file) : '#' }}"
                                @if ($section->pdf_file) target="_blank" @endif>
                                <div class="icon-part">
                                    @if ($section->image)
                                        <img src="{{ Storage::url($section->image) }}"
                                            alt="{{ $section->section_label }}">
                                    @endif
                                </div>
                                <div class="content-part">
                                    <h4 class="title">{{ $section->section_label }}</h4>
                                    @if ($section->pdf_file)
                                        <span class="courses">Ver archivo</span>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    </div>
@endsection
