@extends('layouts.app-secondary')

@section('title', 'Investigación')

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
        <div id="rs-about" class="rs-about style1 pb-30 md-pb-70">
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

    <div id="rs-popular-courses" class="rs-popular-courses style3 orange-color pt-30 pb-100 md-pt-70 md-pb-70">
        <div class="container">
            <div class="gridFilter text-center mb-50">
                <button class="active" onclick="showSection('publicaciones', this)">PUBLICACIONES</button>
                <button class="" onclick="showSection('grupo-investigacion', this)">GRUPO DE INVESTIGACION</button>
            </div>

            {{-- PUBLICACIONES --}}
            <div id="section-publicaciones">
                <div class="row">
                    @foreach ($publications as $publication)
                        <div class="col-lg-4 col-md-6 col-sm-6 mb-40">
                            <div class="courses-item">
                                <div class="img-part">
                                    @if ($publication->image)
                                        <img src="{{ Storage::url($publication->image) }}"
                                            alt="{{ $publication->title }}">
                                    @endif
                                </div>
                                <div class="content-part">
                                    <h3 class="title">{{ $publication->title }}</h3>
                                    @if ($publication->short_description)
                                        <p style="text-align: justify;">{{ $publication->short_description }}</p>
                                    @endif
                                    <div class="bottom-part">
                                        <div class="btn-part">
                                            <a href="{{ $publication->external_link ?? '#' }}" target="_blank">Ver más<i
                                                    class="flaticon-right-arrow"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- GRUPO DE INVESTIGACIÓN --}}
            <div id="section-grupo-investigacion" style="display: none;">
                @if ($area->researchGroup)
                    @php $group = $area->researchGroup; @endphp
                    <div class="rs-faq-part style1 orange-color">
                        <div class="row">
                            <div class="col-lg-12 padding-0">
                                <div class="main-part">
                                    <div class="title mb-40 md-mb-15">
                                        <h2 class="text-part">{{ $group->name }}</h2>
                                        @if ($group->description)
                                            <p style="text-align: justify;">{!! $group->description !!}</p>
                                        @endif
                                    </div>
                                    <div class="title mb-40 md-mb-15">
                                        <h2 class="text-part">Lineas de investigación</h2>
                                    </div>

                                    @if ($group->researchLines->isNotEmpty())
                                        <div class="faq-content">
                                            <div id="accordion" class="accordion">
                                                @foreach ($group->researchLines as $index => $line)
                                                    @php
                                                        $collapseId = 'collapse-' . $line->id;
                                                    @endphp
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <a class="card-link {{ $index > 0 ? 'collapsed' : '' }}"
                                                                data-toggle="collapse" href="#{{ $collapseId }}"
                                                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                                                {{ $line->title }}
                                                            </a>
                                                        </div>
                                                        <div id="{{ $collapseId }}"
                                                            class="collapse {{ $index === 0 ? 'show' : '' }}"
                                                            data-parent="#accordion">
                                                            <div class="card-body" style="text-align: justify;">
                                                                {!! $line->description !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <script>
        function showSection(section, btn) {
            document.querySelectorAll('.gridFilter button').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            document.getElementById('section-publicaciones').style.display = section === 'publicaciones' ? '' : 'none';
            document.getElementById('section-grupo-investigacion').style.display = section === 'grupo-investigacion' ? '' :
                'none';
        }
    </script>

    </div>



@endsection
