@extends('partials.admin')
@section('title', __('Admin Users Create'))
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'users.create'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => __('User'), 'hasBack' => true, 'backTitle' =>
            __('All Users'), 'backUrl' => route('admin.users.index')])

            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">{{ __('Create User') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <form class="card" action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputname">{{ __('First Name') }}</label>
                                        <input type="text" class="form-control" id="exampleInputname" placeholder="{{ __('First Name') }}" name="first_name">
                                        <span class="text-danger">{{$errors->first('first_name')}}</span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputname1">{{ __('Last Name') }}</label>
                                        <input type="text" class="form-control" id="exampleInputname1" placeholder="{{ __('Enter Last Name') }}" name="last_name">
                                        <span class="text-danger">{{$errors->first('last_name')}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('Username') }}</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="{{ __('Username') }}" name="username">
                                <span class="text-danger">{{$errors->first('username')}}</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('Email address') }}</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="{{ __('Email address') }}" name="email">
                                <span class="text-danger">{{$errors->first('email')}}</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputnumber">{{ __('Contact Number') }}</label>
                                <input type="text" class="form-control" id="exampleInputnumber" placeholder="{{ __('Contact number') }}" name="mobile">
                                <span class="text-danger">{{$errors->first('mobile')}}</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputnumber">{{ __('Address') }}</label>
                                <input type="text" class="form-control" id="exampleInputnumber" placeholder="{{ __('Address') }}" name="address">
                                <span class="text-danger">{{$errors->first('address')}}</span>
                            </div>
                            
                            <x-countries-selectable :admin="true" />

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="zip_code">{{ __('Zip Code') }}</label>
                                        <input type="text" class="form-control" id="zip_code" placeholder="{{ __('Zip Code') }}" name="zip_code">
                                        <span class="text-danger">{{$errors->first('zip_code')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Gender') }}</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <select class="form-control select2 form-select" name="gender"
                                                    <option>{{ __('All') }}</option>
                                                    @foreach (\App\Enums\Gender::all() as $gender)
                                                    <option value="{{$gender}}">{{$gender->label()}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">{{$errors->first('gender')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Active Status') }}</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <select class="form-control select2 form-select" name="is_active">
                                                    <option value="1">{{ __('Active') }}</option>
                                                    <option value="0">{{ __('Inactive') }}</option>
                                                </select>
                                                <span class="text-danger">{{$errors->first('is_active')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputname">{{ __('Password') }}</label>
                                        <input type="password" class="form-control" id="exampleInputname" placeholder="{{ __('Enter Password') }}" name="password">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputname1">{{ __('Confirm Password') }}</label>
                                        <input type="password" class="form-control" id="exampleInputname1" placeholder="{{ __('Enter Confirm Password') }}" name="password_confirmation">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-success my-1">{{ __('Save') }}</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-danger my-1">{{ __('Cancel') }}</a>
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