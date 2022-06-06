@extends(Auth::user()->isAdmin? 'layout.app' : 'layoutUser.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ __('book.detail') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="form-group mt-3">
                @if ($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->judul }}" class="rounded mx-auto d-block top" style="width: 5cm">
                @endif
            </div>
            <div class="form-group row">
                <label for="judul" class="col-sm-2 col-form-label">{{ __('book.title') }}</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ $book->judul }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="penulis" class="col-sm-2 col-form-label">{{ __('book.author') }}</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $book->penulis }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="penerbit" class="col-sm-2 col-form-label">{{ __('book.publisher') }}</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ $book->penerbit }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="tahun" class="col-sm-2 col-form-label">{{ __('book.date') }}</label>
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
                <label for="status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="status" name="status" value="{{ $book->status }}" readonly>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="kategori_id" class="col-sm-2 col-form-label">{{ __('book.category') }}</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="kategori" name="kategori" value="{{ $book->category->kategori_buku }}" readonly>
                </div>
            </div>
            <div class="mb-2">
                @if(Auth::User()->isAdmin)
                    <a href="{{ route('book.edit-form', $book->id) }}" class="btn btn-warning float-left mr-2">
                        <i class="fas fa-pen"></i>
                    </a>
                    <a class="btn btn-danger float-left mr-2" data-toggle="modal" data-target="#modalDelete-{{ $book->id }}">
                        <i class="fas fa-trash"></i>
                    </a>
                @endif
                    <a href="{{ route('book.index') }}" class="btn btn-secondary float-left">{{ __('layout.back') }}</a>
                @include('book.delete-modal')
            </div>
        </div>
    </div>
@endsection