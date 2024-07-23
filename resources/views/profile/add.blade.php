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
                                <li class="breadcrumb-item"><a href="{{ route('audits.index') }}">SPA2A</a></li>
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
                    <br>
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
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Tab navigation -->
                                <ul class="nav nav-tabs nav-fill mb-4" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="list-tab" data-bs-toggle="tab" data-bs-target="#list" type="button" role="tab" aria-controls="list" aria-selected="true">Daftar Pengguna</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="add-tab" data-bs-toggle="tab" data-bs-target="#add" type="button" role="tab" aria-controls="add" aria-selected="false">Tambah Pengguna</button>
                                    </li>
                                </ul>
                                <!-- Tab content -->
                                <div class="tab-content" id="myTabContent">
                                    <!-- List tab -->
                                    <div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="list-tab">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nama</th>
                                                        <th>Email</th>
                                                        <th>SAP</th>
                                                        <th>Jabatan</th>
                                                        <th>Bidang</th>
                                                        <th>Inisial</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($users as $user)
                                                        <tr>
                                                            <td>{{ $user->id }}</td>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->sap }}</td>
                                                            <td>{{ $user->jabatan }}</td>
                                                            <td>{{ $user->bidang }}</td>
                                                            <td>{{ $user->inisial }}</td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal{{ $user->id }}">
                                                                    Update
                                                                </button>
                                                                <!-- Update Modal -->
                                                                <div class="modal fade" id="updateModal{{ $user->id }}" tabindex="-1" aria-labelledby="updateModalLabel{{ $user->id }}" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">
                                                                            <form method="POST" action="{{ route('profile.users.update', ['id' => $user->id]) }}">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="updateModalLabel{{ $user->id }}">Update User</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="mb-3">
                                                                                        <label for="update_name_{{ $user->id }}" class="form-label">{{ __('Nama Lengkap') }}</label>
                                                                                        <input id="update_name_{{ $user->id }}" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="update_email_{{ $user->id }}" class="form-label">{{ __('Email') }}</label>
                                                                                        <input id="update_email_{{ $user->id }}" type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="update_password_{{ $user->id }}" class="form-label">{{ __('Password') }}</label>
                                                                                        <input id="update_password_{{ $user->id }}" type="password" class="form-control" name="password">
                                                                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="update_password_confirmation_{{ $user->id }}" class="form-label">{{ __('Confirm Password') }}</label>
                                                                                        <input id="update_password_confirmation_{{ $user->id }}" type="password" class="form-control" name="password_confirmation">
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="update_sap_{{ $user->id }}" class="form-label">{{ __('Sap') }}</label>
                                                                                        <input id="update_sap_{{ $user->id }}" type="text" class="form-control" name="sap" value="{{ $user->sap }}" required>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="update_jabatan_{{ $user->id }}" class="form-label">{{ __('Jabatan') }}</label>
                                                                                        <select name="jabatan" id="update_jabatan_{{ $user->id }}" class="form-control">
                                                                                            <option value="Manager" @if($user->jabatan == 'Manager') selected @endif>Manager</option>
                                                                                            <option value="Senior Manager" @if($user->jabatan == 'Senior Manager') selected @endif>Senior Manager</option>
                                                                                            <option value="General Manager" @if($user->jabatan == 'General Manager') selected @endif>General Manager</option>
                                                                                            <option value="Supervisor" @if($user->jabatan == 'Supervisor') selected @endif>Supervisor</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="update_bidang_{{ $user->id }}" class="form-label">{{ __('Bidang') }}</label>
                                                                                        <select name="bidang" id="update_bidang_{{ $user->id }}" class="form-control">
                                                                                            <option value="Quality Assurance" @if($user->bidang == 'Quality Assurance') selected @endif>Quality Assurance</option>
                                                                                            <option value="Akuntansi dan Keuangan" @if($user->bidang == 'Akuntansi dan Keuangan') selected @endif>Akuntansi dan Keuangan</option>
                                                                                            <option value="Sistem manajemen dan lingkungan" @if($user->bidang == 'Sistem manajemen dan lingkungan') selected @endif>Sistem manajemen dan lingkungan</option>
                                                                                            <option value="Teknik dan operasi" @if($user->bidang == 'Teknik dan operasi') selected @endif>Teknik dan operasi</option>
                                                                                            <option value="Komersil" @if($user->bidang == 'Komersil') selected @endif>Komersil</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="mb-3">
    <label for="update_inisial_{{ $user->id }}" class="form-label">{{ __('Inisial') }}</label>
    <input id="update_inisial_{{ $user->id }}" type="text" class="form-control" name="inisial" value="{{ $user->inisial }}">
</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Update</button>
</div>
</form>
</div>
</div>
</div>
</div>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
<!-- Add tab -->
<div class="tab-pane fade" id="add" role="tabpanel" aria-labelledby="add-tab">
    <form method="POST" action="{{ route('profile.store') }}">
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
            <input id="inisial" type="text" class="form-control" name="inisial">
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
</div>
</div>
</div>
</div>
</x-app-layout>
<!-- / Layout container -->

