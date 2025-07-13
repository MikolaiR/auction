@extends('partials.admin')
@section('title', __('Admin Translations'))
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'translations'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => __('Translations'), 'hasBack' => false])

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Translations Management') }}</h3>
                            <div class="card-options">
                                <a href="{{ route('admin.translations.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus"></i> {{ __('Add New Translation') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body pt-4">
                            <div class="grid-margin">
                               <div class="">
                                  <div class="panel panel-primary">
                                     <div class="panel-body tabs-menu-body border-0 pt-0">
                                        <div class="tab-content">
                                           <div class="tab-pane active">
                                              <div class="table-responsive">
                                                 <div id="data-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                    <div class="row">
                                                       <div class="col-sm-12">
                                                          <table id="translations-table" class="table table-bordered text-nowrap mb-0 dataTable no-footer">
                                                             <thead class="border-top">
                                                                <tr role="row">
                                                                   <th class="bg-transparent border-bottom-0 sorting" tabindex="0"
                                                                      aria-controls="translations-table" rowspan="1" colspan="1" style="width: 25%; max-width: 250px;">
                                                                      {{ __('Translation Key') }}
                                                                   </th>
                                                                   <th class="bg-transparent border-bottom-0 sorting" tabindex="0"
                                                                      aria-controls="translations-table" rowspan="1" colspan="1" style="width: 35%; max-width: 300px;">
                                                                      {{ __('English') }}
                                                                   </th>
                                                                   <th class="bg-transparent border-bottom-0 sorting" tabindex="0"
                                                                      aria-controls="translations-table" rowspan="1" colspan="1" style="width: 35%; max-width: 300px;">
                                                                      {{ __('Russian') }}
                                                                   </th>
                                                                   <th class="bg-transparent border-bottom-0 sorting" tabindex="0"
                                                                      aria-controls="translations-table" rowspan="1" colspan="1" style="width: 100px; min-width: 100px;">
                                                                      {{ __('Actions') }}
                                                                   </th>
                                                                </tr>
                                                             </thead>
                                                             <tbody>
                                                                @foreach ($translations as $translation)
                                                                <tr class="border-bottom odd text-wrap">
                                                                   <td style="max-width: 250px;">
                                                                      <div class="d-block">
                                                                         <p>{{ $translation['key'] }}</p>
                                                                      </div>
                                                                   </td>
                                                                   <td style="max-width: 300px;">
                                                                      <div class="d-block">
                                                                         <p>{{ $translation['en'] }}</p>
                                                                      </div>
                                                                   </td>
                                                                   <td style="max-width: 300px;">
                                                                      <div class="d-block">
                                                                         <p>{{ $translation['ru'] }}</p>
                                                                      </div>
                                                                   </td>
                                                                   <td>
                                                                      <div class="g-2">
                                                                         <a href="{{ route('admin.translations.edit', urlencode($translation['key'])) }}" 
                                                                            class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                                                            data-bs-original-title="{{ __('Edit') }}">
                                                                            <span class="fa-regular fa-edit fs-14"></span>
                                                                         </a>
                                                                         <form action="{{ route('admin.translations.destroy', urlencode($translation['key'])) }}" 
                                                                               method="POST" class="d-inline"
                                                                               onsubmit="return confirm('{{ __('Are you sure you want to delete this translation?') }}');">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                                                               data-bs-original-title="{{ __('Delete') }}">
                                                                               <span class="fa-regular fa-trash-can fs-14"></span>
                                                                            </button>
                                                                         </form>
                                                                      </div>
                                                                   </td>
                                                                </tr>
                                                                @endforeach
                                                             </tbody>
                                                          </table>
                                                       </div>
                                                    </div>
                                                 </div>
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                                </table>
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
<script src="/plugin/datatable/js/jquery.dataTables.min.js"></script>
<script src="/plugin/datatable/js/dataTables.bootstrap5.js"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#translations-table').DataTable({
            language: {
                searchPlaceholder: '{{ __('Search...') }}',
                sSearch: '',
            },
            order: [[0, 'asc']], // Sort by translation key
            responsive: true,
            dom: 'lrtip' // Remove default search box
        });
        
        // Custom search functionality
        $('#translation-search').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
</script>
@endpush
