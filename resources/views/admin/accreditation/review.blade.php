@extends('partials.admin')

@section('title', 'Review Accreditation')

@push('styles')
    <style>
        .document-card {
            transition: transform 0.2s;
        }

        .document-card:hover {
            transform: scale(1.02);
        }

        .status-badge {
            font-size: 1rem;
        }
    </style>
@endpush

@section('content')

    @include('layouts.header', ['admin' => true])
    @include('layouts.sidebar', ['admin' => true, 'active' => 'accreditation.review'])

    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => __('Ads Listing'), 'hasBack' => true, 'backTitle' => __('Dashboard'), 'backUrl' => route('admin.dashboard')])
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Accreditation Review: {{ $userData->user->name }}
                                    @if(isset($userData->status))
                                        <span class="badge ml-2">{{ __($userData->status) }}</span>
                                    @endif
                                </h3>
                                <div class="card-tools">
                                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">{{ __('User Information') }}</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <td>{{ $userData->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Email') }}</th>
                                        <td>{{ $userData->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Registration Date') }}</th>
                                        <td>{{ $userData->user->created_at->format('M d, Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Submission Date') }}</th>
                                        <td>{{ $userData->updated_at->format('M d, Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Ownership Type') }}</th>
                                        <td>
                                            @if(isset($userData->type_owner))
                                                {{ $userData->type_owner->label() }}
                                            @else
                                                {{ __('Unknown') }}
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="mb-0">{{ __('Contact Information') }}</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <tr>
                                        <th>{{ __('Full Name') }}</th>
                                        <td>{{ $userData->fio }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Phone') }}</th>
                                        <td>{{ $userData->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Region') }}</th>
                                        <td>{{ $userData->region }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Address') }}</th>
                                        <td>{{ $userData->address }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        @if($userData->type_owner === \App\Enums\TypeOwners::INDIVIDUAL)
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">{{ __('Passport Information') }}</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>{{ __('Passport Series') }}</th>
                                            <td>{{ $userData->passport_series }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Passport Number') }}</th>
                                            <td>{{ $userData->passport_number }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Issued By') }}</th>
                                            <td>{{ $userData->passport_issued_by }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Issue Date') }}</th>
                                            <td>{{ $userData->passport_issued_date }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @elseif($userData->type_owner === \App\Enums\TypeOwners::COMMERCE)
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">{{ __('Sole Proprietor Information') }}</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>{{ __('UNP (Tax ID)') }}</th>
                                            <td>{{ $userData->unp }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @elseif($userData->type_owner === \App\Enums\TypeOwners::ORGANIZATION)
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">{{ __('Company Information') }}</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>{{ __('Company Name') }}</th>
                                            <td>{{ $userData->company_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('UNP (Tax ID)') }}</th>
                                            <td>{{ $userData->unp }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Additional Info') }}</th>
                                            <td>{{ $userData->info ?? 'Not provided' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endif

                        @if($userData->admin_comment)
                            <div class="card mt-4">
                                <div class="card-header bg-info text-white">
                                    <h5 class="mb-0">{{ __('Admin Comment') }}</h5>
                                </div>
                                <div class="card-body">
                                    {{ $userData->admin_comment }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Documents Section -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">{{ __('Uploaded Documents') }}</h5>
                            </div>
                            <div class="card-body">
                                @if($userData->documents)
                                    <div class="row">
                                        @foreach(json_decode($userData->documents, true) as $index => $document)
                                            <div class="col-md-4 mb-4">
                                                <div class="card document-card h-100">
                                                    <div class="card-body">
                                                        <h6 class="card-title text-truncate">
                                                            <i class="fas {{ Str::endsWith($document['name'], '.pdf') ? 'fa-file-pdf' : 'fa-file-image' }} mr-2"></i>
                                                            {{ $document['name'] }}
                                                        </h6>
                                                        <p class="card-text">
                                                            <small class="text-muted">
                                                                Size: {{ round($document['size'] / 1024 / 1024, 2) }} MB<br>
                                                                Type: {{ $document['type'] }}
                                                            </small>
                                                        </p>
                                                    </div>
                                                    <div class="card-footer bg-white">
                                                        <a href="{{ Storage::url($document['path']) }}" target="_blank"
                                                           class="btn btn-sm btn-primary">
                                                            <i class="fas fa-eye"></i> {{ __('View') }}
                                                        </a>
                                                        <a href="{{ Storage::url($document['path']) }}" download
                                                           class="btn btn-sm btn-secondary">
                                                            <i class="fas fa-download"></i> {{ __('Download') }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="alert alert-warning">{{ __('No documents uploaded.') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons Section -->
                @if($userData->status === 'pending')
                    <div class="row mt-4 mb-5">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">{{ __('Take Action') }}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form action="{{ route('admin.accreditation.approve', $userData->id) }}"
                                                  method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="approve-comment">{{ __('Comment (Optional)') }}</label>
                                                    <textarea name="comment" id="approve-comment" class="form-control"
                                                              rows="3"
                                                              placeholder="{{ __('Add an optional comment for the user') }}"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-success btn-lg btn-block">
                                                    <i class="fas fa-check-circle"></i> {{ __('Approve Accreditation') }}
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-6">
                                            <form action="{{ route('admin.accreditation.reject', $userData->id) }}"
                                                  method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="reject-comment">{{ __('Rejection Reason') }} <span
                                                            class="text-danger">*</span></label>
                                                    <textarea name="comment" id="reject-comment"
                                                              class="form-control @error('comment') is-invalid @enderror"
                                                              rows="3"
                                                              placeholder="Explain why this submission is rejected"
                                                              required></textarea>
                                                    @error('comment')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-danger btn-lg btn-block">
                                                    <i class="fas fa-times-circle"></i> {{ __('Reject & Request Resubmission') }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
@endsection
