<form action="{{ route('audity.simpan') }}" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group" hidden>
                                    <label for="id_audit">ID Audit:</label>
                                    <input type="text" name="id_audit" class="form-control" value="{{ $audit->id }}" required>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="departemen">Departemen:</label>
                                    <select name="departemen" id="departemen" class="form-control selectpicker">
                                        @foreach ($departemens as $department)
                                            <option value="{{ $department->nama_departemen }}">{{ $department->nama_departemen }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <br>
                                    <button type="submit" class="btn btn-success float-right">Simpan</button>
                                </div>
                            </div>
                        </div>
                      </form>
