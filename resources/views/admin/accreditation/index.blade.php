@extends('partials.admin')
@section('title', __('Pending Accreditation'))
@section('content')

    @include('layouts.header', ['admin' => true])
    @include('layouts.sidebar', ['admin' => true, 'active' => 'accreditation.index'])

    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => __('Ads Listing'), 'hasBack' => true, 'backTitle' => __('Dashboard'), 'backUrl' => route('admin.dashboard')])
                <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Pending Accreditation Requests') }}</h3>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if(isset($requests) && count($requests) > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom">
                                        <thead>
                                        <tr>
                                            <th>{{ __('ID') }}</th>
                                            <th>{{ __('User') }}</th>
                                            <th>{{ __('Type') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Contact') }}</th>
                                            <th>{{ __('Submitted At') }}</th>
                                            <th>{{ __('Actions') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($requests as $request)
                                            <tr>
                                                <td>{{ $request->id }}</td>
                                                <td>
                                                    @if($request->user)
                                                        {{ $request->user->email }}
                                                    @else
                                                        {{ __('User not found') }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($request->type_owner == 0)
                                                        {{ __('Individual') }}
                                                    @elseif($request->type_owner == 1)
                                                        {{ __('Sole Proprietor') }}
                                                    @elseif($request->type_owner == 2)
                                                        {{ __('Organization') }}
                                                    @endif
                                                </td>
                                                <td>{{ $request->first_name }} {{ $request->last_name }}</td>
                                                <td>{{ $request->phone }}</td>
                                                <td>{{ $request->created_at->format('d.m.Y H:i') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.accreditation.review', $request->id) }}"
                                                       class="btn btn-primary btn-sm">
                                                        <i class="fa fa-eye"></i> {{ __('Review') }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-4">
                                    {{ $requests->links() }}
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <p>{{ __('No pending accreditation requests') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
