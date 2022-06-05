@extends(Auth::user()->isAdmin? 'layout.app' : 'layoutUser.app')
@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-grey-800">{{ __('book.book_data') }}</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- DataTales Example -->
    @if(Auth::User()->isAdmin)
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('book.input-data') }}" class="btn btn-primary btn-icon-split btn-sm">
                <span class="icon text-grey-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">{{ __('book.add_book') }}</span>
            </a>
        </div>
    @endif
    @if(Auth::User()->isAdmin === 0)
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('borrow.input-data') }}" class="btn btn-primary btn-icon-split btn-sm">
                <span class="icon text-grey-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">{{ __('book.borrow') }}</span>
            </a>
        </div>   
    @endif
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>{{ __('book.title') }}</th>
                            <th>{{ __('book.author') }}</th>
                            <th>{{ __('book.publisher') }}</th>
                            <th>Status</th>
                            <th>{{ __('book.action') }}</th>
                        </tr>
                    </thead>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($books as $book)
                    <tbody>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $book->judul }}</td>
                            <td>{{ $book->penulis }}</td>
                            <td>{{ $book->penerbit }}</td>
                            <td class="text-center">{{ $book->status }}</td>
                            <td>
                                <a href="{{ route('book.detail-data', $book->id) }}" class="badge badge-info">detail</a>
                            </td>
                        </tr>
                    </tbody>
                    @php
                        $i += 1;
                    @endphp
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection