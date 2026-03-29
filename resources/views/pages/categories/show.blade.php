@extends('layouts.app-secondary')

@section('title', $category->title . ' - Repositorio')

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
                    {{ $category->title }}
                </h1>
                <ul style="color: {{ $banner?->title_color ?? '#ffffff' }}">
                    <li>
                        <a class="active" href="{{ route('home') }}"
                            style="color: {{ $banner?->title_color ?? '#ffffff' }}">Inicio</a>
                    </li>
                    <li>
                        <a href="{{ route('repository.index') }}"
                            style="color: {{ $banner?->title_color ?? '#ffffff' }}">Repositorio</a>
                    </li>
                    <li style="color: {{ $banner?->title_color ?? '#ffffff' }}">{{ $category->title }}</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumbs End -->

        <!-- Category Info Start -->
        @if ($category->image || $category->description)
            <div class="rs-about style9 pt-100 pb-60 md-pt-70 md-pb-70">
                <div class="container">
                    <div class="row align-items-start">
                        @if ($category->image)
                            <div class="col-lg-4 col-md-12 md-mb-40">
                                <div class="img-part js-tilt"
                                    style="will-change: transform; transform: perspective(300px) rotateX(0deg) rotateY(0deg);">
                                    <img src="{{ Storage::url($category->image) }}" alt="{{ $category->title }}">
                                </div>
                            </div>
                            <div class="col-lg-8 pl-100 md-pl-15 col-md-12">
                            @else
                                <div class="col-12">
                        @endif
                        <div class="content">
                            <div class="sub-title mb-20">Repositorio</div>
                            <h2 class="sl-title mb-40 md-mb-20">{{ $category->title }}</h2>
                            @if ($category->description)
                                <p class="desc mb-50" style="text-align: justify;">{{ $category->description }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- Documents Start -->
        <div id="rs-documents" class="rs-categories home9-style event-bg pt-40 pb-100 md-pt-70 md-pb-70">
            <div class="container">
                <div class="sec-title3 text-center mb-45">
                    <div class="sub-title yellow-color">{{ $category->title }}</div>
                    <h2 class="title black-color">Documentos disponibles</h2>
                </div>
                <div class="row">
                    @forelse($documents as $document)
                        <div class="col-lg-4 col-md-6 mb-30">
                            <div class="categories-items">
                                @if ($document->image)
                                    <div class="images-part">
                                        <img src="{{ Storage::url($document->image) }}" alt="{{ $document->title }}">
                                    </div>
                                @endif
                                <div class="image-content">
                                    <div class="title">{{ $document->title }}</div>
                                    @if ($document->authors)
                                        <div class="desc" style="font-size: 13px; color: #666; margin-top: 6px;">
                                            <i class="fa fa-user-o"></i> {{ $document->authors }}
                                        </div>
                                    @endif
                                    @if ($document->topic)
                                        <div class="desc" style="font-size: 13px; color: #666; margin-top: 4px;">
                                            <i class="fa fa-tag"></i> {{ $document->topic }}
                                        </div>
                                    @endif
                                    @if ($document->description)
                                        <div class="description mt-10">
                                            <p>{{ Str::limit($document->description, 120) }}</p>
                                        </div>
                                    @endif
                                    @if ($document->document)
                                        <div class="button-bottom mt-15">
                                            <div class="button-effect">
                                                <a href="{{ Storage::url($document->document) }}" target="_blank">
                                                    Ver documento
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>No hay documentos disponibles en esta categoría.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- Documents End -->
    </div>

@endsection
