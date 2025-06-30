@extends('partials.admin')
@section('title', __('Admin Auction Type Edit'))
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'auctiontype.edit'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => __('Auction Type'), 'hasBack' => true, 'backTitle' =>
            __('All Auction Types'), 'backUrl' => route('admin.auctiontype.index')])

            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">{{ __('All Auction Type Edit') }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{ __('Password') }}</div>
                        </div>
                        <div class="card-body">
                            <div class="text-center chat-image mb-5">
                                <div class="avatar avatar-xxl chat-profile mb-3 brround">
                                    <a class="" href="#"><img alt="avatar" src="{{$user->avatar}}"
                                            class="brround"></a>
                                </div>
                                <div class="main-chat-msg-name">
                                    <a href="#">
                                        <h5 class="mb-1 text-dark fw-semibold">{{$user->name}}</h5>
                                    </a>
                                    <p class="text-muted mt-0 mb-0 pt-0 fs-13">{{'@'.$user->username}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('admin.users.request-password-reset', $user->id) }}"
                                class="btn btn-primary">{{ __('Request Password Change') }}</a>
                        </div>
                    </div>
                    <div class="card panel-theme">
                        <div class="card-header">
                            <div class="float-start">
                                <h3 class="card-title">{{ __('Contact') }}</h3>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="card-body no-padding">
                            <ul class="list-group no-margin">
                                <li class="list-group-item d-flex ps-3">
                                    <div class="social social-profile-buttons me-2">
                                        <a class="social-icon text-primary" href="javascript:void(0)"><i
                                                class="fa-regular fa-envelope"></i></a>
                                    </div>
                                    <a href="{{'mailto:'.$user->email}}" class="my-auto">{{$user->email}}</a>
                                </li>
                                <li class="list-group-item d-flex ps-3">
                                    <div class="social social-profile-buttons me-2">
                                        <a class="social-icon text-primary" href="javascript:void(0)"><i
                                                class="fa-regular fa-globe"></i></a>
                                    </div>
                                    <a href="https://maps.google.com?q={{$user->address}}"
                                        class="my-auto">{{$user->address}}
                                </li>
                                <li class="list-group-item d-flex ps-3">
                                    <div class="social social-profile-buttons me-2">
                                        <a class="social-icon text-primary" href="javascript:void(0)"><i
                                                class="fa-regular fa-phone"></i></a>
                                    </div>
                                    <a href="{{'tel:'.$user->mobile}}" class="my-auto">{{$user->mobile}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <form class="card" action="{{route('admin.users.update', $user->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Edit Profile') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputname">{{ __('First Name') }}</label>
                                        <input type="text" name="first_name" class="form-control" id="exampleInputname"
                                            placeholder="{{ __('First Name') }}" value="{{$user->first_name}}">
                                    </div>
                                    <span class="text-danger">{{$errors->first('first_name')}}</span>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputname1">{{ __('Last Name') }}</label>
                                        <input type="text" class="form-control" id="exampleInputname1" name="last_name"
                                            placeholder="{{ __('Enter Last Name') }}" value="{{$user->last_name}}">
                                    </div>
                                    <span class="text-danger">{{$errors->first('last_name')}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('Username') }}</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="{{ __('Username') }}" disabled readonly
                                    value="{{$user->username}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('Email address') }}</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    placeholder="{{ __('Email address') }}" value="{{$user->email}}" readonly disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputnumber">{{ __('Contact Number') }}</label>
                                <input type="text" class="form-control" id="exampleInputnumber"
                                    placeholder="{{ __('Contact number') }}" value="{{$user->mobile}}" readonly disabled>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{ __('Address') }}</label>
                                <input class="form-control" placeholder="{{ __('Home Address') }}" value="{{$user->address}}" name="address">
                                <span class="text-danger">{{$errors->first('address')}}</span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Gender') }}</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <select class="form-control select2 form-select" name="gender"
                                                    <option>{{ __('All') }}</option>
                                                    @foreach (\App\Enums\Gender::all() as $gender)
                                                    <option value="{{$gender}}" @selected(true ? $user->gender ===
                                                        $gender : false)>{{$gender->label()}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">{{$errors->first('gender')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Zip Code') }}</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <input type="text" class="form-control" id="exampleInputnumber" name="zip_code"
                                                    placeholder="{{ __('Zip Code') }}" value="{{$user->zip_code}}">
                                                <span class="text-danger">{{$errors->first('zip_code')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Time Zone') }}</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <input type="text" class="form-control" id="exampleInputnumber"
                                                    placeholder="{{ __('Time Zone') }}" value="{{$user->timezone->name}}" readonly disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <x-location-selectable :selected-country="$user->country" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">{{ __('Active Status') }}</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <select class="form-control select2 form-select" name="is_active">
                                                <option value="1" @selected(true ? $user->is_active : false)>{{ __('Active') }}</option>
                                                <option value="0" @selected(true ? !$user->is_active : false)>{{ __('Inactive') }}</option>
                                            </select>
                                            <span class="text-danger">{{$errors->first('is_active')}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-success my-1">{{ __('Save') }}</button>
                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-danger my-1">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                    <form class="card" action="{{route('admin.users.destroy', $user->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="card-header">
                            <div class="card-title">{{ __('Delete Account') }}</div>
                        </div>
                        <div class="card-body">
                            <p>{{ __('Its Advisable for you to disable this account instead of deleting it. Use the button "Active Status" to disable this account.') }}</p>
                            <label class="custom-control custom-checkbox mb-0">
                                <input type="checkbox" class="custom-control-input" name="example-checkbox1"
                                    value="option1" checked>
                                <span class="custom-control-label">{{ __('Yes, Send my data to my Email.') }}</span>
                            </label>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-danger my-1">{{ __('Delete Account') }}</button>
                        </div>
                    </form>
                </div>
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