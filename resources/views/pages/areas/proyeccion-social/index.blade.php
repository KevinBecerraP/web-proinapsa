@extends('layouts.app-secondary')

@section('title', 'Proyección Social')

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
        @endif

        @if ($area->coordinator)
            @php $coordinator = $area->coordinator; @endphp
            <div id="rs-about" class="rs-about style1 pt-100  pb-40 md-pb-70">
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

        <div id="rs-popular-courses" class="rs-popular-courses main-home event-bg pt-20 pb-20 md-pt-70 md-pb-70">
            <div class="container">
                <div class="sec-title3 text-center mb-45">
                    <div class="sub-title">Tu bienestar es nuestra prioridad</div>
                    <h2 class="title black-color">Recursos pensados para cada etapa de la vida</h2>
                </div>
            </div>
        </div>

        @if ($area->healthPromotionCategories->isNotEmpty())
            <div id="rs-popular-courses" class="rs-popular-courses style3 orange-color pt-40 pb-100 md-pt-70 md-pb-70">
                <div class="container">
                    <div class="gridFilter text-center mb-50" id="categoryFilter">
                        @foreach ($area->healthPromotionCategories as $index => $cat)
                            <button class="{{ $index === 0 ? 'active' : '' }}"
                                onclick="showCategory('cat-{{ $cat->id }}', this)">
                                {{ strtoupper($cat->display_name) }}
                            </button>
                        @endforeach
                    </div>
                    <div id="categoriesGrid">
                        @foreach ($area->healthPromotionCategories as $cat)
                            <div class="category-section cat-{{ $cat->id }}">
                                @if ($cat->items->isNotEmpty())
                                    <div class="rs-faq-part style1 orange-color">
                                        <div class="row">
                                            <div class="col-lg-12 padding-0">
                                                <div class="main-part">
                                                    <div class="faq-content">
                                                        <div id="accordion-{{ $cat->id }}" class="accordion">
                                                            @foreach ($cat->items as $index => $item)
                                                                @php $collapseId = 'collapse-' . $cat->id . '-' . $item->id; @endphp
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <a class="card-link {{ $index > 0 ? 'collapsed' : '' }}"
                                                                            data-toggle="collapse"
                                                                            href="#{{ $collapseId }}"
                                                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                                                            {{ $item->title }}
                                                                        </a>
                                                                    </div>
                                                                    <div id="{{ $collapseId }}"
                                                                        class="collapse {{ $index === 0 ? 'show' : '' }}"
                                                                        data-parent="#accordion-{{ $cat->id }}">
                                                                        <div class="card-body" style="text-align: justify;">
                                                                            {!! $item->short_description !!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <script>
                function showCategory(cat, btn) {
                    document.querySelectorAll('#categoryFilter button').forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    document.querySelectorAll('#categoriesGrid .category-section').forEach(function(item) {
                        item.style.display = item.classList.contains(cat) ? '' : 'none';
                    });
                }

                document.addEventListener('DOMContentLoaded', function() {
                    var firstBtn = document.querySelector('#categoryFilter button');
                    if (firstBtn) firstBtn.click();
                });
            </script>
        @endif

    </div>

@endsection
