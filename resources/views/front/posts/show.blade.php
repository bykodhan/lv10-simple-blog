@extends('front.layouts.app')
@push('title', $post->meta_title)
@push('meta_description', $post->meta_description)
@push('meta_keywords', $post->meta_keywords)
@section('content')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('{{ asset($post->img) }}')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="post-heading">
                        <h1>
                            {{ $post->title }}
                        </h1>
                        <h2 class="subheading">
                            {{ $post->meta_description }}
                        </h2>
                        <span class="meta">
                            {{ __('Yazar') }} :
                            <a href="#!">
                                {{ $post->author->name }} {{ $post->author->surname }}
                                <small>
                                    ({{ $post->author->email }})
                                </small>
                            </a>
                            {{ __('Tarih') }} :
                            {{ $post->created_at->translatedFormat('F d, Y') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-12">
                    {!! $post->content !!}
                </div>
            </div>
        </div>
    </article>
    <hr class="my-4" />
    <!-- Comments-->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <section class="mb-5">
                    <div class="card border-0 shadow-sm bg-light rounded-3">
                        <div
                            class="card-header m-1 bg-white border-0 rounded-4 d-flex align-items-center justify-content-between gap-2">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0">
                                    {{ __('Yorumlar') }}
                                </h5>
                                <span class="badge bg-primary rounded-pill" id="comment_count">
                                    {{ $post->comments->count() }}
                                </span>
                            </div>
                            <button class="btn btn-sm @if ($liked) btn-danger @else btn-outline-danger @endif rounded btn_like"
                                onclick="like({{ $post->id }})">
                                <span class="btn_like_span">
                                    @if ($liked)
                                        {{ __('Beğendin') }}
                                    @else
                                        {{ __('Beğen') }}
                                    @endif
                                </span>
                                <span class="badge bg-danger rounded-pill" id="like_count">
                                    {{ $post->likes->count() }}
                                </span>
                            </button>
                        </div>
                        <div class="card-body">
                            <!-- Comment form-->
                            <form id="form_comment_store" class="mb-4" action="{{ route('posts.comment') }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <textarea name="message" maxlength="255" minlength="5" class="form-control" rows="3"
                                    placeholder="{{ Auth::user()->name . ' ' . Auth::user()->surname }} {{ __('Olarak yorum yapıyorsunuz..') }}"
                                    required></textarea>
                                <button class="btn btn-primary mt-2" type="submit">{{ __('Yorum Yap') }}</button>
                            </form>
                            <div id="comments">
                                @include('front.partials.comments')
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        const form_comment_store = document.querySelector('#form_comment_store');

        form_comment_store.addEventListener('submit', event => {
            event.preventDefault();
            const formData = new FormData(form_comment_store);
            axios.post(form_comment_store.action, formData)
                .then(response => {
                    document.querySelector('#comments').innerHTML = response.data;
                    document.querySelector('#comment_count').innerHTML = document.querySelectorAll('.comment')
                        .length;
                    form_comment_store.reset();
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: '{{ __('Yorumunuz başarıyla eklendi.') }}',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    // Do something with the response data
                })
                .catch(error => {
                    console.log(error);
                    // Handle error
                });
        });

        function like($id) {
            axios.post('{{ route('posts.like') }}', {
                    post_id: $id
                })
                .then(response => {
                    document.querySelector('#like_count').innerHTML = response.data.likes;
                    if (response.data.liked) {
                        document.querySelector('.btn_like').classList.add('btn-danger');
                        document.querySelector('.btn_like').classList.remove('btn-outline-danger');
                        document.querySelector('.btn_like_span').innerHTML = '{{ __('Beğendin') }}';
                    } else {
                        document.querySelector('.btn_like').classList.add('btn-outline-danger');
                        document.querySelector('.btn_like').classList.remove('btn-danger');
                        document.querySelector('.btn_like_span').innerHTML = '{{ __('Beğen') }}';
                    }
                    // Do something with the response data
                })
                .catch(error => {
                    console.log(error);
                    // Handle error
                });
        }
    </script>
@endpush
