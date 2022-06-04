@extends('layout.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Profile</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.update-data', auth()->user()->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ auth()->user()->name }}" required autofocus>
                        @error('name')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field nama harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">email</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ auth()->user()->email }}" required autofocus>
                        @error('email')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field email harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="TL" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-3">
                        <input type="text" class="datepicker-here form-control @error('TL') is-invalid @enderror" id="TL" name="TL" data-language="en" data-position="top left" value="{{ auth()->user()->TL }}" required autofocus>
                        @error('TL')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field tanggal lahir harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('Alamat') is-invalid @enderror" id="Alamat" name="Alamat" value="{{ auth()->user()->Alamat }}" required autofocus>
                        @error('Alamat')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field alamat harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="JK" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-3">
                        <select class="form-control @error('JK') is-invalid @enderror" id="JK" name="JK" required autofocus>
                            <option value="">-Pilih Jenis Kelamin-</option>
                            <option value="Laki-laki" @if(auth()->user()->JK == 'Laki-laki') selected @endif>Laki-laki</option>
                            <option value="Perempuan" @if(auth()->user()->JK == 'Perempuan') selected @endif>Perempuan</option>
                        </select>
                        @error('JK')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field jenis kelamin harus diisi</div>
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
@endsection