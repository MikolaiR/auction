@extends('partials.admin')
@section('title', __('Add Translation'))
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'translations'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => __('Add Translation'), 'hasBack' => true, 'backTitle' => __('All Translations'), 'backUrl' => route('admin.translations.index')])

            <div class="row">
                <div class="col-lg-12">
                    <form class="card" method="POST" action="{{ route('admin.translations.store') }}">
                        @csrf
                        <div class="card-header">
                            <div class="card-title">{{ __('Add Translation') }}</div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <label class="col-md-3 form-label">{{ __('Translation Key *') }}:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control @error('key') is-invalid @enderror" 
                                           name="key" value="{{ old('key') }}" 
                                           placeholder="{{ __('Enter translation key') }}" required>
                                    @error('key')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label class="col-md-3 form-label">{{ __('English Translation *') }}:</label>
                                <div class="col-md-9">
                                    <textarea class="form-control @error('en') is-invalid @enderror" 
                                           name="en" placeholder="{{ __('Enter English translation') }}" 
                                           rows="3" required>{{ old('en') }}</textarea>
                                    @error('en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label class="col-md-3 form-label">{{ __('Russian Translation *') }}:</label>
                                <div class="col-md-9">
                                    <textarea class="form-control @error('ru') is-invalid @enderror" 
                                           name="ru" placeholder="{{ __('Enter Russian translation') }}" 
                                           rows="3" required>{{ old('ru') }}</textarea>
                                    @error('ru')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-primary">{{ __('Add Translation') }}</button>
                                    <a href="{{ route('admin.translations.index') }}" class="btn btn-default float-end">{{ __('Cancel') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- CONTAINER END -->
    </div>
</div>

@endsection
