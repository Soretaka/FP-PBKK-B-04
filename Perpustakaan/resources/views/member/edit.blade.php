@extends('layout.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Data Anggota</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('member.update-data', $member->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $member->name }}">
                        @error('nama')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field nama harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-3">
                        <input type="text" class="datepicker-here form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" data-language="en" data-position="top left" value="{{ $member->TL }}"/>
                        @error('tanggal_lahir')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field tanggal lahir harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('Alamat') is-invalid @enderror" id="Alamat" name="Alamat" value="{{ $member->Alamat }}">
                        @error('Alamat')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field alamat harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-3">
                        <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                            <option value="">-Pilih Jenis Kelamin-</option>
                            <option value="Laki-laki" @if($member->JK == 'Laki-laki') selected @endif>Laki-laki</option>
                            <option value="Perempuan" @if($member->JK == 'Perempuan') selected @endif>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field jenis kelamin harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis" name="nis" value="{{ $member->NIS }}">
                        @error('nis')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field NIS harus diisi</div>
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

    {{-- <script>
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
    </script> --}}
@endsection