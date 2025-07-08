@extends('partials.app')
@section('title', __('Add Listing'))
@section('description', __('Add your listing to the auction, and get the best price for your item.'))
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => __('Add Listing')])

<div class="pt-120 pb-120">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                    @guest('web')
                    <x-alert type="warning" icon="exclamation-triangle">
                        <p class="mb-0">{!! __('You are posting as a guest. If you have an account, please <a class="fw-bold" href=":login_url">login</a> to have your listing associated with your account.', ['login_url' => route('user.login')]) !!}</p>
                    </x-alert>
                    @endguest
                    @if (!$isAccreditation)
                        <x-alert type="warning" icon="exclamation-triangle">
                            <p class="mb-0">{!! __('You have not been accredited to add a lot, please follow the <a class="fw-bold" href="user/accreditation">link</a> to have your listing associated with your account.', ['login_url' => route('user.login')]) !!}</p>
                        </x-alert>
                    @endif
                    <x-alert type="info" icon="info-circle" dismissible="true">
                        <p class="mb-0">{{ __('Once you submit your listing, it will be reviewed by our team. Once approved, it will be listed on the auction.') }}</p>
                    </x-alert>
                    <form class="w-100" action="{{ route('add-listing.handle') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-section">
                                <h4>{{ __('Lisiting Information') }}</h4>
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="title" type="text" label="{{ __('Auction Title') }}" placeholder="{{ __('Enter Auction Title') }}" value="{{ old('title') }}" />
                            </div>
                            <div class="col-md-12">
                                <x-textarea-field name="description" label="{{ __('Auction Description') }}"
                                    placeholder="{{ __('Enter Description') }}" value="{{ old('description') }}" :admin="false" />
                            </div>
                            <div class="col-md-6">
                                <x-input-field name="price" type="number" label="{{ __('Starting Price') }}"
                                    placeholder="{{ __('Enter Starting Price') }}" value="{{ old('price') }}" />
                            </div>
                            <div class="col-md-6">
                                <x-input-field name="quantity" type="number" label="{{ __('Quantity') }}"
                                    placeholder="{{ __('Enter Quantity') }}" value="{{ old('quantity') }}" />
                            </div>
                            <div class="col-md-6">
                                <x-input-field name="start_date" type="datetime-local" label="{{ __('Start Date') }}"
                                    placeholder="{{ __('Enter Start Date') }}" value="{{ old('start_date') }}" />
                            </div>
                            <div class="col-md-6">
                                <x-input-field name="end_date" type="datetime-local" label="{{ __('End Date') }}"
                                    placeholder="{{ __('Enter End Date') }}" value="{{ old('end_date') }}" />
                            </div>
                            <div class="row">
                                <x-category-selectable :admin="false" />
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <x-input-field name="images[]" type="file" label="{{ __('Upload Image') }}"
                                        placeholder="{{ __('Upload Image') }}" />
                                </div>
                                <div class="col-md-6">
                                    <x-input-field name="images[]" type="file" label="{{ __('Upload Image') }}"
                                        placeholder="{{ __('Upload Image') }}" />
                                </div>
                            </div>
                            {{-- add more images button --}}
                            <div class="col-md-12">
                                <button type="button" class="images-btn"><i class="bi bi-plus"></i> {{ __('Add More Images') }}</button>
                            </div>
                            <div class="form-section">
                                <h4>{{ __('Video') }}</h4>
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="video_url" type="url" label="{{ __('Video URL') }}"
                                    placeholder="{{ __('Enter Video URL') }}" value="{{ old('video_url') }}" />
                                <p class="text-muted">{{ __('Please enter a valid video URL from YouTube or Vimeo, ex. https://www.youtube.com/watch?v=video_id') }}</p>
                            </div>
                            <div class="form-section">
                                <h4>{{ __('Location') }}</h4>
                            </div>
                            <x-countries-selectable :admin="false"/>
                            <div class="col-md-6">
                                <x-input-field name="address" type="text" label="{{ __('Address') }}"
                                    placeholder="{{ __('Enter Address') }}" value="{{old('address') }}" />
                            </div>
                            <div class="form-section">
                                <h4>{{ __('Seller Information') }}</h4>
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="seller_name" type="text" label="{{ __('Seller Name') }}"
                                    placeholder="{{ __('Enter Seller Name') }}" :value="old('seller_name') ?? auth()->user()->name ?? '' " />
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="seller_email" type="email" label="{{ __('Seller Email') }}"
                                    placeholder="{{ __('Enter Seller Email') }}" :value="old('seller_email') ?? auth()->user()->email ?? ''" />
                            </div>
                            <x-phone-selectable name="seller_mobile" label="{{ __('Seller Phone') }}"
                                placeholder="{{ __('Enter Seller Phone') }}" :value="old('seller_mobile') ?? auth()->user()->mobile ?? ''" />
                            <div class="col-md-12">
                                <x-input-field name="seller_address" type="text" label="{{ __('Seller Address') }}"
                                    placeholder="{{ __('Enter Seller Address') }}" :value="old('seller_address') ?? auth()->user()->address ?? ''" />
                            </div>
                            <div class="col-md-12">
                                <x-agree-checkbox
                                    class="form-agreement form-inner d-flex justify-content-between flex-wrap" id="html"
                                    name="terms" label="{{ __('I agree to the Terms & Policy') }}" />
                            </div>
                        </div>
                        <button class="account-btn">{{ __('Create Listing') }}</button>
                    </form>
                    <div class="form-poicy-area">
                        <p>{!! __('By clicking the "create listing" button, you create a Auction Engine account, and you agree to Auction Engine\'s <a href="#">Terms & Conditions</a> & <a href="#">Privacy Policy.</a>') !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<x-metric-card />

@endsection
@push('scripts')
<script>
    // Create a new input field for images
    function createNewInputField() {
        return `<div class="col-md-6">
                    <x-input-field name="images[]" type="file" label="{{ __('Upload Image') }}" placeholder="{{ __('Upload Image') }}" />
                </div>`;
    }

    // Add new input field for images
    function addNewInputField() {
        let newInputField = createNewInputField();
        let imagesBtn = document.querySelector('.images-btn');
        let newInputFieldElement = document.createElement('div');
        newInputFieldElement.innerHTML = newInputField;
        imagesBtn.parentNode.insertBefore(newInputFieldElement, imagesBtn);
        if (document.querySelectorAll('input[name="images[]"]').length == 5) {
            imagesBtn.style.display = 'none';
        }
    }

    // Add event listener to the button
    document.querySelector('.images-btn').addEventListener('click', addNewInputField);

</script>
@endpush
