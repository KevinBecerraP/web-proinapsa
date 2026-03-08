@extends('layouts.app-secondary')

@section('title', $newsItem->title)

@section('content')

    <div class="main-content">
        <!-- Breadcrumbs Start -->
        <div class="rs-breadcrumbs breadcrumbs-overlay">
            <div class="breadcrumbs-img">
                <img src="{{ $banner?->image_url }}" alt="{{ $banner?->title }}">
            </div>
            <div class="breadcrumbs-text" style="color: {{ $banner?->title_color ?? '#ffffff' }}">
                <h1 class="page-title" style="color: {{ $banner?->title_color ?? '#ffffff' }}">
                    {{ $banner?->title ?? 'Noticias' }}
                </h1>
                <ul style="color: {{ $banner?->title_color ?? '#ffffff' }}">
                    <li>
                        <a class="active" href="{{ route('home') }}" style="color: {{ $banner?->title_color ?? '#ffffff' }}">Home</a>
                    </li>
                    <li><a href="{{ route('news.index') }}" style="color: {{ $banner?->title_color ?? '#ffffff' }}">Noticias</a></li>
                    <li style="color: {{ $banner?->title_color ?? '#ffffff' }}">{{ $newsItem->title }}</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumbs End -->

        <!-- Blog Section Start -->
        <div class="rs-inner-blog orange-color pt-100 pb-100 md-pt-70 md-pb-70">
            <div class="container">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-lg-4 col-md-12 order-last">
                        <div class="widget-area">
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
                                                {{ $recent->created_at->format('d/m/Y') }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar End -->

                    <!-- Contenido noticia -->
                    <div class="col-lg-8 pr-50 md-pr-15">
                        <div class="blog-deatails">
                            <div class="bs-img">
                                <img src="{{ Storage::url($newsItem->image) }}" alt="{{ $newsItem->title }}">
                            </div>
                            <div class="blog-full">
                                <ul class="single-post-meta">
                                    <li>
                                        <span class="p-date">
                                            <i class="fa fa-calendar-check-o"></i>
                                            {{ $newsItem->created_at->format('d/m/Y') }}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="p-date">
                                            <i class="fa fa-user-o"></i> {{ $newsItem->createdBy?->name ?? '—' }}
                                        </span>
                                    </li>
                                </ul>
                                <h2 class="title mb-30">{{ $newsItem->title }}</h2>
                                <div class="blog-desc" style="text-align: justify;">
                                    {!! $newsItem->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Contenido noticia End -->
                </div>
            </div>
        </div>
        <!-- Blog Section End -->
    </div>

@endsection
