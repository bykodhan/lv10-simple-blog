@extends('back.layouts.app')
@push('title', __('Yeni Yazı Oluştur'))
@section('content')
    <div class="container pt-3">
        <div class="row">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <div class="pagetitle d-flex align-items-center justify-content-between">
                        <h3>
                            <i class="bi bi-pencil-square"></i>
                            {{ __('Yeni Yazı Oluştur') }}
                        </h3>
                        <a href="{{ route('admin.posts') }}" class="btn btn-primary">
                            <i class="bi bi-newspaper"></i>
                            {{ __('Yazılar') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Başlık') }}*</label>
                                    <input name="title" type="text" class="form-control" required
                                        value="{{ old('title') }}" placeholder="{{ __('Başlık') }}" autofocus>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Slug URL') }}*</label>
                                    <input name="slug" placeholder="{{ __('Başlığa göre otomatik oluşturulur') }}"
                                        type="text" class="form-control" required value="{{ old('slug') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="metatitle">
                                        {{ __('Meta Title') }}
                                    </label>
                                    <input id="metatitle" name="meta_title"
                                        placeholder="{{ __('Başlığa göre otomatik oluşturulur') }}" type="text"
                                        class="form-control" value="{{ old('meta_title') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="metakeywords">
                                        {{ __('Meta Keywords') }}
                                    </label>
                                    <input id="metakeywords" name="meta_keywords"
                                        placeholder="{{ __('Ex:keyword1,keyword2,keyword3') }}" type="text"
                                        class="form-control" value="{{ old('meta_keywords') }}">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="metadescription">
                                {{ __('Meta Description') }}
                            </label>
                            <textarea class="form-control" id="metadescription" placeholder="{{ __('Meta Description') }}" name="meta_desc"
                                rows="3">{{ old('meta_desc') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <div class="border-dashed py-4 text-center">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <img src="placeholder.png" alt="Placeholder Image" id="image-preview"
                                        class="img-fluid mb-2 d-none" width="100">
                                    <button type="button" class="btn btn-danger btn-sm d-none" id="remove-image"
                                        onclick="removeImage()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash3" viewBox="0 1 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg>
                                        {{ __('Görseli Kaldır') }}
                                    </button>
                                </div>
                                <div class="mt-2">
                                    <label for="image" class="btn btn-primary btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-image-fill" viewBox="0 1 16 16">
                                            <path
                                                d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z" />
                                        </svg>
                                        {{ __('Öne çıkarılacak görseli seç') }}
                                    </label>
                                    <input type="file" name="img" class="form-control d-none" id="image"
                                        accept="image/*" onchange="loadFile(event)">
                                </div>
                            </div>

                            <style>
                                .border-dashed {
                                    border: 1px dashed #ccc;
                                    border-radius: 5px;
                                }
                            </style>

                            <script>
                                const preview = document.getElementById('image-preview');
                                const removeBtn = document.getElementById('remove-image');

                                function loadFile(event) {
                                    preview.src = URL.createObjectURL(event.target.files[0]);
                                    preview.onload = function() {
                                        URL.revokeObjectURL(preview.src);
                                        preview.classList.remove('d-none');
                                        removeBtn.classList.remove('d-none');
                                    };
                                }

                                function removeImage() {
                                    preview.src = 'placeholder.png';
                                    preview.classList.add('d-none');
                                    removeBtn.classList.add('d-none');
                                }
                            </script>

                        </div>
                        <div class="mb-3">
                            <textarea id="content" name="content" class="form-control" rows="10">{!! old('content') !!}</textarea>
                        </div>
                        <div class="d-grid col-lg-6 mx-auto">
                            <button type="submit"
                                class="btn btn-primary waves-effect waves-light d-flex align-items-center justify-content-center">
                                <i class="bi bi-plus-lg"></i>
                                {{ __('Yazı oluştur') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        generateSlugAndSetMetaTitle();
        function generateSlugAndSetMetaTitle() {
            // name input elementini seç
            const nameInput = document.querySelector('input[name="title"]');
            const slugInput = document.querySelector('input[name="slug"]');
            const metaTitleInput = document.querySelector('input[name="meta_title"]');

            // slug oluşturma işlemini yapacak fonksiyon
            function createSlug(name) {
                const turkishMap = {
                    çÇ: "c",
                    ğĞ: "g",
                    şŞ: "s",
                    ıİ: "i",
                    öÖ: "o",
                    üÜ: "u"
                };

                let slug = name.toLowerCase().trim();

                // Türkçe karakterleri ingilizce karakterlere dönüştür
                for (let key in turkishMap) {
                    slug = slug.replace(new RegExp('[' + key + ']', 'g'), turkishMap[key]);
                }

                // izin verilen karakterler dışındakileri kaldır
                slug = slug.replace(/[^a-z0-9 -]/g, "");

                // boşlukları tire ile değiştir
                slug = slug.replace(/\s+/g, "-");

                return slug;
            }
            // name input değeri değiştiğinde slug oluştur ve ekrana yazdır
            nameInput.addEventListener('change', function() {
                const slug = createSlug(this.value);
                slugInput.value = slug;
                metaTitleInput.value = this.value;
            });
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.4.0/tinymce.min.js"
        integrity="sha512-nv2Ftve23IDZqQhji5P2w17Ch88OR37z6tV6djv8U6hcjpRjDXRypN6sXkN6UQo8S+/qf67LVh1a3COduJIG3Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        tinymce.init({
            selector: 'textarea#content',
            menubar: false,
            advlist_number_styles: "default",
            advlist_bullet_styles: "default",
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
            toolbar: 'h1 h2 h3 bold italic blockquote strikethrough | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor hr | link image media | table emoticons codesample | ltr rtl |  removeformat help fullscreen preview code',
            toolbar_sticky: true,
        });
    </script>
@endpush
