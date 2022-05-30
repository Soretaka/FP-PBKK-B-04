@extends(Auth::user()->isAdmin? 'layout.app' : 'layoutUser.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Form Input Kategori</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('borrow.store-data') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group row mb-4">
                    <label for="isbn" class="col-sm-2 col-form-label">Judul Buku</label>
                    <div class="col-sm-5">
                        <select class="form-control @error('isbn') is-invalid @enderror" id="isbn" name="isbn" autofocus>
                            <option value="">-Pilih Buku-</option>
                            @foreach ($books as $book)
                                <option value="{{ $book->isbn }}">{{ $book->judul }}</option>
                            @endforeach
                        </select>
                        @error('isbn')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field Buku harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" autofocus>
                        @error('judul')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field Tanggal Peminjaman harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" autofocus>
                        @error('judul')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field Tanggal Kembali diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    <a class="btn btn-secondary float-right mr-3" data-toggle="modal" data-target="#modalBackHome">Kembali</a>
                    @include('borrow.backhome-modal')
                </div>
            </form>
        </div>
    </div>
@endsection