<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{route('dashboard')}}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="{{asset('img/logo/logo_ia.png')}}" alt="Logo Internal Audit" width="100px">
      </span>
      <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="app-brand-text demo menu-text fw-bolder ms-2">
        <!-- {{ __('Audit') }} -->
      </x-nav-link>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item active">
      <a href="{{ route('dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
    </li>
    
    @if(auth()->user()->jabatan === 'General Manager')
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">SP2A</span>
      </li>
      <li class="menu-item">
        <a href="{{ route('audits.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">SP2A</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{ route('lhappreview.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-cube-alt"></i>
          <div data-i18n="Misc">LHAP</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{ route('lhaf.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-cube-alt"></i>
          <div data-i18n="Misc">LHAF</div>
        </a>
      </li>
      <!-- Signature -->
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Signature</span>
      </li>
      <li class="menu-item">
        <a href="{{ route('ttdgm.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-collection"></i>
          <div data-i18n="Basic">TTD General Manager</div>
        </a>
      </li>
      <!-- Reviu LHAP -->
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Reviu LHAP</span>
      </li>
      <li class="menu-item">
        <a href="{{route('lhappreview.index')}}" class="menu-link ">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Form Elements">Review LHAP Auditor</div>
        </a>
      </li>
    @endif
    <!-- Menu untuk posisi Senior Manager  -->
    @if(auth()->user()->jabatan === 'Senior Manager')
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">SP2A</span>
      </li>
      <li class="menu-item">
        <a href="{{ route('audits.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">SP2A</div>
        </a>
      </li>
      <li class="menu-item">
              <a href="{{ route('kkas.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Misc">KKA</div>
              </a>
            </li>
      <li class="menu-item">
        <a href="{{ route('lhappreview.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-cube-alt"></i>
          <div data-i18n="Misc">LHAP</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{ route('lhaf.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-cube-alt"></i>
          <div data-i18n="Misc">LHAF</div>
        </a>
      </li>
      @php
        $isKetuaTim = auth()->user()->auditors->where('jabatan', 'Ketua Tim')->isNotEmpty();
        $isPengawas = auth()->user()->auditors->where('jabatan', 'Pengawas')->isNotEmpty();
    @endphp

    @if($isKetuaTim || $isPengawas)
    <!-- Signature -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Signature</span></li>

    @if($isKetuaTim)
    <li class="menu-item">
      <a href="cards-basic.html" class="menu-link">
        <i class="menu-icon tf-icons bx bx-collection"></i>
        <div data-i18n="Basic">Paraf Ketua Tim</div>
      </a>
    </li>
    <!-- Review KKA -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Review KKA</span></li>
    <li class="menu-item">
      <a href="{{ route('reviewkkaketuatim.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-detail"></i>
        <div data-i18n="Form Elements">Review Ketua Tim</div>
      </a>
    </li>
    @endif

    @if($isPengawas)
    <li class="menu-item">
      <a href="cards-basic.html" class="menu-link">
        <i class="menu-icon tf-icons bx bx-collection"></i>
        <div data-i18n="Basic">Paraf Pengawas</div>
      </a>
    </li>
    <!-- Review KKA -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Review KKA</span></li>
    <li class="menu-item">
      <a href="{{ route('reviewkkapengawas.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-detail"></i>
        <div data-i18n="Form Layouts">Review Pengawas</div>
      </a>
    </li>
    @endif

    @endif

    @endif
    <!-- End Menu untuk posisi Senior Manager -->
    <!-- Menu untuk posisi Auditor -->
    @if(auth()->user()->auditors->where('jabatan', 'Auditor')->isNotEmpty())
    <!-- KKA -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">SP2A</span>
    </li>
    <li class="menu-item">
      <a href="{{ route('kkas.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-cube-alt"></i>
        <div data-i18n="Misc">KKA</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="{{ route('lhappreview.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-cube-alt"></i>
        <div data-i18n="Misc">LHAP</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="{{ route('lhaf.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-cube-alt"></i>
        <div data-i18n="Misc">LHAF</div>
      </a>
    </li>
    <!-- LHAP -->


    <!-- Hasil Reviu KKA -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Hasil Reviu KKA</span>
    </li>
    <li class="menu-item">
      <a href="{{ route('notes-ketua-tim.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-detail"></i>
        <div data-i18n="Form Elements">Review dari Ketua Tim</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="{{ route('notes-review-tim.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-detail"></i>
        <div data-i18n="Form Layouts">Review dari Pengawas</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="{{ route('notes.gm.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-detail"></i>
        <div data-i18n="Form Layouts">Review dari General Manager</div>
      </a>
    </li>
    @endif
    <!-- End menu untuk poisi Auditor  -->


    
    <!-- Other menu items -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Master Data</span>
    </li>
    <li class="menu-item">
      <a href="{{ route('profile.add') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-file"></i>
        <div data-i18n="Analytics">Master User</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="{{ route('departemens.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-file"></i>
        <div data-i18n="Analytics">Master Departemen</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="{{ route('bidang-audit.create') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
        <div data-i18n="Authentications">Master Bidang Audit</div>
      </a>
    </li>
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Support and FAQ</span>
    </li>
    <li class="menu-item">
      <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank" class="menu-link">
        <i class="menu-icon tf-icons bx bx-support"></i>
        <div data-i18n="Support">Dukungan</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank" class="menu-link">
        <i class="menu-icon tf-icons bx bx-file"></i>
        <div data-i18n="Documentation">FAQ</div>
      </a>
    </li>
  </ul>
</aside>
<!-- / Menu -->
