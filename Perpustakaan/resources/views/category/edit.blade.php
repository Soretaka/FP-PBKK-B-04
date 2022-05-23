@extends('layout.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Kategori Buku</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('category.update-data', $category->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="kategori_buku" class="col-sm-2 col-form-label @error('kategori_buku') is-invalid @enderror">Kategori Buku</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="kategori_buku" name="kategori_buku" value="{{ $category->kategori_buku }}" autofocus>
                        @error('kategori_buku')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field kategori harus diisi</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-warning float-right">Edit</button>
                    <a class="btn btn-secondary float-right mr-3" data-toggle="modal" data-target="#modalBackHome">Kembali</a>
                    @include('category.backhome-modal')
                </div>
            </form>
        </div>
    </div>
@endsection