@extends('layout.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Data Anggota</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('member.update-data', $member->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="image" class="col-sm-2 col-form-label">Pilih Foto</label>
                    <div class="col-sm-5">
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" onchange="imagePreview()" autofocus>
                        <input type="hidden" name="oldImage" value="{{ $member->image }}">
                        @if ($member->image)
                            <img src="{{ asset('storage/' . $member->image) }}" class="img-preview img-fluid mt-3 col-sm-5">
                        @else
                            <img class="img-preview img-fluid mt-3 col-sm-5">
                        @endif
                        @error('image')
                            <div id="imageFeedback" class="invalid-feedback">Format jpeg,jpg,png ukuran maksimum 2 MB</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $member->nama }}">
                        @error('nama')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field nama harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis" name="nis" value="{{ $member->nis }}">
                        @error('nis')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field NIS harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-3">
                        <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                            <option value="">-Pilih Jenis Kelamin-</option>
                            <option value="Laki-laki" @if($member->jenis_kelamin == 'Laki-laki') selected @endif>Laki-laki</option>
                            <option value="Perempuan" @if($member->jenis_kelamin == 'Perempuan') selected @endif>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field jenis kelamin harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ $member->tempat_lahir }}">
                        @error('tempat_lahir')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field tempat lahir harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-3">
                        <input type="text" class="datepicker-here form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" data-language="en" data-position="top left" value="{{ $member->tanggal_lahir }}"/>
                        @error('tanggal_lahir')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field tanggal lahir harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nomor_hp" class="col-sm-2 col-form-label">No Handphone</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control @error('nomor_hp') is-invalid @enderror" id="nomor_hp" name="nomor_hp" value="{{ $member->nomor_hp }}">
                        @error('nomor_hp')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field nomor hp harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    <a class="btn btn-secondary float-right mr-3" data-toggle="modal" data-target="#modalBackHome">Kembali</a>
                    @include('member.backhome-modal')
                </div>
            </form>
        </div>
    </div>

    <script>
        function imagePreview() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection