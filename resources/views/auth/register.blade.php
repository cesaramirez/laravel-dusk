@extends('layouts.app')

@section('content')
<div class="uk-flex uk-flex-center uk-margin-top">
    <form class="uk-form-horizontal" method="POST" action="{{ route('register') }}" novalidate="">
        <div class="uk-card uk-card-default uk-card-hover">
            <div class="uk-card-header">
                <div class="uk-card-title">Register</div>
            </div>
            <div class="uk-card-body">
                {{ csrf_field() }}
                <div>
                    <label for="name" class="uk-form-label {{ $errors->has('name') ? 'uk-text-danger' : '' }}">Name</label>
                    <div class="uk-form-controls">
                        <input  id="name"
                                type="text"
                                class="uk-input {{ $errors->has('name') ? 'uk-form-danger' : '' }}"
                                name="name"
                                value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <p class="uk-text-danger uk-text-small uk-margin-remove">
                                        {{ $errors->first('name') }}
                                    </p>
                                @endif
                    </div>
                </div>
                <div class="uk-margin">
                    <label for="email" class="uk-form-label {{ $errors->has('email') ? 'uk-text-danger' : '' }}">E-Mail Address</label>
                    <div class="uk-form-controls">
                        <input  id="email"
                                type="email"
                                class="uk-input {{ $errors->has('email') ? 'uk-form-danger' : '' }}"
                                name="email"
                                value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <p class="uk-text-danger uk-text-small uk-margin-remove">
                                        {{ $errors->first('email') }}
                                    </p>
                                @endif
                    </div>
                </div>
                <div class="uk-margin">
                    <label for="password" class="uk-form-label {{ $errors->has('password') ? 'uk-text-danger' : '' }}">Password</label>
                    <div class="uk-form-controls">
                        <input  id="password"
                                type="password"
                                class="uk-input {{ $errors->has('password') ? 'uk-form-danger' : '' }}"
                                name="password"
                                required autofocus>
                                @if ($errors->has('password'))
                                    <p class="uk-text-danger uk-text-small uk-margin-remove">
                                        {{ $errors->first('password') }}
                                    </p>
                                @endif
                    </div>
                </div>
                <div class="uk-margin">
                    <label for="password-confirm" class="uk-form-label {{ $errors->has('password') ? 'uk-text-danger' : '' }}">Confirm Password</label>
                    <div class="uk-form-controls">
                        <input  id="password-confirm"
                                type="password"
                                class="uk-input {{ $errors->has('password') ? 'uk-form-danger' : '' }}"
                                name="password_confirmation"
                                required autofocus>
                                @if ($errors->has('password'))
                                    <p class="uk-text-danger uk-text-small uk-margin-remove">
                                        {{ $errors->first('password') }}
                                    </p>
                                @endif
                    </div>
                </div>
            </div>
            <div class="uk-card-footer">
                <button type="submit" class="uk-button uk-button-primary">Register</button>
            </div>
        </div>
    </form>
</div>
@endsection
