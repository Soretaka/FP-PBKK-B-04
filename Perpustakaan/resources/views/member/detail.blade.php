@extends('layout.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Data Anggota</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="form-group row">
                <label for="Name" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="Name" name="Name" value="{{ $member->name }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="email" name="email" value="{{ $member->email }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="TL" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="TL" name="TL" value="{{ $member->TL }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="Alamat" name="Alamat" value="{{ $member->Alamat }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="JK" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="JK" name="JK" value="{{ $member->JK }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="NIS" class="col-sm-2 col-form-label">NIS</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="NIS" name="NIS" value="{{ $member->NIS }}" readonly>
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