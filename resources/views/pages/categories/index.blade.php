@extends('layouts.app-secondary')

@section('title', 'Repositorio')

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
                    {{ $banner?->title ?? 'Repositorio' }}
                </h1>
                <ul style="color: {{ $banner?->title_color ?? '#ffffff' }}">
                    <li>
                        <a class="active" href="{{ route('home') }}"
                            style="color: {{ $banner?->title_color ?? '#ffffff' }}">Inicio</a>
                    </li>
                    <li style="color: {{ $banner?->title_color ?? '#ffffff' }}">Repositorio</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumbs End -->

        <div class="rs-degree style1 modify gray-bg pt-100 pb-70 md-pt-70 md-pb-40">
            <div class="container">
                <div class="row y-middle">
                    <div class="col-lg-4 col-md-6 mb-30">
                        <div class="sec-title wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms">
                            <div class="sub-title primary">Categorías del repositorio</div>
                            <h2 class="title mb-0">Explora Todos Los Recursos Que Tenemos Disponibles Aquí</h2>
                        </div>
                    </div>
                    @forelse($categories as $category)
                        <div class="col-lg-4 col-md-6 mb-30">
                            <div class="degree-wrap">
                                <img src="{{ Storage::url($category->image) }}" alt="{{ $category->title }}">
                                <div class="title-part">
                                    <h4 class="title">{{ $category->title }}</h4>
                                </div>
                                <div class="content-part">
                                    <h4 class="title">
                                        <a href="{{ route('repository.show', $category->slug) }}">{{ $category->title }}</a>
                                    </h4>
                                    @if ($category->description)
                                        <p class="desc">{{ Str::limit($category->description, 100) }}</p>
                                    @endif
                                    <div class="btn-part">
                                        <a href="{{ route('repository.show', $category->slug) }}">Ver documentos</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p>No hay categorías disponibles.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

@endsection
