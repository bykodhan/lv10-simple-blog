@extends('auth.app')
@push('title', __('Kayıt Ol'))
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
                                        {{ __('Hesabınız var mı ? Giriş Yap') }}
                                        <a class="small" href="#">
                                            {{ __('Giriş Yap') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="alert alert-warning" role="alert">
                                    {{ __('Blog yazılarını görmek,paylaşmak,yorum yapabilmeniz için lütfen kayıt olunuz') }}
                                </div>
                                <hr>
                                <!-- Sign In Form -->
                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInputname"
                                            placeholder="{{ __('Adınız...') }}" required name="name">
                                        <label for="floatingInputname">
                                            {{ __('Adınız..') }}*
                                        </label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInputsurname"
                                            placeholder="{{ __('Soyadınız...') }}" required name="surname">
                                        <label for="floatingInputsurname">
                                            {{ __('Soyadınız...') }}*
                                        </label>
                                    </div>
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
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="floatingPassword"
                                            placeholder="{{ __('Parola') }}" required name="password_confirmation">
                                        <label for="floatingPassword">
                                            {{ __('Parola Tekrar') }}*
                                        </label>
                                    </div>

                                    <div class="d-grid">
                                        <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2"
                                            type="submit">
                                            {{ __('Kayıt Ol') }}
                                        </button>
                                        <div class="text-center">
                                            {{ __('Hesabınız var mı ? Giriş Yap') }}
                                            <a class="small" href="#">
                                                {{ __('Giriş Yap') }}
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
