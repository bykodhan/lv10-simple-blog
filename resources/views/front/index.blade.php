@extends('front.layouts.app')
@push('title', __('Task Blog Anasayfa'))
@section('content')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('{{ asset('front/assets/img/home-bg.jpg') }}')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>
                            {{ __('Task Blog') }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                @guest
                    <div class="alert alert-warning" role="alert">
                        {{ __('Blog yazılarını görmek,paylaşmak,yorum yapabilmeniz için lütfen giriş yapınız') }}
                    </div>
                @endguest
                @auth
                    @if ($posts->count() > 0)
                        @foreach ($posts as $post)
                            <div class="post-preview">
                                <a href="{{ route('posts.show', $post->slug) }}">
                                    <h2 class="post-title">
                                        {{ $post->title }}
                                    </h2>
                                    <h3 class="post-subtitle">
                                        {{ $post->meta_description }}
                                    </h3>
                                </a>
                                <p class="post-meta">
                                    {{ __('Yazar') }} :
                                    <a href="#!">
                                        {{ $post->author->name }} {{ $post->author->surname }} <small>({{ $post->author->email }})</small>
                                    </a>
                                    {{ __('Tarih') }} :
                                    {{ $post->created_at->translatedFormat('F d, Y') }}
                                </p>
                            </div>
                            <!-- Divider-->
                            <hr class="my-4" />
                            <!-- Post preview-->
                        @endforeach
                        <!-- Pager-->
                        <div class="d-flex justify-content-end mb-4">
                            {{ $posts->links() }}
                        </div>
                    @else
                        <div class="alert alert-warning" role="alert">
                            {{ __('Henüz hiç yazı eklenmemiş') }}
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    @endsection
