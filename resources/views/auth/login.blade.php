@extends('layouts.app')

@section('content')
<div class="uk-position-center">
    <form class="uk-form-horizontal" method="post" action="{{ route('login') }}" novalidate>
        <div class="uk-card uk-card-default uk-card-hover">
            <div class="uk-card-header">
                <div class="uk-card-title">Login</div>
            </div>
            <div class="uk-card-body">
                    {{ csrf_field() }}
                    <div class="uk-margin">
                        <label for="email" class="uk-form-label {{ $errors->has('email') ? ' uk-text-danger' : '' }}">E-Mail Address</label>
                        <div class="uk-form-controls">
                            <input  class="uk-input {{ $errors->has('email') ? ' uk-form-danger' : '' }}"
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    autofocus required>
                            @if ($errors->has('email'))
                                <p class="uk-text-danger uk-text-small margin uk-margin-remove">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label for="password" class="uk-form-label {{ $errors->has('password') ? ' uk-text-danger' : '' }}">
                            Password
                        </label>
                        <div class="uk-form-controls">
                            <input class="uk-input {{ $errors->has('password') ? ' uk-form-danger' : '' }}" id="password" type="password" name="password" required>
                            @if ($errors->has('password'))
                                <p class="uk-text-danger uk-text-small uk-margin-remove">
                                    {{ $errors->first('password') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="uk-margin">
                        <input  class="uk-checkbox uk-margin-right"
                                id="remember"
                                type="checkbox"
                                name="password" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </div>
              </div>
              <div class="uk-card-footer">
                  <button type="submit" class="uk-button uk-button-primary uk-margin-right">Login</button>
                  <a href="{{ route('password.request') }}" class="uk-button uk-button-link uk-link-reset">Forgot your password?</a>
              </div>
        </div>
    </form>
</div>
@endsection
