@extends('partials.admin')
@section('title', __('Admin Comments'))
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'blogs.comments'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => __('All Comments'), 'hasBack' => true, 'backTitle' => __('All Blogs'), 'backUrl' => route('admin.blogs.index')])

             <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">{{ __('All Comments') }}</h3>
                        </div>
                        <div class="">
                           <x-filter-admin-comment-card />
                        </div>
                        <div class="card-body pt-4">
                            <div class="grid-margin">
                                <div class="">
                                    <div class="panel panel-primary">
                                        <div class="panel-body tabs-menu-body border-0 pt-0">
                                            @if(count($comments) > 0)
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab5">
                                                    <div class="table-responsive">
                                                        <div id="data-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                            <div class="row">
                                                                <table id="data-table" class="table table-bordered text-nowrap mb-0">
                                                                    <thead class="border-top">
                                                                        <tr>
                                                                            <th
                                                                                class="bg-transparent border-bottom-0">
                                                                                {{ __('Author') }}</th>
                                                                            <th
                                                                                class="bg-transparent border-bottom-0">
                                                                                {{ __('Post Title') }}</th>
                                                                            <th
                                                                                class="bg-transparent border-bottom-0">
                                                                                {{ __('Content') }}</th>
                                                                            <th
                                                                                class="bg-transparent border-bottom-0">
                                                                               {{ __('Status') }}</th>
                                                                            <th class="bg-transparent border-bottom-0"
                                                                                style="width: 5%;">{{ __('Action') }}</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($comments as $comment)
                                                                        <tr class="border-bottom">
                                                                            <td>
                                                                                <h6 class="mb-0 fs-14 fw-semibold">{{$comment->user->name ?? $comment->admin->name}}</h6>
                                                                            </td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <h6 class="mb-0 fs-14 fw-semibold">{{$comment->post->title}}</h6>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                {{shorten_chars($comment->content, 20)}}
                                                                            </td>
                                                                            <td>
                                                                                <div class="mt-sm-1 d-block">
                                                                                    <span class="text-white badge bg-{{$comment->status->color()}}">{{ $comment->status->label() }}</span>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="mt-sm-1 d-flex">
                                                                                    <div class="btn-group">
                                                                                        <a class="btn text-primary btn-sm"
                                                                                            data-bs-target="#select2modalshow"
                                                                                            data-bs-toggle="modal"
                                                                                            href="javascript:;"
                                                                                            data-bs-original-title="{{ __('Show') }}"
                                                                                            onclick="showComment('{{ $comment->post->title }}', '{{ $comment->user->name ?? $comment->admin->name }}', '{{ $comment->content }}', '{{ $comment->status->label() }}', '{{ $comment->status->color() }}')"
                                                                                            ><span
                                                                                            class="fa-regular fa-eye fs-14"></span>
                                                                                        </a>
                                                                                        <a href="{{ route('admin.comments.edit', $comment->id) }}" class="btn text-dark btn-sm"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-original-title="{{ __('Edit') }}"><span
                                                                                                class="fa-regular fa-edit fs-14"></span>
                                                                                        </a>
                                                                                        <a class="btn text-danger btn-sm"
                                                                                            data-bs-target="#select2modaldelete"
                                                                                            data-bs-toggle="modal"
                                                                                            href="javascript:;"
                                                                                            data-bs-original-title="{{ __('Delete') }}"
                                                                                            onclick="deleteComment('{{ $comment->id }}', '{{ $comment->post->title }}', '{{ $comment->content }}', '{{ $comment->user->name ?? $comment->admin->name }}')"
                                                                                            ><span
                                                                                                class="fa-regular fa-trash-alt fs-14"></span>
                                                                                        </a>
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                            </td>
                                                                            
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            {{ $comments->links('pagination.admin') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <div class="text-center p-4">
                                                <img src="{{ asset('assets/images/icons/man.svg') }}" class="w-25" alt="empty">
                                                <h4 class="mt-3">{{ __('No Comment Found') }}</h4>
                                            </div>
                                            @endif
                                        </div>
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

 <!-- Select2 modal -->
 <div class="modal fade" id="select2modalshow">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('View Comment') }}</h6>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>{{ __('Comment for the post') }} <span id="show-title" class="fw-bold"></span></h4>
                <div id="show-content"></div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- End Select2 modal -->

 <!-- Select2 modal -->
<div class="modal fade" id="select2modaldelete">
    <div class="modal-dialog" role="document">
        <form class="modal-content modal-content-demo" id="delete-form" method="POST">
            @method('DELETE')
            @csrf
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Delete Comment') }}</h6>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>{{ __('Comment of post with the title') }} <span class="fw-bold" id="delete-title"></span> {{ __('will be deleted. This action cannot be undone.') }}</h6>
                <p class="mt-3"><span class="fw-bold">{{ __('Comment Content:') }}</span> <span id="delete-content"></span></p>
                <p class="mt-3">{{ __('By clicking on "Delete Comment" below, this comment will be deleted.') }}</p>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-success" type="submit">{{ __('Delete Comment') }}</button>
                <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">{{ __('Close') }}</button>
            </div>
        </form>
    </div>
</div>
<!-- End Select2 modal -->

@endsection
@push('scripts')
<script src="/plugin/select2/select2.full.min.js"></script>
<script src="/assets/js/select2.js"></script>

<script>
    function showComment(postTitle, author, content, status, statusColor) {
        document.getElementById('show-title').innerHTML = postTitle;
        document.getElementById('show-content').innerHTML = `
        <div class="row">
            <div class="col-md-12">
                <h6 class="mt-3">{{ __('Author') }}: ${author}</h6>
            </div>
            <div class="col-md-12">
                <h6 class="mt-3">{{ __('Content') }}: ${content}</h6>
            </div>
            <div class="col-md-12">
                <h6 class="mt-3 text-white badge bg-${statusColor}">{{ __('Status') }}: ${status}</h6>
            </div>
        </div>
        `;
    }

    function deleteComment(id, postTitle, content, author) {
        document.getElementById('delete-title').innerHTML = postTitle;
        document.getElementById('delete-content').innerHTML = content;
        const url = "{{ route('admin.comments.destroy', ':id') }}".replace(':id', id);
        document.getElementById('delete-form').action = url;
    }
</script>



@endpush