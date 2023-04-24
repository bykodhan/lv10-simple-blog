 <!-- Navigation-->
 <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
     <div class="container px-4 px-lg-5">
         <a class="navbar-brand" href="/">
             {{ config('app.name') }}
         </a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
             aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
             {{ __('Menu') }}
             <i class="fas fa-bars"></i>
         </button>
         <div class="collapse navbar-collapse" id="navbarResponsive">
             <ul class="navbar-nav ms-auto py-4 py-lg-0 d-flex align-items-center">
                 <li class="nav-item">
                     <a class="nav-link px-lg-3 py-3 py-lg-4" href="/">
                         {{ __('Anasayfa') }}
                     </a>
                 </li>
                 @auth
                     @if (Auth::user()->isAdmin())
                         <li class="nav-item">
                             <a class="nav-link px-lg-3 py-3 py-lg-4"href="{{ route('admin.index') }}">
                                 {{ __('Yönetim Paneli') }}
                             </a>
                         </li>
                     @endif
                     <li class="nav-item">
                         <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('posts.create') }}">
                             {{ __('Yeni Yazı') }}
                         </a>
                     </li>
                     <li class="nav-item">
                         <form action="{{ route('logout') }}" method="post">
                             @csrf
                             <button type="submit" class="btn btn-sm btn-primary">
                                ({{ Auth::user()->email }})
                                 {{ __('Çıkış Yap') }}
                             </button>
                         </form>
                     </li>
                 @endauth
                 @guest
                     <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4"
                             href="{{ route('auth.login') }}">{{ __('Giriş Yap') }}</a></li>
                     <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4"
                             href="{{ route('auth.register') }}">{{ __('Kayıt Ol') }}</a></li>
                 @endguest
             </ul>
         </div>
     </div>
 </nav>
