@extends('partials.app')
@section('title', 'Profile')
@section('content')

    @include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => 'Profile'])

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
                                            <span
                                                class="badge bg-primary">{{ $user->userData->type_owner->label() }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <strong>{{ __('Full Name') }}:</strong>
                                            <span>{{ $user->userData->fio }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <strong>{{ __('Email') }}:</strong>
                                            <span>{{ $user->email }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <strong>{{ __('Phone') }}:</strong>
                                            <span>{{ $user->userData->phone }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <strong>{{ __('Region') }}:</strong>
                                            <span>{{ $user->userData->region }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <strong>{{ __('Address') }}:</strong>
                                            <span>{{ $user->userData->address }}</span>
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
                                    @if($user->userData->type_owner == \App\Enums\TypeOwners::INDIVIDUAL)
                                        {{ __('Passport Information') }}
                                    @elseif($user->userData->type_owner == \App\Enums\TypeOwners::COMMERCE)
                                        {{ __('Business Information') }}
                                    @elseif($user->userData->type_owner == \App\Enums\TypeOwners::ORGANIZATION)
                                        {{ __('Company Information') }}
                                    @endif
                                </h4>
                            </div>
                            <div class="dashboard-widget-body">
                                <div class="user-info-list">
                                    <ul class="list-group list-group-flush">
                                        @if($user->userData->type_owner == \App\Enums\TypeOwners::INDIVIDUAL)
                                            <li class="list-group-item d-flex justify-content-between">
                                                <strong>{{ __('Passport Series') }}:</strong>
                                                <span>{{ $user->userData->passport_series }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <strong>{{ __('Passport Number') }}:</strong>
                                                <span>{{ $user->userData->passport_number }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <strong>{{ __('Passport Issued By') }}:</strong>
                                                <span>{{ $user->userData->passport_issued_by }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <strong>{{ __('Passport Issued Date') }}:</strong>
                                                <span>{{ $user->userData->passport_issued_date }}</span>
                                            </li>
                                        @elseif($user->userData->type_owner == \App\Enums\TypeOwners::COMMERCE)
                                            <li class="list-group-item d-flex justify-content-between">
                                                <strong>{{ __('UNP') }}:</strong>
                                                <span>{{ $user->userData->unp }}</span>
                                            </li>
                                        @elseif($user->userData->type_owner == \App\Enums\TypeOwners::ORGANIZATION)
                                            <li class="list-group-item d-flex justify-content-between">
                                                <strong>{{ __('Company Name') }}:</strong>
                                                <span>{{ $user->userData->company_name }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <strong>{{ __('UNP') }}:</strong>
                                                <span>{{ $user->userData->unp }}</span>
                                            </li>
                                            @if($user->userData->info)
                                                <li class="list-group-item">
                                                    <strong>{{ __('Additional Information') }}:</strong>
                                                    <p class="mt-2">{{ $user->userData->info }}</p>
                                                </li>
                                            @endif
                                        @endif
                                    </ul>
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
