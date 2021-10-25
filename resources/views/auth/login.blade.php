@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ __('translate.Login') }}</div>

                <div class="card-body">

                    @if (session('message'))
                        <div class="alert alert-danger">{{ session('message') }}</div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('translate.E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('translate.Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('translate.Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary text-uppercase">
                                    {{ __('translate.Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-uppercase" href="{{ route('password.request') }}">
                                        {{ __('translate.Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">{{ __('translate.Become a member') }}</div>

                <div class="card-body">
                    <ul class="list-unstyled">
                        <li>
                            Želeli biste da nudite na nekoj aukciji koja vam je zanimljiva?
                        </li>
                        <li>
                            Hteli biste nešto da prodate, ali još uvek nemate svoj nalog?
                        </li>
                    </ul>
                    <div class="row">
                        <div class="col-12">
                            <a class="btn btn-primary float-right text-uppercase" href="{{ route('register') }}">
                                {{ __('translate.Continue') }} »
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    {{ __('translate.Security') }}
                </div>

                <div class="card-body">
                    <ul class="list-unstyled">
                        <li>
                            Vaš nalog i podaci su sigurni
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
