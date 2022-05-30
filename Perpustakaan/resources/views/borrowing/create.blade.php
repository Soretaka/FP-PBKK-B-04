@extends('layout.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Form Input Kategori</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('category.store-data') }}" method="POST">
                {{ csrf_field() }}
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
                    <a class="btn btn-secondary float-right mr-3" data-toggle="modal" data-target="#modalBackHome">Kembali</a>
                    @include('category.backhome-modal')
                </div>
            </form>
        </div>
    </div>
@endsection