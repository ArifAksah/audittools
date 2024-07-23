                            <!-- Show table jadwal audit -->
                            <table class="table">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Nama Kegiatan</th>
                                      <th>Mulai</th>
                                      <th>Selesai</th>
                                      <th>Status Dokumen</th>
                                      <th>Aksi</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach($jadwalAudits as $jadwalAudit)
                                  <tr>
                                      <td>{{ $loop->iteration }}</td>
                                      <td>{{ $jadwalAudit->nama_kegiatan }}</td>
                                      <td>{{ $jadwalAudit->mulai }}</td>
                                      <td>{{ $jadwalAudit->selesai }}</td>
                                      <td>
                                          @if($jadwalAudit->upload_dokumen)
                                          <a href="{{ asset('uploads/' . $jadwalAudit->upload_dokumen) }}"> <span class="badge bg-label-success">Sukses Upload Dokumen</span></a>
                                          @else
                                          <span class="badge bg-label-danger">Dokumen belum ada</span>
                                          @endif
                                      </td>
                                      <td>
                                         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal{{$jadwalAudit->id}}">Update</button>
                                         <form action="{{ route('jadwal-audits.destroy', $jadwalAudit->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal audit ini?')">Hapus</button>
                                        </form>
                                        </td>
                                  </tr>
                                  @endforeach
                              </tbody>
                          </table>
                          <!-- End Show jadwal audit -->