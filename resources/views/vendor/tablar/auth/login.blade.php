@extends('tablar::auth.layout')
@section('title', __('Login') . ' | ' . config('app.name'))
@section('content')
    <div class="container container-tight py-4">

        <div class="card card-md">
            <form action="{{ route('login') }}" method="post" autocomplete="off" novalidate>
                @csrf
                <div class="text-center mb-1 mt-5">
                    <a href="" class="navbar-brand navbar-brand-autodark">
                        <img src="{{ asset(config('tablar.auth_logo.img.path')) }}"
                            height="{{ config('tablar.auth_logo.img.height') }}"
                            width="{{ config('tablar.auth_logo.img.width') }}"
                            alt="{{ config('tablar.auth_logo.img.alt') }}"></a>
                </div>
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">{{ __('Login') }}</h2>

                    
                    <div class="mb-3">
                        <label class="form-label" for="emailOrUsername">{{__('Email Address or Username')}}</label>
                        <input type="text" class="form-control @error('emailOrUsername') is-invalid @enderror" name="emailOrUsername"
                            placeholder="{{__('Enter Email Address or Username')}}" autocomplete="off">
                        @error('emailOrUsername')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="paswword">{{__('Password')}}
                            <span class="form-label-description">
                                <a href="{{ route('password.request') }}">{{__('I Forgot Password')}}</a>
                            </span>
                        </label>
                        <div class="input-group">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="{{__('Enter Password')}}"
                                autocomplete="off">
                            <div class="input-group-text text-center">
                                <a href="#" class="link-secondary " title="{{__('Show Password')}}"
                                    data-bs-toggle="tooltip">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">{{__('Login')}}</button>
                    </div>
            </form>
        </div> 
    </div>
    
    </div>
@endsection
