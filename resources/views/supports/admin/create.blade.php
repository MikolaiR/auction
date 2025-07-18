@extends('partials.admin')
@section('title', __('Admin Create Support'))
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'support.create'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => __('Create Support'), 'hasBack' => true, 'backTitle' => __('All Support'), 'backUrl' => route('admin.support.index')])
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">{{ __('Create Support') }}</h3>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{route('admin.support.store')}}" method="POST">
                                            @csrf
                                            <x-input-item-field name="name" type="text" label="{{ __('Name *') }}" placeholder="{{ __('Enter Name') }}" />
                                            <x-input-item-field name="email" type="email" label="{{ __('Email *') }}" placeholder="{{ __('Enter Email') }}" />
                                            <x-input-item-field name="phone" type="text" label="{{ __('Phone') }}" placeholder="{{ __('Enter Phone') }}" />
                                            <x-input-item-field name="subject" type="text" label="{{ __('Subject *') }}" placeholder="{{ __('Enter Subject') }}" />
                                            <x-text-area-field name="message" label="{{ __('Message') }}" placeholder="{{ __('Enter Message') }}" :admin="true" />

                                            <div class="d-sm-flex pt-4">
                                                <div class="btn-list ms-auto my-auto">
                                                    <a href="{{route('admin.support.index')}}" class="btn btn-danger btn-space mb-0">{{ __('Cancel') }}</a>
                                                    <button type="submit" class="btn btn-primary btn-space mb-0">{{ __('Send message') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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