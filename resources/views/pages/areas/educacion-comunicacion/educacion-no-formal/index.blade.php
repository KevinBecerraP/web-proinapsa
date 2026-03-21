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

    <div id="rs-popular-courses" class="rs-popular-courses style6 gray-bg4 pt-40 pb-100 md-pt-70 md-pb-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-50">
                    <div class="sec-title6">
                        <span class="sub-title pb-10">Materiales Educativos</span>
                        <h2 class="title title2">Explora nuestro material de aprendizaje</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="gridFilter style2 modify1 mb-10" id="materialFilter">
                        <button class="active" data-filter="*">Todos</button>
                        <button data-filter="filter1" class="">Primera Infancia</button>
                        <button data-filter="filter2" class="">Escolar y adolescencia</button>
                    </div>
                </div>
            </div>
            <div class="row d-flex align-items-stretch" id="materialsGrid">
                @foreach ($materials as $material)
                    @php
                        $filterClass = $material->category === 'early_childhood' ? 'filter1' : 'filter2';
                    @endphp
                    <div class="col-lg-3 col-md-6 material-item {{ $filterClass }} mb-30">
                        <div class="courses-item mb-30" style="height: 100%; display: flex; flex-direction: column;">
                            <div class="img-part">
                                <a href="#">
                                    @if ($material->main_image)
                                        <img src="{{ Storage::url($material->main_image) }}" alt="{{ $material->title }}">
                                    @endif
                                </a>
                            </div>
                            <div class="content-part"
                                style="padding: 20px !important; display: flex; flex-direction: column; flex: 1;">
                                <h3 class="title">{{ $material->title }}</h3>
                                @if ($material->short_description)
                                    <p class="desc" style="text-align: justify;">{{ $material->short_description }}</p>
                                @endif
                                @if ($material->pdf_file)
                                    <a href="{{ Storage::url($material->pdf_file) }}" target="_blank" class="readon"
                                        style="margin-top: auto;">Ver documento</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('#materialFilter button').forEach(function(btn) {
            btn.addEventListener('click', function() {
                document.querySelectorAll('#materialFilter button').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                var filter = this.getAttribute('data-filter');
                document.querySelectorAll('#materialsGrid .material-item').forEach(function(item) {
                    if (filter === '*' || item.classList.contains(filter)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>

@endsection
