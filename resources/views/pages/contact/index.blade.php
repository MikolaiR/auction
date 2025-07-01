@extends('partials.app')
@section('title', __('Contact'))
@section('description', __('Contact us for any questions or concerns.'))
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => __('Contact')])

<div class="contact-section pt-120 pb-120">
    <div class="container">
        <div class="row pb-120 mb-70 g-4 d-flex justify-content-center">
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="contact-signle hover-border1 d-flex flex-row align-items-center wow fadeInDown"
                    data-wow-duration="1.5s" data-wow-delay=".2s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInDown;">
                    <div class="icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <div class="text">
                        <h4>{{ __('Location') }}</h4>
                        <p>{{ __('105,Mohan Nagar, Jaipur,India') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="contact-signle hover-border1 d-flex flex-row align-items-center wow fadeInDown"
                    data-wow-duration="1.5s" data-wow-delay=".4s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.4s; animation-name: fadeInDown;">
                    <div class="icon">
                        <i class="bx bx-phone-call"></i>
                    </div>
                    <div class="text">
                        <h4>{{ __('Phone') }}</h4>
                        <a href="tel:+917221047383">+91 72210 47383</a>
                        <a href="tel:+919782094191">+91 97820 94191</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="contact-signle hover-border1 d-flex flex-row align-items-center wow fadeInDown"
                    data-wow-duration="1.5s" data-wow-delay=".6s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.6s; animation-name: fadeInDown;">
                    <div class="icon">
                        <i class="bx bx-envelope"></i>
                    </div>
                    <div class="text">
                        <h4>{{ __('Email') }}</h4>
                        <a href="mailto:support@example.com">support@auctionengine.com</a>
                        <a href="mailto:info@example.com">info@auctionengine.com</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="form-wrapper wow fadeInDown" data-wow-duration="1.5s" data-wow-delay=".2s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInDown;">
                    <div class="form-title2">
                        <h3>{{ __('Get in Touch') }}</h3>
                        <p class="para">{{ __('Feel free to ask me any question or let\'s do to talk about our future collaboration.') }}</p>
                    </div>
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6 col-lg-12 col-md-6">
                                <div class="form-inner">
                                    <input type="text" name="name" placeholder="{{ __('Your Name :') }}">
                                </div>
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-6">
                                <div class="form-inner">
                                    <input type="email" name="email" placeholder="{{ __('Your Email :') }}">
                                </div>
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-6">
                                <div class="form-inner">
                                    <input type="text" name="phone" placeholder="{{ __('Your Phone :') }}">
                                </div>
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-6">
                                <div class="form-inner">
                                    <input type="text" name="subject" placeholder="{{ __('Subject :') }}">
                                </div>
                                <span class="text-danger">{{ $errors->first('subject') }}</span>
                            </div>
                            <div class="col-12">
                                <textarea name="message" placeholder="{{ __('Write Message :') }}" rows="12"></textarea>
                                <span class="text-danger">{{ $errors->first('message') }}</span>
                            </div>
                            {!! LaraCaptcha::script() !!}
                            <div class="col-12">
                                <button type="submit" class="eg-btn btn--primary btn--md form--btn">{{ __('Send Message') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="map-area wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".4s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.4s; animation-name: fadeInUp;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d183.4173184844868!2d75.87156928792834!3d26.82225956220898!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396dc83cb119dd3f%3A0x65caf1f114df3646!2sRVCC%2BWPQ%2C%20Shivam%20Nagar%2C%20Mohan%20Nagar%2C%20Jagatpura%2C%20Jaipur%2C%20Rajasthan%20302025!5e1!3m2!1sen!2sin!4v1748953012598!5m2!1sen!2sin"
                        style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>

                        
                </div>
            </div>
        </div>
    </div>
</div>


<x-metric-card />
@endsection