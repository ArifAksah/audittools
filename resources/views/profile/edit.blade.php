<x-app-layout>
    <!-- Layout container -->
    <div class="layout-page">
        @include('layouts.searchnavigation')
        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container">
        <div class="card">
            <div class="card-header">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item " ><a href="{{ route('audits.index') }}">SPA2A</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('audits.create') }}">Buat SPA2A</a></li>
            </ol>
            </nav>
            </div>
            <div class="card-header d-flex justify-content-end"> 
                <a href="{{ route('audits.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
            <div class="card-body">
                <!-- Content -->
                <div class="row">
                @include('profile.partials.update-profile-information-form')
                @include('profile.partials.update-password-form')
                @include('profile.partials.delete-user-form')
                </div>
 
                    </div>
        </div>
        </div>
        <!-- / Content wrapper -->
    </div>
    </div>
    <!-- / Layout container -->
</x-app-layout>
