@extends('layoutUser.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-grey-800">Data Buku</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body container">
                <div class="row g-5">
                    @foreach ($books as $book)
                        <div class= "col-12 col-md-6 col-lg-4 card shadow p-3 mb-3 mr-3 bg-white rounded" style="height:400px; width: 300px;">
                            @if ($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->judul }}" class="rounded mx-auto d-block top" style="width: 5cm; height:200px">
                            @endif
                            <div class = "font-weight-bold">
                                <br>judul buku: {{ $book->judul }}
                            </div>
                            genre buku: {{ $book->category->kategori_buku }}
                            <br>penulis buku : {{ $book->penulis }}
                            @if ($book->status == "Tidak tersedia")
                            <p class="text-danger">{{ $book->status }} </p>
                            @endif
                            @if ($book->status == "Tersedia")
                            <p class="text-success">{{ $book->status }} </p>
                            @endif
                            <td>
                                <a href="{{ route('book.detail-data', $book->id) }}" class="badge badge-info">detail</a>
                            </td>
                        </div>
                    @endforeach
            </div>
        </div>
    </div>
@endsection