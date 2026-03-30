<div class="full-width-header header-style1 home8-style4">
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
                                        <img src="{{ Storage::url($company->logo) }}"
                                            alt="{{ $company->business_name ?? '' }}">
                                    @else
                                        <img src="{{ asset('images/dark-logo.png') }}" alt="">
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
                                <nav class="rs-menu rs-menu-close">
                                    <ul class="nav-menu">
                                        <li class="rs-mega-menu mega-rs menu-item"> <a
                                                href="{{ route('home') }}">Inicio</a>
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
                                            <a href="{{ route('news.index') }}">Contactanos</a>
                                        </li>

                                    </ul> <!-- //.nav-menu -->
                                </nav>
                            </div> <!-- //.main-menu -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Menu End -->
    </header>
    <!--Header End-->
</div>
