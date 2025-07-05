@extends('admin.layouts.app')

@section('title', 'Accreditation History')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Processed Accreditation Requests</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.accreditation.index') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-clipboard-list"></i> Pending Requests
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        
                        @if(count($processedRequests) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User</th>
                                            <th>Email</th>
                                            <th>Ownership Type</th>
                                            <th>Status</th>
                                            <th>Updated Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($processedRequests as $request)
                                            <tr>
                                                <td>{{ $request->id }}</td>
                                                <td>{{ $request->user->name }}</td>
                                                <td>{{ $request->user->email }}</td>
                                                <td>
                                                    @if($request->type_owner === 0)
                                                        Individual
                                                    @elseif($request->type_owner === 1)
                                                        Sole Proprietor
                                                    @elseif($request->type_owner === 3)
                                                        Company
                                                    @else
                                                        Unknown
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($request->status === 'approved')
                                                        <span class="badge badge-success">Approved</span>
                                                    @elseif($request->status === 'rejected')
                                                        <span class="badge badge-danger">Rejected</span>
                                                    @endif
                                                </td>
                                                <td>{{ $request->updated_at->format('M d, Y H:i') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.accreditation.show', $request->id) }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="d-flex justify-content-center mt-4">
                                {{ $processedRequests->links() }}
                            </div>
                        @else
                            <div class="alert alert-info">
                                No processed accreditation requests found.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
