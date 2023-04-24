@extends('back.layouts.app')
@push('title', __('Yazılar'))
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">
@endpush
@section('content')
    <div class="container-fluid pt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <div class="pagetitle d-flex align-items-center justify-content-between">
                            <h3>
                                <i class="bi bi-pencil-square"></i>
                                {{ __('Yazılar') }}
                            </h3>
                            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-lg"></i>
                                {{ __('Yeni Yazı Ekle') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table align-middle table-bordered table-hover" id="datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('Görsel') }}</th>
                                    <th>{{ __('Yazar') }}</th>
                                    <th>{{ __('Başlık') }}</th>
                                    <th>{{ __('URL') }}</th>
                                    <th>{{ __('Meta Title') }}</th>
                                    <th>{{ __('Meta Description') }}</th>
                                    <th>{{ __('Beğeni Sayısı') }}</th>
                                    <th>{{ __('Tarihi') }}</th>
                                    <th>{{ __('İşlemler') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>
                                            {{ $post->id }}
                                        </td>
                                        <td>
                                            <img src="{{ asset($post->img) }}" alt="{{ $post->title }}" class="img-fluid"
                                                width="100">
                                        </td>
                                        <td>
                                            {{ $post->author->email }}
                                            <br>
                                            {{ $post->author->name }} {{ $post->author->surname }}
                                        </td>
                                        <td>
                                            {{ $post->title }}
                                        </td>
                                        <td>
                                            <a href="{{ route('posts.show', ['slug' => $post->slug]) }}" target="_blank">
                                                {{ route('posts.show', ['slug' => $post->slug]) }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $post->meta_title }}
                                        </td>
                                        <td>
                                            {{ $post->meta_desc }}
                                        </td>
                                        <td>
                                            {{ $post->likes->count() }}
                                        </td>
                                        <td>
                                            {{ $post->created_at->format('d.m.Y H:i') }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}"
                                                class="btn btn-sm btn-outline-success border-0">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a onclick="deletePost({{ $post->id }})"
                                                class="btn btn-sm btn-outline-danger border-0">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $posts->links() }}
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
    </div>

    <form action="{{ route('admin.posts.destroy') }}" method="POST" id="posts.destroy.form">
        @csrf
        @method('DELETE')
        <input type="hidden" name="id" id="id">
    </form>
@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"
        integrity="sha256-a2yjHM4jnF9f54xUQakjZGaqYs/V1CYvWpoqZzC2/Bw=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#datatable').DataTable({
                responsive: true,
                paging: false,
                scrollY: '50vh',
                scrollCollapse: true,
                order: [],
            });

        });
    </script>
    <script>
        function deletePost(id) {
            Swal.fire({
                title: "{{ __('Silmek istediğinize emin misini?') }}",
                text: "{{ __('Kalıcı olarak silinecektir!') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('Evet, Sil') }}",
                cancelButtonText: "{{ __('Hayır, İptal') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    form = document.getElementById('posts.destroy.form');
                    form.querySelector('input[name="id"]').value = id;
                    form.submit();
                }
            })
        }
    </script>
@endpush
