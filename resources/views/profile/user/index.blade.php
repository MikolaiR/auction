@extends('partials.app')
@section('title', __('Profile'))
@section('content')

    @include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => __('Profile')])

    <div class="dashboard-section pt-120 pb-120">
        <div class="container">
            <div class="row g-4">
                @include('layouts.sidebar', ['active' => 'profile', 'admin' => false])
                <div class="col-lg-9">
                    <div class="tab-pane">
                        <div class="dashboard-profile">
                            <div class="owner">
                                <div class="image">
                                    <img alt="image" src="{{ $user->avatar ?? get_random_avatar() }}">
                                </div>
                                <div class="content">
                                    <h3>{{ $user->name }}</h3>
                                    <p class="para">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="dashboard-widget-body">
                                <div class="user-info-list">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between">
                                            <strong>{{ __('User Type') }}:</strong>
                                            <span class="badge bg-primary">
                                                @if(isset($user->userData) && $user->userData->type_owner)
                                                    {{ $user->userData->type_owner->label() }}
                                                @else
                                                    {{ __('Not Specified') }}
                                                @endif
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <strong>{{ __('Full Name') }}:</strong>
                                            <span>{{ isset($user->userData) ? $user->userData->fio : __('Not Specified') }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <strong>{{ __('Email') }}:</strong>
                                            <span>{{ $user->email }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <strong>{{ __('Phone') }}:</strong>
                                            <span>{{ isset($user->userData) ? $user->userData->phone : __('Not Specified') }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <strong>{{ __('Region') }}:</strong>
                                            <span>{{ isset($user->userData) ? $user->userData->region : __('Not Specified') }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <strong>{{ __('Address') }}:</strong>
                                            <span>{{ isset($user->userData) ? $user->userData->address : __('Not Specified') }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Дополнительная информация в зависимости от типа пользователя -->
                    <div class="col-lg-6">
                        <div class="dashboard-widget">
                            <div class="dashboard-title">
                                <h4>
                                    @if(isset($user->userData) && $user->userData->type_owner)
                                        @if($user->userData->type_owner == \App\Enums\TypeOwners::INDIVIDUAL)
                                            {{ __('Passport Information') }}
                                        @elseif($user->userData->type_owner == \App\Enums\TypeOwners::COMMERCE)
                                            {{ __('Business Information') }}
                                        @elseif($user->userData->type_owner == \App\Enums\TypeOwners::ORGANIZATION)
                                            {{ __('Company Information') }}
                                        @endif
                                    @else
                                        {{ __('Additional Information') }}
                                    @endif
                                </h4>
                            </div>
                            <div class="dashboard-widget-body">
                                <div class="user-info-list">
                                    <ul class="list-group list-group-flush">
                                        @if(isset($user->userData) && $user->userData->type_owner)
                                            @if($user->userData->type_owner == \App\Enums\TypeOwners::INDIVIDUAL)
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <strong>{{ __('Passport Series') }}:</strong>
                                                    <span>{{ $user->userData->passport_series ?? __('Not Specified') }}</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <strong>{{ __('Passport Number') }}:</strong>
                                                    <span>{{ $user->userData->passport_number ?? __('Not Specified') }}</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <strong>{{ __('Passport Issued By') }}:</strong>
                                                    <span>{{ $user->userData->passport_issued_by ?? __('Not Specified') }}</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <strong>{{ __('Passport Issued Date') }}:</strong>
                                                    <span>{{ $user->userData->passport_issued_date ?? __('Not Specified') }}</span>
                                                </li>
                                            @elseif($user->userData->type_owner == \App\Enums\TypeOwners::COMMERCE)
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <strong>{{ __('UNP') }}:</strong>
                                                    <span>{{ $user->userData->unp ?? __('Not Specified') }}</span>
                                                </li>
                                            @elseif($user->userData->type_owner == \App\Enums\TypeOwners::ORGANIZATION)
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <strong>{{ __('Company Name') }}:</strong>
                                                    <span>{{ $user->userData->company_name ?? __('Not Specified') }}</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <strong>{{ __('UNP') }}:</strong>
                                                    <span>{{ $user->userData->unp ?? __('Not Specified') }}</span>
                                                </li>
                                                @if(isset($user->userData->info) && $user->userData->info)
                                                    <li class="list-group-item">
                                                        <strong>{{ __('Additional Information') }}:</strong>
                                                        <p class="mt-2">{{ $user->userData->info }}</p>
                                                    </li>
                                                @endif
                                            @endif
                                        @else
                                            <li class="list-group-item">
                                                <p>{{ __('No additional information available yet. Please complete your accreditation.') }}</p>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Accreditation Section -->
                    <div class="col-lg-12">
                        <div class="dashboard-widget">
                            <div class="dashboard-title d-flex justify-content-between align-items-center">
                                <h4>{{ __('Accreditation Status') }}</h4>
                                @if(isset($user->userData) && $user->userData->status)
                                    @if($user->userData->status === 'pending')
                                        <span class="badge bg-warning">{{ __('Pending Review') }}</span>
                                    @elseif($user->userData->status === 'approved')
                                        <span class="badge bg-success">{{ __('Approved') }}</span>
                                    @elseif($user->userData->status === 'rejected')
                                        <span class="badge bg-danger">{{ __('Rejected') }}</span>
                                    @endif
                                @else
                                    <span class="badge bg-secondary">{{ __('Not Submitted') }}</span>
                                @endif
                            </div>
                            <div class="dashboard-widget-body">
                                @if(isset($user->userData))
                                    @if($user->userData->status === 'rejected')
                                        <div class="alert alert-danger">
                                            <h5>{{ __('Your accreditation was rejected') }}</h5>
                                            <p><strong>{{ __('Reason') }}:</strong> {{ $user->userData->admin_comment }}</p>
                                            <p>{{ __('Please update your information and resubmit.') }}</p>
                                        </div>
                                    @elseif(!$user->userData->status || $user->userData->status === null)
                                        <div class="alert alert-info">
                                            <p>{{ __('You need to complete your accreditation to fully use the platform.') }}</p>
                                        </div>
                                    @elseif($user->userData->status === 'pending')
                                        <div class="alert alert-warning">
                                            <p>{{ __('Your accreditation is currently being reviewed by our team. We will notify you once the review is complete.') }}</p>
                                        </div>
                                    @elseif($user->userData->status === 'approved')
                                        <div class="alert alert-success">
                                            <p>{{ __('Your account is fully accredited. You have access to all platform features.') }}</p>
                                        </div>
                                    @endif
                                @else
                                    <div class="alert alert-info">
                                        <p>{{ __('You need to complete your accreditation to fully use the platform.') }}</p>
                                    </div>
                                @endif

                                @if(isset($user->userData) && isset($user->userData->documents) && $user->userData->documents)
                                    <h5 class="mt-4">{{ __('Uploaded Documents') }}</h5>
                                    <div class="row">
                                        @foreach(json_decode($user->userData->documents, true) as $index => $document)
                                            <div class="col-md-4 mb-3">
                                                <div class="card h-100">
                                                    <div class="card-body">
                                                        <h6 class="card-title text-truncate">
                                                            <i class="fas {{ Str::endsWith($document['name'], '.pdf') ? 'fa-file-pdf' : 'fa-file-image' }} mr-2"></i>
                                                            {{ $document['name'] }}
                                                        </h6>
                                                        <p class="card-text">
                                                            <small class="text-muted">
                                                                {{ __('Size') }}: {{ round($document['size'] / 1024 / 1024, 2) }} MB
                                                            </small>
                                                        </p>
                                                        <a href="{{ Storage::url($document['path']) }}" target="_blank" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-eye"></i> {{ __('View') }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="mt-4">
                                    <a href="{{ route('user.accreditation') }}" class="eg-btn profile-btn">
                                        @if(!isset($user->userData) || !$user->userData->status || $user->userData->status === 'rejected')
                                            {{ __('Complete Accreditation') }}
                                        @else
                                            {{ __('Update Accreditation') }}
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Форма смены пароля -->
                    <div class="col-lg-12">
                        <div class="dashboard-widget">
                            <div class="dashboard-title">
                                <h4>{{ __('Change Password') }}</h4>
                            </div>
                            <div class="form-wrapper">
                                <form action="{{ route('user.profile.handle') }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <x-input-field name="current_password" type="password"
                                                           label="{{ __('Current Password') }}" placeholder="{{ __('Enter Current password') }}"
                                                           :required="false"/>
                                            <x-input-field name="password" type="password" label="{{ __('Change password') }}"
                                                           placeholder="{{ __('Create a password') }}" :required="false"/>
                                            <x-input-field name="password_confirmation" type="password" label="{{ __('Confirm password') }}"
                                                           placeholder="{{ __('Confirm password') }}" :required="false"/>
                                        </div>
                                        <div class="button-group">
                                            <button type="submit" class="eg-btn profile-btn">{{ __('Update password') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-metric-card/>

@endsection
