<x-app-layout>
    <!-- Layout container -->
    <div class="layout-page">
        @include('layouts.searchnavigation')
        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
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
            <!-- Flash message -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <!-- / Flash message -->
            <div class="card-header d-flex justify-content-end"> 
                <a href="{{ route('audits.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
            <div class="card-body">
                <!-- Content -->
                <!-- Flash message -->
                @if(session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <!-- / Flash message -->
                <form method="POST" action="{{route('profile.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Nama Lengkap') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <div class="mb-3">
                            <label for="sap" class="form-label">{{ __('Sap') }}</label>
                            <input id="sap" type="text" class="form-control" name="sap" required>
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">{{ __('Jabatan') }}</label>
                            <select name="jabatan" class="form-control">
                                <option value="#">~pilih~</option>
                                <option value="Manager">Manager</option>
                                <option value="Senior Manager">Senior Manager</option>
                                <option value="General Manager">General Manager</option>
                                <option value="Supervisor">Supervisor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="bidang" class="form-label">{{ __('Bidang') }}</label>
                            <select name="bidang" id="bidang" class="form-control">
                                <option value="#">~pilih~</option>
                                <option value="Quality Assurance">Quality Assurance</option>
                                <option value="Akuntansi dan Keuangan">Akuntansi dan Keuangan</option>
                                <option value="Sistem manajemen dan lingkungan">Sistem manajemen dan lingkungan</option>
                                <option value="Teknik dan operasi">Teknik dan operasi</option>
                                <option value="Komersil">Komersil</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="inisial" class="form-label">{{ __('Inisial') }}</label>
                            <input id="inisial" type="text" class="form-control" name="inisial" >
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Tambah Pengguna') }}
                            </button>
                        </div>
                </form>
            </div>
        </div>
        </div>
        <!-- / Content wrapper -->
    </div>
    </div>
    
    <!-- / Layout container -->
</x-app-layout>