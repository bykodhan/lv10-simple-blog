@extends('auth.app')
@push('title', __('Giriş Yap'))
@section('content')
    <div class="container-fluid ps-md-0">
        <div class="row g-0">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
            <div class="col-md-8 col-lg-6">
                <div class="login d-flex align-items-center py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 col-lg-8 mx-auto">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger d-flex align-items-center mb-2" role="alert">
                                            <div>
                                                {{ $error }}
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="d-flex align-items-center justify-content-between">
                                    <h3 class="login-heading">
                                        {{ __('Hoşgeldiniz') }}
                                    </h3>
                                    <div class="">
                                        {{ __('Hesabınız yok mu?') }}
                                        <a class="small" href="{{ route('register') }}">
                                            {{ __('Kayıt Ol') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="alert alert-warning" role="alert">
                                    {{ __('Blog yazılarını görmek,paylaşmak,yorum yapabilmeniz için lütfen giris yapınız.') }}
                                </div>
                                <hr>
                                <!-- Sign In Form -->
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingInput"
                                            placeholder="name@example.com" required name="email">
                                        <label for="floatingInput">
                                            {{ __('Email') }}*
                                        </label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="floatingPassword"
                                            placeholder="{{ __('Parola') }}" required name="password">
                                        <label for="floatingPassword">
                                            {{ __('Parola') }}*
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" value="1"
                                            id="rememberPasswordCheck" name="remember">
                                        <label class="form-check-label" for="rememberPasswordCheck">
                                            {{ __('Beni Hatırla') }}
                                        </label>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2"
                                            type="submit">
                                            {{ __('Giriş Yap') }}
                                        </button>
                                        <div class="text-center">
                                            {{ __('Hesabınız yok mu?') }}
                                            <a class="small" href="{{ route('register') }}">
                                                {{ __('Kayıt Ol') }}
                                            </a>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
