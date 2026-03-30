@extends('layouts.app-secondary')

@section('title', 'Contáctanos')

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
                    {{ $banner?->title ?? 'Contáctanos' }}
                </h1>
                <ul style="color: {{ $banner?->title_color ?? '#ffffff' }}">
                    <li>
                        <a class="active" href="{{ route('home') }}"
                            style="color: {{ $banner?->title_color ?? '#ffffff' }}">Inicio</a>
                    </li>
                    <li style="color: {{ $banner?->title_color ?? '#ffffff' }}">Contáctanos</li>
                </ul>
            </div>
        </div>
        <!-- Banner -->

        <div class="contact-page-section pt-100 pb-100 md-pt-70 md-pb-70">
            <div class="container">
                @if ($company?->latitude && $company?->longitude)
                    <div class="rs-contact-img mb-90">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="contact-map3">
                                    <iframe
                                        src="https://maps.google.com/maps?q={{ $company->latitude }},{{ $company->longitude }}&z=15&output=embed"
                                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @php
                    $emails = array_values(array_filter([$company?->email_1, $company?->email_2, $company?->email_3]));
                    $phones = array_values(array_filter([$company?->phone_1, $company?->phone_2, $company?->phone_3, $company?->phone_4, $company?->phone_5]));
                    $blocks = array_filter([count($emails), count($phones), $company?->address ? 1 : 0]);
                    $colClass = count($blocks) === 3 ? 'col-lg-4' : (count($blocks) === 2 ? 'col-lg-6' : 'col-lg-12');
                @endphp

                <div class="row mb-90 md-mb-50">
                    @if ($emails)
                        <div class="{{ $colClass }} col-md-12 md-mb-30">
                            <div class="rs-contact-wrap">
                                <div class="inner-part text-center">
                                    <h2 class="title2">Correos</h2>
                                </div>
                                @foreach ($emails as $i => $email)
                                    <div class="address-item">
                                        <div class="address-icon">
                                            <i class="fa fa-envelope-o"></i>
                                        </div>
                                        <div class="address-text">
                                            <span class="label">Correo{{ $i > 0 ? ' ' . ($i + 1) : '' }}</span>
                                            <span class="des"><a href="mailto:{{ $email }}">{{ $email }}</a></span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if ($phones)
                        <div class="{{ $colClass }} col-md-12 md-mb-30">
                            <div class="rs-contact-wrap">
                                <div class="inner-part text-center">
                                    <h2 class="title2">Teléfonos</h2>
                                </div>
                                @foreach ($phones as $i => $phone)
                                    <div class="address-item">
                                        <div class="address-icon">
                                            <i class="fa fa-headphones"></i>
                                        </div>
                                        <div class="address-text">
                                            <span class="label">Teléfono{{ $i > 0 ? ' ' . ($i + 1) : '' }}</span>
                                            <span class="des"><a href="tel:{{ $phone }}">{{ $phone }}</a></span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if ($company?->address)
                        <div class="{{ $colClass }} col-md-12">
                            <div class="rs-contact-wrap">
                                <div class="inner-part text-center">
                                    <h2 class="title2">Dirección</h2>
                                </div>
                                <div class="address-item">
                                    <div class="address-icon">
                                        <i class="fa fa-map-signs"></i>
                                    </div>
                                    <div class="address-text">
                                        <span class="label">Dirección</span>
                                        <span class="des">{{ $company->address }}</span>
                                    </div>
                                </div>
                                @if ($company?->whatsapp_link)
                                    <div class="address-item">
                                        <div class="address-icon">
                                            <i class="fa fa-whatsapp"></i>
                                        </div>
                                        <div class="address-text">
                                            <span class="label">WhatsApp</span>
                                            <span class="des"><a href="{{ $company->whatsapp_link }}" target="_blank">Escríbenos</a></span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
