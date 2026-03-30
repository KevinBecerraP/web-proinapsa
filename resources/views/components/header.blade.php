<!--Full width header Start-->
<div class="full-width-header home8-style4 main-home">
    <!--Header Start-->
    <header id="rs-header" class="rs-header">
        <!-- Menu Start -->
        <div class="menu-area menu-sticky">
            <div class="container">
                <div class="row y-middle">
                    <div class="col-lg-2">
                        <div class="logo-cat-wrap">
                            <div class="logo-part">
                                <a href="{{ route('home') }}">
                                    @if ($company?->logo)
                                        <img class="normal-logo" src="{{ Storage::url($company->logo) }}"
                                            alt="{{ $company->business_name ?? '' }}">
                                        <img class="sticky-logo" src="{{ Storage::url($company->logo) }}"
                                            alt="{{ $company->business_name ?? '' }}">
                                    @else
                                        <img class="normal-logo" src="assets/images/lite-logo.png" alt="">
                                        <img class="sticky-logo" src="assets/images/lite-logo.png" alt="">
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10 text-right">
                        <div class="rs-menu-area">
                            <div class="main-menu">
                                <div class="mobile-menu">
                                    <a class="rs-menu-toggle">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </div>
                                <nav class="rs-menu">
                                    <ul class="nav-menu">
                                        <li class="rs-mega-menu mega-rs menu-item">
                                            <a href="{{ route('home') }}">Inicio</a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="{{ route('about-us') }}"> Sobre Nosotros</a>
                                        </li>

                                        <li class="menu-item">
                                            <a href="{{ route('what-we-do.index') }}">Que hacemos?</a>
                                        </li>

                                        <li class="menu-item">
                                            <a href="{{ route('repository.index') }}">Repositorios</a>
                                        </li>

                                        <li class="menu-item">
                                            <a href="{{ route('news.index') }}">Noticias</a>
                                        </li>

                                        <li class="menu-item">
                                            <a href="{{ route('contact.index') }}">Contactanos</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Menu End -->
    </header>
    <!--Header End-->
</div>
<!--Full width header End-->
