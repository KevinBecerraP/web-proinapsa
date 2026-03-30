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
                    @if ($company?->values_image)
                        <div class="col-lg-6 padding-0">
                            <div class="img-part media-icon orange-color"
                                style="background-image: url('{{ Storage::url($company->values_image) }}');">
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
                                <img src="{{ Storage::url($company->trajectory_image) }}"
                                    alt="{{ $company->trajectory_title }}">
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

@endsection
