@extends(Auth::user()->isAdmin? 'layout.app' : 'layoutUser.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Form Input Kategori</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('borrow.store-data') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group row mb-4">
                    <label for="id" class="col-sm-2 col-form-label">Judul Buku</label>
                    <div class="col-sm-5">
                        <select class="form-control @error('id') is-invalid @enderror" id="id" name="id" autofocus>
                            <option value="">-Pilih Buku-</option>
                            @foreach ($books as $book)
                                <option value="{{ $book->id }}">{{ $book->judul }}</option>
                            @endforeach
                        </select>
                        @error('id')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field Buku harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tanggal_peminjaman" class="col-sm-2 col-form-label">Tanggal Peminjaman</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control @error('tanggal_peminjaman') is-invalid @enderror" id="tanggal_peminjaman" name="tanggal_peminjaman" value="{{ old('tanggal_peminjaman') }}" autofocus>
                        @error('tanggal_peminjaman')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field Tanggal Peminjaman harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tanggal_kembali" class="col-sm-2 col-form-label">Tanggal Kembali</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror" id="tanggal_kembali" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}" autofocus>
                        @error('tanggal_kembali')
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