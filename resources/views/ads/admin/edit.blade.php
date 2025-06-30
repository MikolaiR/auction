@extends('partials.admin')
@section('title', 'Admin Ads Edit - ' . $ad->title)
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'ads.all'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => __('Ads Edit'), 'hasBack' => true, 'backTitle' => __('Ads Listing'), 'backUrl' => route('admin.ads.index')])
            <div class="row">
                <div class="col-lg-12">
                    <form class="card" method="POST" action="{{ route('admin.ads.update', $ad->slug) }}">
                        @method('PUT')
                        @csrf
                        <div class="card-header">
                            <div class="card-title">{{ __('Edit Ad Listing') }}</div>
                        </div>
                        <div class="card-body">
                            <x-input-item-field name="title" type="text" label="{{ __('Ad Title') }}" placeholder="{{ __('Enter Ad Title') }}" :value="$ad->title" />
                            <x-input-item-field name="price" type="number" label="{{ __('Starting Price') }}" placeholder="{{ __('Enter Starting Price') }}" value="{{ $ad->price }}" />
                            <x-input-item-field name="video_url" type="url" label="{{ __('Video URL') }}" placeholder="{{ __('Enter Video URL') }}" value="{{ $ad->video_url }}" />
                            <x-category-selectable :admin="true" :selected-category="$ad->category->slug"/>
                            <!-- Row -->
                            <x-text-area-field name="description" label="{{ __('Ad Description') }}" placeholder="{{ __('Enter Description') }}" :value="$ad->description" :admin="true" />
                            <!--End Row-->
                            <x-input-item-field name="start_date" type="datetime-local" label="{{ __('Start Date') }}" placeholder="{{ __('Enter Start Date') }}" :value="$ad->started_at" />
                            <x-input-item-field name="end_date" type="datetime-local" label="{{ __('End Date') }}" placeholder="{{ __('Enter End Date') }}" :value="$ad->expired_at" />
                            <!--Row-->
                            <div class="row">
                                <label class="col-md-3 form-label mb-4">{{ __('Product Upload') }}:</label>
                                <div class="col-md-9">
                                    <input id="demo" type="file" name="images[]" accept=".jpg, .png, image/jpeg, image/png" multiple>
                                </div>
                            </div>
                            <br>
                            <x-input-item-field name="seller_name" type="text" label="{{ __('Seller Name') }}" placeholder="{{ __('Enter Seller\'s Name') }}" :value="$ad->seller_name"  />
                            <x-input-item-field name="seller_email" type="email" label="{{ __('Seller Email') }}" placeholder="{{ __('Enter Seller\'s Email') }}" value="{{ $ad->seller_email }}" />
                            <x-input-item-field name="seller_mobile" type="text" label="{{ __('Seller Phone') }}" placeholder="{{ __('Enter Seller\'s Phone') }}" value="{{ $ad->seller_mobile }}" />
                            <x-input-item-field name="seller_address" type="text" label="{{ __('Seller Address') }}" placeholder="{{ __('Enter Seller\'s Address') }}" value="{{ $ad->seller_address }}" />
                            <x-ad-status-selectable :selected-status="$ad->status" />
                            <!--End Row-->
                        </div>
                        <div class="card-footer">
                            <!--Row-->
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-primary">{{ __('Update Ad Listing') }}</button>
                                    <a href="{{ route('admin.ads.show', $ad->slug) }}" class="btn btn-default float-end">{{ __('Discard') }}</a>
                                </div>
                            </div>
                            <!--End Row-->
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
<!-- INTERNAL File-Uploads Js-->
<script src="/plugin/fancyuploader/jquery.ui.widget.js"></script>
<script src="/plugin/fancyuploader/jquery.fileupload.js"></script>
<script src="/plugin/fancyuploader/jquery.iframe-transport.js"></script>
<script src="/plugin/fancyuploader/jquery.fancy-fileupload.js"></script>
<script src="/plugin/fancyuploader/fancy-uploader.js"></script>
<script>
    $(function() {
        // Используем простой подход с явным URL
        var uploadUrl = '{{ route("admin.ads.upload.images", $ad->slug) }}';

        // Останавливаем стандартное поведение формы
        $(document).on('submit', 'form', function(e) {
            // Если форма содержит поля для загрузки файлов, не отправляем их вместе с формой
            if ($(this).find('#demo').length) {
                e.preventDefault();
                // Отправляем форму без файлов
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize() + '&_method=PUT',
                    success: function(response) {
                        // Успешное сохранение формы
                        alert('{{ __('Form submitted successfully') }}');
                        window.location.href = '{{ route("admin.ads.index") }}';
                    },
                    error: function(xhr) {
                        // Обработка ошибок
                        console.error('{{ __('Form submission error') }}:', xhr);
                        alert('{{ __('Error saving form data') }}');
                    }
                });
            }
        });

        // Настраиваем FancyFileUpload с жестко заданным URL
        $('#demo').FancyFileUpload({
            url: uploadUrl,
            params: {
                _token: '{{ csrf_token() }}',
                action: 'fileuploader'
            },
            maxfilesize: 10000000,
            added: function(e, data) {
                // Перед отправкой файла задаем URL снова
                if (data.url === undefined || data.url.toString().indexOf('[object') !== -1) {
                    data.url = uploadUrl;
                }
                return true;
            }
        });
    });
</script>
@endpush
@push('styles')
<style>
    .ck .ck-powered-by {
        display: none !important;
    }
</style>

@endpush
