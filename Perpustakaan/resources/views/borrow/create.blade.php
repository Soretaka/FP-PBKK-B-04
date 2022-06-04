@extends(Auth::user()->isAdmin? 'layout.app' : 'layoutUser.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Form Input Peminjaman</h1>

    <form action="{{ route('borrow.store-data') }}" method="POST">
    {{ csrf_field() }}
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group row mb-4">
                    <label for="user_id" class="col-sm-2 col-form-label">NIS</label>
                    <div class="col-sm-5">
                        <select class="form-control mdb-select md-form @error('user_id') is-invalid @enderror" searchable="Select here..." id="user_id" name="user_id" required autofocus>
                            <option value="">-NIS-</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->NIS }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field NIS harus diisi</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        @for ($i = 1; $i <= 3; $i++)
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class="col-sm-2 col-form-label"><b>Buku {{ $i }}</b></label>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="book_id" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-5">
                            <select class="form-control @error('book_id') is-invalid @enderror" id="book_id" name="book_id[]" @if ($i==1) required @endif autofocus>
                                <option value="">-Pilih Judul-</option>
                                @foreach ($books as $book)
                                <option value="{{ $book->id }}">{{ $book->judul }}</option>
                                @endforeach
                            </select>
                            @error('book_id')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">Field ISBN harus diisi</div>
                            @enderror
                        </div>
                    </div>
                    @if ($i == 3)
                        <div class="mb-2">
                            <button type="submit" class="btn btn-primary float-right">Simpan</button>
                            <a class="btn btn-secondary float-right mr-3" data-toggle="modal" data-target="#modalBackHome">Kembali</a>
                            @include('borrow.backhome-modal')
                        </div>
                    @endif
                </div>
            </div>
        @endfor
    </form>
@endsection