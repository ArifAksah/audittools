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
                    <div class="card-header">{{ __('Create KKA') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('kkas.store') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- Select Audit -->
                            <div class="mb-3" hidden>
                                <label for="id_audit" class="form-label">{{ __('Audit') }}</label>
                                @foreach($audits as $audit)
                                    <input type="text" name="id_audit" id="id_audit" value="{{$audit->id}}" class="form-control" readonly >
                                @endforeach
                            </div>

                            <div class="mb-3">
                                <label for="audit_kka" class="form-label">{{ __('Judul Audit') }}</label>
                                @foreach($audits as $audit)
                                    <input type="text" name="audit_kka" id="audit_kka" value="{{$audit->judul_audit}}" class="form-control" readonly>
                                @endforeach
                            </div>

                            <!-- Select Auditor -->
                            <div class="mb-3" hidden>
                                <label for="id_user" class="form-label">{{ __('Auditor') }}</label>
                                <input type="text" name="id_user" id="id_user" value="{{ $loggedInUser->id }}" class="form-control" readonly >
                            </div>
                            <div class="mb-3">
                                <label for="auditor_kka" class="form-label">{{ __('Auditor') }}</label>
                                <input type="text" name="auditor_kka" id="auditor_kka" value="{{ $loggedInUser->name }}" class="form-control" readonly>
                            </div>

                            <!-- Kondisi -->
                            <div class="mb-3">
                                <label for="kondisi_teks" class="form-label">{{ __('Kondisi') }}</label>
                                <textarea name="kondisi_teks" id="kondisi_teks" class="form-control" required></textarea>
                            </div>
                            <!-- Kondisi Image -->
                            <div class="mb-3">
                                <label for="kondisi_images" class="form-label">{{ __('Kondisi Images') }}</label>
                                <div class="input-group hdtuto control-group lst kondisi-increment" id="kondisi_images">
                                    <input type="file" name="kondisi_images[]" class="myfrm form-control">
                                    <div class="input-group-btn">
                                        <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
                                    </div>
                                </div>
                                <div class="kondisi-clone hide">
                                    <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                        <input type="file" name="kondisi_images[]" class="myfrm form-control">
                                        <div class="input-group-btn">
                                            <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Kondisi Image -->
                            <!-- Kriteria -->
                            <div class="mb-3">
                                <label for="kriteria_teks" class="form-label">{{ __('Kriteria') }}</label>
                                <textarea name="kriteria_teks" id="kriteria_teks" class="form-control" required></textarea>
                            </div>
                            <!-- Kriteria Image -->
                            <div class="mb-3">
                                <label for="kriteria_images" class="form-label">{{ __('Kriteria Images') }}</label>
                                <div class="input-group hdtuto control-group lst kriteria-increment" id="kriteria_images">
                                    <input type="file" name="kriteria_images[]" class="myfrm form-control">
                                    <div class="input-group-btn">
                                        <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
                                    </div>
                                </div>
                                <div class="kriteria-clone hide">
                                    <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                        <input type="file" name="kriteria_images[]" class="myfrm form-control">
                                        <div class="input-group-btn">
                                            <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Kriteria Image -->

                            <!-- Sebab -->
                            <div class="mb-3">
                                <label for="sebab" class="form-label">{{ __('Sebab') }}</label>
                                <textarea name="sebab" id="sebab" class="form-control" required></textarea>
                            </div>
                            <!-- Akibat -->
                            <div class="mb-3">
                                <label for="akibat" class="form-label">{{ __('Akibat') }}</label>
                                <textarea name="akibat" id="akibat" class="form-control" required></textarea>
                            </div>
                            <!-- Rekomendasi -->
                            <div class="mb-3">
                                <label for="rekomendasi" class="form-label">{{ __('Rekomendasi') }}</label>
                                <textarea name="rekomendasi" id="rekomendasi" class="form-control"></textarea>
                            </div>
                            <!-- Evidence -->
                            <div class="mb-3">
                                <label for="evidence" class="form-label">{{ __('Evidence') }}</label>
                                <input type="text" name="evidence" id="evidence" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Script untuk multiple upload images -->
<script type="text/javascript">
    $(document).ready(function() {
        $(".btn-success").click(function() {
            var lsthmtl = $(".clone").html();
            $(this).parents('.input-group').after(lsthmtl);
        });
        $("body").on("click", ".btn-danger", function() {
            $(this).parents(".input-group").remove();
        });
    });
</script>
<!-- end script untuk multiple upload images -->
<div class="clone hide" hidden>
    <div class="hdtuto control-group lst input-group" style="margin-top:10px">
        <input type="file" name="images[]" class="myfrm form-control">
        <div class="input-group-btn">
            <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
        </div>
    </div>
</div>

</x-app-layout>
