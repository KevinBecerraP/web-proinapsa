@extends('layouts.app-secondary')

@section('title', 'Noticias')

@section('content')

    <div class="main-content">
        <!-- Breadcrumbs Start -->
        <div class="rs-breadcrumbs breadcrumbs-overlay">
            @if($banner?->image_url)
            <div class="breadcrumbs-img">
                <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}">
            </div>
            @endif
            <div class="breadcrumbs-text" style="color: {{ $banner?->title_color ?? '#ffffff' }}">
                <h1 class="page-title" style="color: {{ $banner?->title_color ?? '#ffffff' }}">
                    {{ $banner?->title ?? 'Noticias' }}
                </h1>
                <ul style="color: {{ $banner?->title_color ?? '#ffffff' }}">
                    <li>
                        <a class="active" href="{{ route('home') }}" style="color: {{ $banner?->title_color ?? '#ffffff' }}">Inicio</a>
                    </li>
                    <li style="color: {{ $banner?->title_color ?? '#ffffff' }}">Noticias</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumbs End -->


        <!-- Blog Section Start -->
        <div class="rs-inner-blog orange-color pt-100 pb-100 md-pt-70 md-pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 order-last">
                        <div class="widget-area">
                            @if($recentNews->isNotEmpty())
                            <div class="recent-posts-widget mb-50">
                                <h3 class="widget-title">Noticias Recientes</h3>
                                @foreach ($recentNews as $recent)
                                    <div class="show-featured">
                                        <div class="post-img">
                                            <a href="{{ route('news.show', $recent->id) }}">
                                                <img src="{{ Storage::url($recent->image) }}" alt="{{ $recent->title }}">
                                            </a>
                                        </div>
                                        <div class="post-desc">
                                            <a href="{{ route('news.show', $recent->id) }}">{{ $recent->title }}</a>
                                            <span class="date">
                                                <i class="fa fa-calendar"></i>
                                                {{ $recent->created_at->format('d / m / Y') }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-8 pr-50 md-pr-15">
                        <div class="row">
                            @forelse($news as $item)
                                <div class="col-lg-12 {{ !$loop->last ? 'mb-70' : '' }}">
                                    <div class="blog-item">
                                        <div class="blog-img">
                                            <a href="{{ route('news.show', $item->id) }}">
                                                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}">
                                            </a>
                                        </div>
                                        <div class="blog-content">
                                            <h3 class="blog-title">
                                                <a href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a>
                                            </h3>
                                            <div class="blog-meta">
                                                <ul class="btm-cate">
                                                    <li>
                                                        <div class="blog-date">
                                                            <i class="fa fa-calendar-check-o"></i>
                                                            {{ $item->created_at->format('d/m/Y') }}
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="author">
                                                            <i class="fa fa-user-o"></i>
                                                            {{ $item->createdBy?->name ?? '—' }}
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="blog-desc">
                                                {{ $item->excerpt }}
                                            </div>
                                            <div class="blog-button">
                                                <a class="blog-btn" href="{{ route('news.show', $item->id) }}">Leer
                                                    más</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-lg-12">
                                    <p>No hay noticias disponibles.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Blog Section End -->
    </div>

@endsection
