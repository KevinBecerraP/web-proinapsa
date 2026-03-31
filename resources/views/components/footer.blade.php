<!-- Footer Start -->
<footer id="rs-footer" class="rs-footer home9-style main-home">
    <div class="footer-top no-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 footer-widget md-mb-50">
                    <h3 class="widget-title">Contáctanos</h3>
                    <ul class="address-widget">
                        @if ($company?->address)
                            <li>
                                <i class="flaticon-location"></i>
                                <div class="desc">{{ $company->address }}</div>
                            </li>
                        @endif
                        @if ($company?->phone_1)
                            <li>
                                <i class="flaticon-call"></i>
                                <div class="desc">
                                    <a href="tel:{{ $company->phone_1 }}">{{ $company->phone_1 }}</a>
                                </div>
                            </li>
                        @endif
                        @if ($company?->email_1)
                            <li>
                                <i class="flaticon-email"></i>
                                <div class="desc">
                                    <a href="mailto:{{ $company->email_1 }}">{{ $company->email_1 }}</a>
                                </div>
                            </li>
                        @endif
                    </ul>
                    @if ($company?->privacy_policy_pdf)
                        <div class="mt-30">
                            <h3 class="widget-title">Políticas de Protección de Datos</h3>
                            <a href="{{ $company->privacy_policy_url }}" target="_blank" rel="noopener noreferrer"
                                style="color:#e8e8e8; font-size:14px;">
                                <i class="fa fa-file-pdf-o" style="margin-right:6px;"></i> Ver políticas
                            </a>
                        </div>
                    @endif
                </div>

                @foreach ($interestLinks->chunk(5) as $i => $chunk)
                    <div class="col-lg-4 col-md-12 col-sm-12 pl-50 md-pl-15 footer-widget md-mb-50">
                        @if ($i === 0)
                            <h3 class="widget-title">Links de Interés</h3>
                        @else
                            <h3 class="widget-title">&nbsp;</h3>
                        @endif
                        <ul class="site-map">
                            @foreach ($chunk as $link)
                                <li><a href="{{ $link->url }}" target="_blank"
                                        rel="noopener noreferrer">{{ $link->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row y-middle">
                <div class="col-lg-8 md-mb-20">
                    <div class="copyright">
                        <p>&copy; {{ date('Y') }} {{ $company?->business_name }}. Todos los derechos reservados.</p>
                    </div>
                </div>
                <div class="col-lg-4 text-right md-text-left">
                    <ul class="footer_social"
                        style="display:flex; justify-content:flex-end; flex-wrap:wrap; gap:10px; list-style:none; padding:0; margin:0;">
                        @if ($company?->facebook_link)
                            <li>
                                <a href="{{ $company->facebook_link }}" target="_blank" rel="noopener noreferrer"
                                    style="color:#ffffff; font-size:16px;"><span><i
                                            class="fa fa-facebook"></i></span></a>
                            </li>
                        @endif
                        @if ($company?->instagram_link)
                            <li>
                                <a href="{{ $company->instagram_link }}" target="_blank" rel="noopener noreferrer"
                                    style="color:#ffffff; font-size:16px;"><span><i
                                            class="fa fa-instagram"></i></span></a>
                            </li>
                        @endif
                        @if ($company?->youtube_link)
                            <li>
                                <a href="{{ $company->youtube_link }}" target="_blank" rel="noopener noreferrer"
                                    style="color:#ffffff; font-size:16px;"><span><i
                                            class="fa fa-youtube"></i></span></a>
                            </li>
                        @endif
                        @if ($company?->x_link)
                            <li>
                                <a href="{{ $company->x_link }}" target="_blank" rel="noopener noreferrer"
                                    style="color:#ffffff; font-size:16px;"><span><i
                                            class="fa fa-twitter"></i></span></a>
                            </li>
                        @endif
                        @if ($company?->whatsapp_link)
                            <li>
                                <a href="{{ $company->whatsapp_link }}" target="_blank" rel="noopener noreferrer"
                                    style="color:#ffffff; font-size:16px;"><span><i
                                            class="fa fa-whatsapp"></i></span></a>
                            </li>
                        @endif
                        @if ($company?->threads_link)
                            <li>
                                <a href="{{ $company->threads_link }}" target="_blank" rel="noopener noreferrer"
                                    style="color:#ffffff; font-size:16px;"><span><i class="fa fa-at"></i></span></a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer End -->
