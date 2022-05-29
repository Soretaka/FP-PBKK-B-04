@extends('layout.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Data Anggota</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="form-group mt-3">
                @if ($member->image)
                    <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->nama }}" class="rounded mx-auto d-block top" style="width: 5cm">
                @endif
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $member->nama }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="nis" name="nis" value="{{ $member->nis }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="{{ $member->jenis_kelamin }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ $member->tempat_lahir }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $member->tanggal_lahir }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="nomor_hp" class="col-sm-2 col-form-label">No Handphone</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" value="{{ $member->nomor_hp }}" readonly>
                </div>
            </div>
            <div class="mb-2">
                <a href="{{ route('member.edit-form', $member->id) }}" class="btn btn-warning float-left mr-2">
                    <i class="fas fa-pen"></i>
                </a>
                <a class="btn btn-danger float-left mr-2" data-toggle="modal" data-target="#modalDelete-{{ $member->id }}">
                    <i class="fas fa-trash"></i>
                </a>
                <a href="{{ route('member.index') }}" class="btn btn-secondary float-left">Kembali</a>
                @include('member.delete-modal')
            </div>
        </div>
    </div>
@endsection