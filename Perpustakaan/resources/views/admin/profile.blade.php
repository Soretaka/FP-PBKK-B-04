@extends('layout.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Profile</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">email</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="TL" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="TL" name="TL" value="{{ auth()->user()->TL }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="Alamat" name="Alamat" value="{{ auth()->user()->Alamat }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="JK" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="JK" name="JK" value="{{ auth()->user()->JK }}" readonly>
                </div>
            </div>

            <div class="mb-2">
                <a href="{{ route('admin.edit-form', auth()->user()->id) }}" class="btn btn-warning float-left mr-2">
                    <i class="fas fa-pen"></i>
                </a>
            </div>
        </div>
    </div> 
@endsection