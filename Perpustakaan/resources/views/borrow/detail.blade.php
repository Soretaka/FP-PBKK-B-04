@extends(Auth::user()->isAdmin? 'layout.app' : 'layoutUser.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ __('borrow.detail') }}</h1>

    @if (session('status'))
        <div class="alert alert-success" id="session">
            {{ session('status') }}
        </div>
    @endif

    @foreach ($borrows as $borrow)
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group row">
                    <label for="book_id" class="col-sm-2 col-form-label">{{ __('borrow.title') }}</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="book_id" name="book_id" value="{{ $borrow->book->judul }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="isbn" class="col-sm-2 col-form-label">ISBN</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="isbn" name="isbn" value="{{ $borrow->book->isbn }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="timestamps" class="col-sm-2 col-form-label">{{ __('borrow.tgl_pinjam') }}</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="timestamps" name="timestamps" value="{{ $borrow->created_at }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="timestamps" class="col-sm-2 col-form-label">{{ __('borrow.tgl_hrs_kembali') }}</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="timestamps" name="timestamps" value="{{ $borrow->borrow->must_return_date }}" readonly>
                    </div>
                </div>

                @if ($borrow->return_date)
                    <div class="form-group row">
                        <label for="timestamps" class="col-sm-2 col-form-label">{{ __('borrow.tgl_kembali') }}</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="timestamps" name="timestamps" value="{{ $borrow->return_date }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="denda" class="col-sm-2 col-form-label">{{ __('borrow.denda') }}</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="denda" name="denda" value="Rp. {{ $borrow->denda }}" readonly>
                        </div>
                    </div>
                @else 
                    @if(Auth::user()->isAdmin)
                    <div class="mb-2">
                        <a href="{{ route('borrow.return-book', $borrow->id) }}" class="btn btn-warning float-right">{{ __('borrow.return') }}</a>
                    </div>
                    @endif
                @endif
            </div>
        </div>
    @endforeach
    <div class="mb-2">
        <a href="{{ route('borrow.index') }}" class="btn btn-secondary float-right mr-3">{{ __('borrow.back') }}</a>
    </div>

    <script>
        setTimeout(function() {
            $('#session').fadeOut('fast');
        }, 2000);
    </script>
@endsection