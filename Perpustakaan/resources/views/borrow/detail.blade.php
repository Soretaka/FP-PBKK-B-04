@extends('layout.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Peminjaman</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="form-group row mb-4">
                <label for="user_id" class="col-sm-2 col-form-label">Nama Peminjam</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $borrows->user->name }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="book_id" class="col-sm-2 col-form-label">Judul Buku</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="book_id" name="book_id" value="{{ $borrows->book->judul }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="tanggal_peminjaman" class="col-sm-2 col-form-label">Tanggal Peminjaman</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman" value="{{ $borrows->tanggal_peminjaman }}" readonly>
                </div>
            </div>
            
            <div class="form-group row mb-4">
                <label for="tanggal_kembali" class="col-sm-2 col-form-label">Tanggal Kembali</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="tanggal_kembali" name="tanggal_kembali" value="{{ $borrows->tanggal_kembali }}" readonly>
                </div>
            </div>
            <div class="mb-2">
                <a href="{{ route('borrow.edit-form', $borrows->id) }}" class="btn btn-warning float-left mr-2">
                    <i class="fas fa-pen"></i>
                </a>
                <a class="btn btn-danger float-left mr-2" data-toggle="modal" data-target="#modalDelete-{{ $borrows->id }}">
                    <i class="fas fa-trash"></i>
                </a>
                <a href="{{ route('borrow.index') }}" class="btn btn-secondary float-left">Kembali</a>
                @include('borrow.delete-modal')
            </div>
        </div>
    </div>
@endsection