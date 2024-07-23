<x-app-layout>
    <!-- Layout container -->
    <div class="layout-page">
        @include('layouts.searchnavigation')
        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="#">SP2A</a></li>
                            </ol>
                        </nav>
                        <!-- Filter and Search -->
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="basic-addon2">
                            <button class="btn btn-outline-secondary" type="button">Search</button>
                        </div>
                       
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                        <th>nama_pengawas</th>
                                        <th>Judul KKA</th>
                                        <th>notes </th>
                                        <th>Dikirim pada</th>
                                        <th>Status</th>
                                        <th>Edit KKA</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1 @endphp
                                    @foreach($notesKetuaTim as $note)
                                        <tr>
                                            <td>{{ $note->nama_ketuatim }}</td>
                                            <td>{{ $note->audit_kka }}</td>
                                            <td>
                                                @foreach(json_decode($note->notes) as $item)
                                                    {{ $i == 1 ? '' : $i++ }}. {{ $item }}<br>
                                                @endforeach
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($note->created_at)->format('d F Y') }}</td>
                                            <td>{{ $note->status }}</td>
                                            <td>
                                               <a href="{{ route('notes-ketua-tim.edit-kka', ['id' => $note->id]) }}" class="btn btn-primary">Edit KKA</a>
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content wrapper -->
    </div>
    <!-- / Layout page -->
</x-app-layout>
