<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-speedometer"></i>
                    </div>
                    {{ __('Anasayfa') }}
                </a>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                    aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-newspaper"></i>
                    </div>
                    {{ __('Yazılar') }}
                    <div class="sb-sidenav-collapse-arrow">
                        <i class="bi bi-chevron-down"></i>
                    </div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.posts') }}">
                            {{ __('Tüm Yazılar') }}
                        </a>
                        <a class="nav-link" href="{{ route('admin.posts.create') }}">
                            {{ __('Yeni Yazı Ekle') }}
                        </a>
                    </nav>
                </div>
                <a class="nav-link" href="{{ route('admin.comments') }}">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-chat-dots-fill"></i>
                    </div>
                    {{ __('Yorumlar') }}
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">
                {{ __('Giriş Yapan Kullanıcı') }}:
            </div>
            {{ Auth::user()->name }} {{ Auth::user()->surname }}
        </div>
    </nav>
</div>
