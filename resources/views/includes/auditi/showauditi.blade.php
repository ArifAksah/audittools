<!-- resources/views/auditor/index.blade.php -->

<!-- Show table audity -->
<table class="table">
  <thead>
      <tr>
          <th>No</th>
          <th>Nama Departemen</th>
          <th>Aksi</th>
      </tr>
  </thead>
  <tbody>
      @forelse($audities as $auditi)
      <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $auditi->departemen }}</td>
          <td>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal{{$auditi->id}}">Update</button>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$auditi->id}}">Hapus</button>
          </td>
      </tr>
      @empty
      <tr>
          <td colspan="3">Tidak ada data audity.</td>
      </tr>
      @endforelse
  </tbody>
</table>
<!-- End Show table audity -->

