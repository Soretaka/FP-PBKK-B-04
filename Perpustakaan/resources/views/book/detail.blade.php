@extends('layout.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Data Buku</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="form-group row">
                <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ $book->judul }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $book->penulis }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ $book->penerbit }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="tahun" class="col-sm-2 col-form-label">Tahun Terbit</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="tahun" name="tahun" value="{{ $book->tahun_terbit }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="isbn" class="col-sm-2 col-form-label">ISBN</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="isbn" name="isbn" value="{{ $book->isbn }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="jumlah" name="jumlah" value="{{ $book->jumlah }}" readonly>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="kategori_id" class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="kategori" name="kategori" value="{{ $book->category->kategori_buku }}" readonly>
                </div>
            </div>
            <div class="mb-2">
                <a href="{{ route('book.edit-form', $book->id) }}" class="btn btn-warning float-left mr-2">
                    <i class="fas fa-pen"></i>
                </a>
                <a class="btn btn-danger float-left mr-2" data-toggle="modal" data-target="#modalDelete-{{ $book->id }}">
                    <i class="fas fa-trash"></i>
                </a>
                <a href="{{ route('book.index') }}" class="btn btn-secondary float-left">Kembali</a>
                @include('book.delete-modal')
            </div>
        </div>
    </div>
@endsection