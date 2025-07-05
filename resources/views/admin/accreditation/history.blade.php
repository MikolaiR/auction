@extends('partials.admin')
@section('title', __('Accreditation History'))
@section('content')

    @include('layouts.header', ['admin' => true])
    @include('layouts.sidebar', ['admin' => true, 'active' => 'accreditation.history'])

    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => __('Ads Listing'), 'hasBack' => true, 'backTitle' => __('Dashboard'), 'backUrl' => route('admin.dashboard')])
                <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Processed Accreditation Requests') }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.accreditation.index') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-clipboard-list"></i> {{ __('Pending Requests') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        
                        @if(isset($requests) && count($requests) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>{{ __('User') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Ownership Type') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Updated Date') }}</th>
                                            <th>{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($requests as $request)
                                            <tr>
                                                <td>{{ $request->id }}</td>
                                                <td>{{ $request->user->name }}</td>
                                                <td>{{ $request->user->email }}</td>
                                                <td>
                                                    @if(isset($request->type_owner))
                                                        {{ $request->type_owner->label() }}
                                                    @else
                                                        {{ __('Unknown') }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($request->status === 'approved')
                                                        <span class="badge badge-success">{{ __('Approved') }}</span>
                                                    @elseif($request->status === 'rejected')
                                                        <span class="badge badge-danger">{{ __('Rejected') }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $request->updated_at->format('M d, Y H:i') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.accreditation.review', $request->id) }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-eye"></i> {{ __('Review') }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="d-flex justify-content-center mt-4">
                                {{ $requests->links() }}
                            </div>
                        @else
                            <div class="alert alert-info">
                                {{ __('No processed accreditation requests found.') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
