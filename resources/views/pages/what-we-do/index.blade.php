@extends('layouts.app-secondary')

@section('title', 'Que hacemos')

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
                    {{ $banner?->title ?? 'Que hacemos' }}
                </h1>
                <ul style="color: {{ $banner?->title_color ?? '#ffffff' }}">
                    <li>
                        <a class="active" href="{{ route('home') }}"
                            style="color: {{ $banner?->title_color ?? '#ffffff' }}">Inicio</a>
                    </li>
                    <li style="color: {{ $banner?->title_color ?? '#ffffff' }}">Que hacemos</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumbs End -->

        <!-- Methodology Start -->
        @if ($company?->methodology_title || $company?->methodology_description)
            <div class="rs-about style9 pt-100 pb-100 md-pt-70 md-pb-70">
                <div class="container">
                    <div class="row align-items-center">
                        @if ($company->methodology_image)
                            <div class="col-lg-6 col-md-12 md-mb-40">
                                <div class="img-part js-tilt"
                                    style="will-change: transform; transform: perspective(300px) rotateX(0deg) rotateY(0deg);">
                                    <img src="{{ Storage::url($company->methodology_image) }}"
                                        alt="{{ $company->methodology_title }}">
                                </div>
                            </div>
                            <div class="col-lg-6 pl-100 md-pl-15 col-md-12">
                            @else
                                <div class="col-12">
                        @endif
                        <div class="content">
                            <div class="sub-title mb-20">Metodología</div>
                            @if ($company->methodology_title)
                                <h2 class="sl-title mb-40 md-mb-20">{{ $company->methodology_title }}</h2>
                            @endif
                            @if ($company->methodology_description)
                                <div class="desc mb-50" style="text-align: justify;">{!! $company->methodology_description !!}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- Areas Start -->
        @if ($areas->isNotEmpty())
            @php
                $areaRoutes = [
                    'educacion-comunicacion' => route('area.educacion-comunicacion'),
                    'investigacion'          => route('area.investigacion'),
                    'proyeccion-social'      => route('area.proyeccion-social'),
                ];
            @endphp
            <div class="rs-degree style1 modify gray-bg pt-100 pb-70 md-pt-70 md-pb-40">
                <div class="container">
                    <div class="row y-middle">
                        @foreach ($areas as $area)
                            @php $areaUrl = $areaRoutes[$area->slug] ?? '#'; @endphp
                            <div class="col-lg-4 col-md-6 mb-30">
                                <div class="degree-wrap">
                                    @if ($area->image)
                                        <img src="{{ Storage::url($area->image) }}" alt="{{ $area->name }}">
                                    @endif
                                    <div class="title-part">
                                        <h4 class="title">{{ $area->name }}</h4>
                                    </div>
                                    <div class="content-part">
                                        <h4 class="title" style="color: #ffffff;">{{ $area->name }}</h4>
                                        @if ($area->description)
                                            <p class="desc">{{ Str::limit(strip_tags($area->description), 100) }}</p>
                                        @endif
                                        <a href="{{ $areaUrl }}" class="readon">Ver más</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <!-- Areas End -->
    </div>

@endsection
