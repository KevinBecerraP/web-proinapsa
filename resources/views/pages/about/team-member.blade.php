@extends('layouts.app-secondary')

@section('title', $member->name)

@section('content')
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
                    <li>
                        <a href="{{ route('about-us') }}"
                            style="color: {{ $banner?->title_color ?? '#ffffff' }}">Sobre Nosotros</a>
                    </li>
                    <li style="color: {{ $banner?->title_color ?? '#ffffff' }}">{{ $member->name }}</li>
                </ul>
            </div>
        </div>
        <!-- Banner -->

        <!-- Team Member Detail -->
        <div class="rs-team-single pt-120 pb-120 md-pt-80 md-pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 md-mb-50">
                        @if ($member->image_url)
                            <div class="team-img">
                                <img src="{{ $member->image_url }}" alt="{{ $member->name }}" class="img-fluid w-100">
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-8 pl-50 md-pl-15">
                        <div class="team-content">
                            <h2 class="name">{{ $member->name }}</h2>
                            @if ($member->profesion)
                                <span class="profession">{{ $member->profesion }}</span>
                            @endif
                            @if ($member->position)
                                <span class="designation">{{ $member->position }}</span>
                            @endif
                            @if ($member->description)
                                <div class="description mt-30">
                                    {!! nl2br(e($member->description)) !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team Member Detail -->
    </div>
@endsection