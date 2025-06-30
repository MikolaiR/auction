<footer class="style-2">
    <div class="footer-top">
        <div class="container">
            <div class="row gy-5">
                <div class="col-xl-3 col-lg-8 col-md-12">
                    <div class="footer-item">
                        <h5>{{ __('Join Newsletter') }}</h5>
                        <p>{{ __('Subscribe our newsletter to get more free design course and resource.') }}</p>
                        <form class="mb-30">
                            <div class="input-with-btn d-flex jusify-content-start align-items-strech">
                                <input type="text" placeholder="{{ __('Enter your email') }}">
                                <button type="submit">{{ __('Subscribe') }}</button>
                            </div>
                        </form>
                        <ul class="footer-social gap-3">
                            <li><a href="#"><i class="bx bxl-facebook"></i></a></li>
                            <li><a href="#"><i class="bx bxl-twitter"></i></a></li>
                            <li><a href="#"><i class="bx bxl-instagram"></i></a></li>
                            <li><a href="#"><i class="bx bxl-pinterest-alt"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 d-flex justify-content-xl-center">
                    <div class="footer-item">
                        <h5>{{ __('Important Links') }}</h5>
                        <ul class="footer-list">
                            <li><a href="{{ route('live-auction') }}">{{ __('Live Auctions') }}</a></li>
                            <li><a href="{{ route('how-it-works') }}">{{ __('How It Works') }}</a></li>
                            <li><a href="#">{{ __('My Account') }}</a></li>
                            <li><a href="{{ route('about') }}">{{ __('About Company') }}</a></li>
                            <li><a href="{{ route('blog.index') }}">{{ __('Our News Feed') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 d-flex justify-content-xl-center">
                    <div class="footer-item">
                        <h5>{{ __('Help & FAQs') }}</h5>
                        <ul class="footer-list">
                            <li><a href="#">{{ __('Help Center') }}</a></li>
                            <li><a href="#">{{ __('Customer FAQs') }}</a></li>
                            <li><a href="#">{{ __('Terms and Conditions') }}</a></li>
                            <li><a href="#">{{ __('Security Information') }}</a></li>
                            <li><a href="#">{{ __('Merchant Add Policy') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-8 col-md-12">
                    <div class="footer-item">
                        <a href="{{ route('home') }}"><img alt="image" src="/assets/images/bg/footer-logo2.png"></a>
                        <ul class="address-list">
                            <li><a href="#">{{ __('105,Mohan Nagar, Ramnagariya, Jaipur 302017') }}</a></li>
                            <li><a href="tel:+1234567890">{{ __('Phone:') }} +91 72210 47383 /  +91 97820 94191</a></li>
                            <li><a href="/cdn-cgi/l/email-protection#00000000000000000000">{{ __('Email:') }}
                                    <span class="__cf_email__"
                                        data-cfemail="00000000000000000000">[email&#160;protected]</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row d-flex align-items-center g-4">
                <div class="col-lg-6 d-flex justify-content-lg-start justify-content-center">
                    <p>{{ __('Built with') }} <i class="bi bi-heart-fill"></i> {{ __('by') }} <a href="https://codifiedweb.com">{{ __('CodifiedWeb') }}</a></p>
                </div>
                
            </div>
        </div>
    </div>
</footer>