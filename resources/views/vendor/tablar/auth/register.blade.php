@extends('tablar::auth.layout')
@section('title', __('Register') . ' | ' . config('app.name'))
@section('content')
    <div class="container container-tight py-4">
        <div class="card card-md">
            <form action="{{ route('register') }}" method="post" autocomplete="off" novalidate>
                @csrf
                <div class="text-center mb-1 mt-5">
                    <a href="" class="navbar-brand navbar-brand-autodark">
                        <img src="{{ asset(config('tablar.auth_logo.img.path')) }}"
                            height="{{ config('tablar.auth_logo.img.height') }}"
                            width="{{ config('tablar.auth_logo.img.width') }}"
                            alt="{{ config('tablar.auth_logo.img.alt') }}"></a>
                </div>

                <div class="card-body">
                    <h2 class="card-title text-center mb-4">{{ __('Register') }}</h2>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Fullname') }}</label>
                        <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror"
                            placeholder="{{ __('Enter Fullname') }}">
                        @error('fullname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Email Address') }}</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="{{ __('Enter Email Address') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Username') }}</label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                            placeholder="{{ __('Enter Username') }}">
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Password') }}</label>
                        <div class="input-group input-group-flat">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="{{ __('Enter Password') }}" autocomplete="off">
                            <div class="input-group-text text-center">
                                <a href="#" class="link-secondary " title="{{ __('Show Password') }}"
                                    data-bs-toggle="tooltip">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{__('Confirm Password')}}</label>
                        <div class="input-group input-group-flat">
                            <input type="password" name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                placeholder="{{ __('Re-enter Password') }}" autocomplete="off">
                                <div class="input-group-text text-center">
                                    <a href="#" class="link-secondary " title="{{__('Show Password')}}"
                                        data-bs-toggle="tooltip">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                     
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">{{__('Register')}}</button>
                    </div>
                </div>
            </form>
             
        </div>
    @endsection
