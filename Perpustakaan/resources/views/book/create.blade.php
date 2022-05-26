@extends('layout.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Data Buku</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('book.store-data') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" autofocus>
                        @error('judul')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field judul harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control @error('penulis') is-invalid @enderror" id="penulis" name="penulis" value="{{ old('penulis') }}" autofocus>
                        @error('penulis')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field penulis harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control @error('penerbit') is-invalid @enderror" id="penerbit" name="penerbit" value="{{ old('penerbit') }}" autofocus>
                        @error('penerbit')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field penerbit harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tahun" class="col-sm-2 col-form-label">Tahun Terbit</label>
                    <div class="col-sm-3">
                        <select class="form-control @error('tahun_terbit') is-invalid @enderror" id="tahun_terbit" name="tahun_terbit" autofocus>
                            <option value="">-Tahun-</option>
                            <?php
                                $tahun = date("Y");
                                for ($i=$tahun-20; $i <= $tahun; $i++) {
                                    echo "<option value='$i'>$i</option>";
                                }
                            ?>
                        </select>
                        @error('tahun_terbit')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field tahun terbit harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="isbn" class="col-sm-2 col-form-label">ISBN</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control @error('isbn') is-invalid @enderror" id="isbn" name="isbn" value="{{ old('isbn') }}" autofocus>
                        @error('isbn')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field ISBN harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah') }}" autofocus>
                        @error('jumlah')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field jumlah harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="kategori_id" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-5">
                        <select class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" autofocus>
                            <option value="">-Pilih Kategori-</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->kategori_buku }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field kategori harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    <a href="{{ route('book.index') }}" class="btn btn-secondary float-right mr-3">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection