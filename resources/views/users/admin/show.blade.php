@extends('partials.admin')
@section('title', __('Admin Users Detail'))
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'users'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => __('User'), 'hasBack' => true, 'backTitle' => __('All User'), 'backUrl' => route('admin.users.index')])

             <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">{{ __('All User Detail') }}</h3>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row" id="user-profile">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="wideget-user mb-2">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="row">
                                            <div class="panel profile-cover">
                                                <div class="profile-cover__action bg-img"></div>
                                                <div class="profile-cover__img">
                                                    <div class="profile-img-1">
                                                        <img src="{{ $user->avatar }}" alt="profile-img1">
                                                    </div>
                                                    <div class="profile-img-content text-dark text-start">
                                                        <div class="text-dark">
                                                            <h3 class="h3 mb-2">{{ $user->name }}</h3>
                                                            <h5 class="text-muted">{{ __('@') . $user->username }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="px-0 px-sm-4">
                                                <div class="social social-profile-buttons mt-5 float-end">
                                                    <div class="mt-3 d-flex">
                                                        <a class="social-icon text-primary" href="mailto:{{ $user->email }}" target="_blank"><i class="fa-regular fa-envelope"></i></a>
                                                        <a class="social-icon text-primary" href="tel:{{ $user->mobile ?? '' }}" target="_blank"><i class="fa-regular fa-phone"></i></a>
                                                        <a class="social-icon text-dark" href="{{ route('admin.users.edit', $user->id) }}"><i class="fa-regular fa-edit"></i></a>
                                                        <form action="{{ route('admin.users.destroy', $user->id)}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="social-icon text-danger" type="submit"><i class="fa-regular fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-md-flex main-profile-contact-list">
                                        <div class="me-5">
                                            <div class="media mb-4 d-flex">
                                                <div class="media-icon bg-secondary bradius me-3 mt-1">
                                                    <i class="fa-regular fa-cube fs-20 text-white"></i>
                                                </div>
                                                <div class="media-body">
                                                    <span class="text-muted">{{ __('Total Ads') }}</span>
                                                    <div class="fw-semibold fs-25">
                                                        {{$user->ads_count}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="me-5 mt-5 mt-md-0">
                                            <div class="media mb-4 d-flex">
                                                <div class="media-icon bg-danger bradius text-white me-3 mt-1">
                                                    <span class="mt-3">
                                                        <i class="fa-regular fa-gavel fs-20"></i>
                                                    </span>
                                                </div>
                                                <div class="media-body">
                                                    <span class="text-muted">{{ __('Total Bids') }}</span>
                                                    <div class="fw-semibold fs-25">
                                                        {{$user->bids_count}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="me-5 mt-5 mt-md-0">
                                            <div class="media mb-4 d-flex">
                                                <div class="media-icon bg-dark bradius text-white me-3 mt-1">
                                                    <span class="mt-3">
                                                        <i class="fa-regular fa-credit-card fs-20"></i>
                                                    </span>
                                                </div>
                                                <div class="media-body">
                                                    <span class="text-muted">{{ __('Total Methods') }}</span>
                                                    <div class="fw-semibold fs-25">
                                                        {{$user->payout_methods_count}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="me-5 mt-5 mt-md-0">
                                            <div class="media mb-4 d-flex">
                                                <div class="media-icon bg-warning bradius text-white me-3 mt-1">
                                                    <span class="mt-3">
                                                        <i class="fa-regular fa-credit-card fs-20"></i>
                                                    </span>
                                                </div>
                                                <div class="media-body">
                                                    <span class="text-muted">{{ __('Total Paid') }}</span>
                                                    <div class="fw-semibold fs-25">
                                                        {{money($user->payments->sum('amount'), true)}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="me-0 mt-5 mt-md-0">
                                            <div class="media">
                                                <div class="media-icon bg-primary text-white bradius me-3 mt-1">
                                                    <span class="mt-3">
                                                        <i class="fa-regular fa-money-bill fs-20"></i>
                                                    </span>
                                                </div>
                                                <div class="media-body">
                                                    <span class="text-muted">{{ __('Total Payouts') }}</span>
                                                    <div class="fw-semibold fs-25">
                                                        {{money($user->payouts->sum('amount'), true)}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">{{ __('About') }}</div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-solid fa-location-crosshairs"></i></span>
                                        </div>
                                        <div>
                                            <strong>{{ $user->address }}</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-regular fa-map fs-20"></i></span>
                                        </div>
                                        <div>
                                            <strong>{{ $user->city?->name }} {{ $user->state?->name . ', ' }} {{ $user->country?->name }}</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-regular fa-phone fs-20"></i></span>
                                        </div>
                                        <div>
                                            <strong>{{ $user->mobile }}</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-regular fa-at fs-20"></i></span>
                                        </div>
                                        <div>
                                            <strong>{{ $user->email }}</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-solid fa-venus fs-20"></i></span>
                                        </div>
                                        <div>
                                            <strong>{{ isset($user->gender) ? $user->gender->label() : __('Not Available') }}</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-regular fa-mailbox fs-20"></i></span>
                                        </div>
                                        <div>
                                            <strong>{{ $user->zip_code ?? __('Not Available') }}</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-light fa-earth-americas fs-20"></i></span>
                                        </div>
                                        <div>
                                            <strong>{{ isset($user->timezone) ? $user->timezone->name : __('Not Available') }}</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-regular fa-ban fs-20"></i></span>
                                        </div>
                                        <div>
                                            <strong>{{ $user->is_active ? __('Active') : __('Banned') }}</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-light fa-calendar-days fs-20"></i></span>
                                        </div>
                                        <div>
                                            <strong>{{ $user->created_at->format('d M, Y h:i A') }}</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-regular fa-badge-check fs-20"></i></span>
                                        </div>
                                        <div>
                                            <strong>{{ $user->email_verified_at->format('d M, Y h:i A') }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">{{ __('User Data') }}</div>
                                </div>
                                <div class="card-body">
                                    @if($user->userData)
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-solid fa-id-card fs-20"></i></span>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0">{{ __('User Type') }}</p>
                                            <strong>{{ $user->userData->type_owner->label() }}</strong>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-solid fa-user fs-20"></i></span>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0">{{ __('Full Name') }}</p>
                                            <strong>{{ $user->userData->fio }}</strong>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-solid fa-phone fs-20"></i></span>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0">{{ __('Phone') }}</p>
                                            <strong>{{ $user->userData->phone }}</strong>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-solid fa-map-marker fs-20"></i></span>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0">{{ __('Region') }}</p>
                                            <strong>{{ $user->userData->region }}</strong>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-solid fa-location-dot fs-20"></i></span>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0">{{ __('Address') }}</p>
                                            <strong>{{ $user->userData->address }}</strong>
                                        </div>
                                    </div>
                                    
                                    @if($user->userData->type_owner == \App\Enums\TypeOwners::INDIVIDUAL)
                                    <!-- Паспортные данные для физических лиц -->
                                    <hr>
                                    <h6 class="mb-3">{{ __('Passport Information') }}</h6>
                                    
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-solid fa-passport fs-20"></i></span>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0">{{ __('Passport Series') }}</p>
                                            <strong>{{ $user->userData->passport_series }}</strong>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-solid fa-passport fs-20"></i></span>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0">{{ __('Passport Number') }}</p>
                                            <strong>{{ $user->userData->passport_number }}</strong>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-solid fa-building-columns fs-20"></i></span>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0">{{ __('Passport Issued By') }}</p>
                                            <strong>{{ $user->userData->passport_issued_by }}</strong>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-solid fa-calendar fs-20"></i></span>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0">{{ __('Passport Issued Date') }}</p>
                                            <strong>{{ $user->userData->passport_issued_date }}</strong>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if($user->userData->type_owner == \App\Enums\TypeOwners::COMMERCE)
                                    <!-- Данные для ИП -->
                                    <hr>
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-solid fa-fingerprint fs-20"></i></span>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0">{{ __('UNP') }}</p>
                                            <strong>{{ $user->userData->unp }}</strong>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if($user->userData->type_owner == \App\Enums\TypeOwners::ORGANIZATION)
                                    <!-- Данные для организаций -->
                                    <hr>
                                    <h6 class="mb-3">{{ __('Company Information') }}</h6>
                                    
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-solid fa-building fs-20"></i></span>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0">{{ __('Company Name') }}</p>
                                            <strong>{{ $user->userData->company_name }}</strong>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-solid fa-fingerprint fs-20"></i></span>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0">{{ __('UNP') }}</p>
                                            <strong>{{ $user->userData->unp }}</strong>
                                        </div>
                                    </div>
                                    
                                    @if($user->userData->info)
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fa-solid fa-info-circle fs-20"></i></span>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0">{{ __('Additional Information') }}</p>
                                            <strong>{{ $user->userData->info }}</strong>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                    
                                    @else
                                    <div class="alert alert-warning">
                                        {{ __('No additional user data available') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">{{ __('User Actions') }}</div>
                                </div>
                                <div class="card-body">
                                    <div class="action-user">
                                        <a href="{{ route('admin.ads.index', ['search' => $user->id]) }}">{{ __('See all user ads') }}</a>
                                        <a href="{{ route('admin.bids.index', ['bid_id' => $user->id]) }}">{{ __('See all user bids') }}</a>
                                        <a href="{{ route('admin.payouts.index', ['pyt_token' => $user->id]) }}">{{ __('See all user payouts') }}</a>
                                        <a href="{{ route('admin.payments.index', ['txn_id' => $user->id]) }}">{{ __('See all user payments') }}</a>
                                        <a href="{{ route('admin.payout-methods.index', ['user_id' => $user->id] ) }}">{{ __('See all user payout methods') }}</a>
                                        <a href="{{ route('admin.support.index', ['search' => $user->id]) }}">{{ __('See all user support tickets') }}</a>
                                        <a href="{{ route('admin.media.index', ['search' => $user->id] ) }}">{{ __('See all users media') }}</a>
                                        <a href="{{ route('admin.comments.index', ['search' => $user->id] ) }}">{{ __('See all user comments') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL-END -->
            </div>

        </div>
        <!-- CONTAINER END -->
    </div>
</div>


@endsection
@push('scripts')
<script src="/plugin/select2/select2.full.min.js"></script>
<script src="/assets/js/select2.js"></script>

@endpush
