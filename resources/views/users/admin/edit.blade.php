@extends('partials.admin')
@section('title', 'Admin Users Edit')
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'users.edit'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'User', 'hasBack' => true, 'backTitle' =>
            'All Users', 'backUrl' => route('admin.users.index')])

            {{-- Отображение общих сообщений об ошибках и успешных операциях --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ __('Success!') }}</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ __('Error!') }}</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ __('Validation Error!') }}</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">{{ __('All User Edit') }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{ __('Password') }}</div>
                        </div>
                        <div class="card-body">
                            <div class="text-center chat-image mb-5">
                                <div class="avatar avatar-xxl chat-profile mb-3 brround">
                                    <a class="" href="#"><img alt="avatar" src="{{$user->avatar}}"
                                            class="brround"></a>
                                </div>
                                <div class="main-chat-msg-name">
                                    <a href="#">
                                        <h5 class="mb-1 text-dark fw-semibold">{{$user->name}}</h5>
                                    </a>
                                    <p class="text-muted mt-0 mb-0 pt-0 fs-13">{{'@'.$user->username}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('admin.users.request-password-reset', $user->id) }}"
                                class="btn btn-primary">{{ __('Request Password Change') }}</a>
                        </div>
                    </div>
                    <div class="card panel-theme">
                        <div class="card-header">
                            <div class="float-start">
                                <h3 class="card-title">{{ __('Contact') }}</h3>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="card-body no-padding">
                            <ul class="list-group no-margin">
                                <li class="list-group-item d-flex ps-3">
                                    <div class="social social-profile-buttons me-2">
                                        <a class="social-icon text-primary" href="javascript:void(0)"><i
                                                class="fa-regular fa-envelope"></i></a>
                                    </div>
                                    <a href="{{'mailto:'.$user->email}}" class="my-auto">{{$user->email}}</a>
                                </li>
                                <li class="list-group-item d-flex ps-3">
                                    <div class="social social-profile-buttons me-2">
                                        <a class="social-icon text-primary" href="javascript:void(0)"><i
                                                class="fa-regular fa-globe"></i></a>
                                    </div>
                                    <a href="https://maps.google.com?q={{$user->address}}"
                                        class="my-auto">{{$user->address}}
                                </li>
                                <li class="list-group-item d-flex ps-3">
                                    <div class="social social-profile-buttons me-2">
                                        <a class="social-icon text-primary" href="javascript:void(0)"><i
                                                class="fa-regular fa-phone"></i></a>
                                    </div>
                                    <a href="{{'tel:'.$user->mobile}}" class="my-auto">{{$user->mobile}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <form class="card" action="{{route('admin.users.update', $user->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Edit Profile') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputname">{{ __('First Name') }}</label>
                                        <input type="text" name="first_name" class="form-control" id="exampleInputname"
                                            placeholder="First Name" value="{{$user->first_name}}">
                                    </div>
                                    <span class="text-danger">{{$errors->first('first_name')}}</span>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputname1">{{ __('Last Name') }}</label>
                                        <input type="text" class="form-control" id="exampleInputname1" name="last_name"
                                            placeholder="{{ __('Enter Last Name') }}" value="{{$user->last_name}}">
                                    </div>
                                    <span class="text-danger">{{$errors->first('last_name')}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('Username') }}</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="{{ __('Username') }}" disabled readonly
                                    value="{{$user->username}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('Email address') }}</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    placeholder="{{ __('Email address') }}" value="{{$user->email}}" readonly disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputnumber">{{ __('Contact Number') }}</label>
                                <input type="text" class="form-control" id="exampleInputnumber"
                                    placeholder="{{ __('Contact number') }}" value="{{$user->mobile}}" readonly disabled>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{ __('Address') }}</label>
                                <input class="form-control" placeholder="{{ __('Home Address') }}" value="{{$user->address}}" name="address">
                                <span class="text-danger">{{$errors->first('address')}}</span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Gender') }}</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <select class="form-control select2 form-select" name="gender"
                                                    <option>All</option>
                                                    @foreach (\App\Enums\Gender::all() as $gender)
                                                    <option value="{{$gender}}" @selected(true ? $user->gender ===
                                                        $gender : false)>{{$gender->label()}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">{{$errors->first('gender')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Zip Code') }}</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <input type="text" class="form-control" id="exampleInputnumber" name="zip_code"
                                                    placeholder="{{ __('Zip Code') }}" value="{{$user->zip_code}}">
                                                <span class="text-danger">{{$errors->first('zip_code')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Time Zone') }}</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <input type="text" class="form-control" id="exampleInputnumber"
                                                    placeholder="{{ __('Time Zone') }}"
                                                       value="{{ isset($user->timezone) ? $user->timezone->name : '' }}"
                                                       readonly disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Добавление полей для редактирования UserData --}}
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">{{ __('User Data Information') }}</h3>
                                        </div>
                                        <div class="card-body">
                                            {{-- Общие поля для всех типов пользователей --}}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('User Type') }}</label>
                                                        <select class="form-control select2 form-select" name="user_data[type_owner]" id="user_type_select">
                                                            @foreach(\App\Enums\TypeOwners::cases() as $type)
                                                                <option value="{{ $type->value }}" @if($user->userData && $user->userData->type_owner == $type) selected @endif>
                                                                    {{ $type->label() }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('user_data.type_owner')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('Full Name') }}</label>
                                                        <input type="text" class="form-control" name="user_data[fio]" 
                                                               value="{{ $user->userData->fio ?? old('user_data.fio') }}" 
                                                               placeholder="{{ __('Full Name') }}">
                                                        @error('user_data.fio')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('Phone') }}</label>
                                                        <input type="text" class="form-control" name="user_data[phone]" 
                                                               value="{{ $user->userData->phone ?? old('user_data.phone') }}" 
                                                               placeholder="{{ __('Phone Number') }}">
                                                        @error('user_data.phone')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('Email') }}</label>
                                                        <input type="email" class="form-control" name="user_data[email]" 
                                                               value="{{ $user->userData->email ?? old('user_data.email') }}" 
                                                               placeholder="{{ __('Email') }}">
                                                        @error('user_data.email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('Region') }}</label>
                                                        <input type="text" class="form-control" name="user_data[region]" 
                                                               value="{{ $user->userData->region ?? old('user_data.region') }}" 
                                                               placeholder="{{ __('Region') }}">
                                                        @error('user_data.region')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('Address') }}</label>
                                                        <input type="text" class="form-control" name="user_data[address]" 
                                                               value="{{ $user->userData->address ?? old('user_data.address') }}" 
                                                               placeholder="{{ __('Address') }}">
                                                        @error('user_data.address')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            {{-- Поля для физических лиц --}}
                                            <div class="user-type-fields individual-fields" id="individual-fields">
                                                <hr>
                                                <h4>{{ __('Passport Information') }}</h4>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">{{ __('Passport Series') }}</label>
                                                            <input type="text" class="form-control" name="user_data[passport_series]" 
                                                                   value="{{ $user->userData->passport_series ?? old('user_data.passport_series') }}" 
                                                                   placeholder="{{ __('Passport Series') }}">
                                                            @error('user_data.passport_series')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">{{ __('Passport Number') }}</label>
                                                            <input type="text" class="form-control" name="user_data[passport_number]" 
                                                                   value="{{ $user->userData->passport_number ?? old('user_data.passport_number') }}" 
                                                                   placeholder="{{ __('Passport Number') }}">
                                                            @error('user_data.passport_number')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">{{ __('Passport Issued By') }}</label>
                                                            <input type="text" class="form-control" name="user_data[passport_issued_by]" 
                                                                   value="{{ $user->userData->passport_issued_by ?? old('user_data.passport_issued_by') }}" 
                                                                   placeholder="{{ __('Passport Issued By') }}">
                                                            @error('user_data.passport_issued_by')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">{{ __('Passport Issued Date') }}</label>
                                                            <input type="date" class="form-control" name="user_data[passport_issued_date]" 
                                                                   value="{{ $user->userData->passport_issued_date ?? old('user_data.passport_issued_date') }}" 
                                                                   placeholder="{{ __('Passport Issued Date') }}">
                                                            @error('user_data.passport_issued_date')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            {{-- Поля для ИП --}}
                                            <div class="user-type-fields commerce-fields" id="commerce-fields">
                                                <hr>
                                                <h4>{{ __('Business Information') }}</h4>
                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">{{ __('UNP') }}</label>
                                                            <input type="text" class="form-control" name="user_data[unp]" 
                                                                   value="{{ $user->userData->unp ?? old('user_data.unp') }}" 
                                                                   placeholder="{{ __('UNP') }}">
                                                            @error('user_data.unp')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            {{-- Поля для организаций --}}
                                            <div class="user-type-fields organization-fields" id="organization-fields">
                                                <hr>
                                                <h4>{{ __('Company Information') }}</h4>
                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">{{ __('Company Name') }}</label>
                                                            <input type="text" class="form-control" name="user_data[company_name]" 
                                                                   value="{{ $user->userData->company_name ?? old('user_data.company_name') }}" 
                                                                   placeholder="{{ __('Company Name') }}">
                                                            @error('user_data.company_name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">{{ __('Additional Information') }}</label>
                                                            <textarea class="form-control" name="user_data[info]" rows="3" 
                                                                     placeholder="{{ __('Additional Information') }}">{{ $user->userData->info ?? old('user_data.info') }}</textarea>
                                                            @error('user_data.info')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">{{  __('Active Status') }}</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <select class="form-control select2 form-select" name="is_active">
                                                <option value="1" @selected(true ? $user->is_active : false)>{{ __('Active') }}</option>
                                                <option value="0" @selected(true ? !$user->is_active : false)>{{ __('Inactive') }}</option>
                                            </select>
                                            <span class="text-danger">{{$errors->first('is_active')}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-success my-1">{{ __('Save') }}</button>
                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-danger my-1">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                    <form class="card" action="{{route('admin.users.destroy', $user->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="card-header">
                            <div class="card-title">{{ __('Delete Account') }}</div>
                        </div>
                        <div class="card-body">
                            <p>{{ __('Its Advisable for you to disable this account instead of deleting it. Use the button "Active
                                Status" to disable this account.') }}</p>
                            <label class="custom-control custom-checkbox mb-0">
                                <input type="checkbox" class="custom-control-input" name="example-checkbox1"
                                    value="option1" checked>
                                <span class="custom-control-label">{{ __('Yes, Send my data to my Email.') }}</span>
                            </label>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-danger my-1">{{ __('Delete Account') }}</button>
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
<script src="/plugin/select2/select2.full.min.js"></script>
<script src="/assets/js/select2.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Инициализация формы при загрузке страницы
        initUserTypeFields();
        
        // Слушаем изменения в селекте типа пользователя
        document.getElementById('user_type_select').addEventListener('change', function() {
            initUserTypeFields();
        });
        
        // Функция для управления видимостью полей в зависимости от типа пользователя
        function initUserTypeFields() {
            const userType = document.getElementById('user_type_select').value;
            
            // Отключаем все поля во всех блоках сначала
            document.querySelectorAll('.user-type-fields input, .user-type-fields textarea, .user-type-fields select').forEach(function(el) {
                el.disabled = true;
            });
            
            // Скрываем все специфичные поля
            document.querySelectorAll('.user-type-fields').forEach(function(el) {
                el.style.display = 'none';
            });
            
            // Показываем поля в зависимости от типа пользователя и активируем в них инпуты
            if (userType == '0') { // INDIVIDUAL
                document.getElementById('individual-fields').style.display = 'block';
                document.querySelectorAll('#individual-fields input, #individual-fields textarea, #individual-fields select').forEach(function(el) {
                    el.disabled = false;
                });
            } else if (userType == '1') { // COMMERCE
                document.getElementById('commerce-fields').style.display = 'block';
                document.querySelectorAll('#commerce-fields input, #commerce-fields textarea, #commerce-fields select').forEach(function(el) {
                    el.disabled = false;
                });
            } else if (userType == '3') { // ORGANIZATION
                document.getElementById('organization-fields').style.display = 'block';
                document.querySelectorAll('#organization-fields input, #organization-fields textarea, #organization-fields select').forEach(function(el) {
                    el.disabled = false;
                });
            }
        }
    });
</script>
@endpush
