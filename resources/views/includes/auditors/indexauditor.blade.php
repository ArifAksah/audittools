<!-- resources/views/auditor/index.blade.php -->

<!-- Show table auditor -->
<table class="table">
  <thead>
      <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Jabatan</th>
          <th>Aksi</th>
      </tr>
  </thead>
  <tbody>
      @forelse($auditor as $auditor)
      <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $auditor->nama }}</td>
          <td>{{ $auditor->jabatan }}</td>
          <td>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal{{$auditor->id}}">Update</button>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$auditor->id}}">Hapus</button>
          </td>
      </tr>
      @empty
      <tr>
          <td colspan="4">Tidak ada data auditor.</td>
      </tr>
      @endforelse
  </tbody>
</table>
<!-- End Show table auditor -->
