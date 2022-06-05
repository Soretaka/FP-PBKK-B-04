@extends(Auth::user()->isAdmin? 'layout.app' : 'layoutUser.app')

@section('container')
    <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{ __('user.trend') }}</h1>
        <div class="card shadow mb-4">
            <div class="card-body container">
                    <div class="row g-5">
                        {{-- {{ dd($books) }} --}}
                        @php
                           $i = 1;
                        @endphp
                        @foreach ($books as $book)
                            <div class= "col-12 col-md-6 col-lg-4 card shadow p-3 mb-3 mr-3 bg-white rounded" style="height:400px; width: 200px;">
                                @if ($book->book->image)
                                <img src="{{ asset('storage/' . $book->book->image) }}" alt="{{ $book->book->judul }}" class="rounded mx-auto d-block top" style="width: 5cm; height:200px">
                                @endif
                                
                                <div class = "font-weight-bold">
                                    {{ __('user.rank') }} : {{ $i }}
                                    <br>{{ __('user.title') }}: {{ $book->book->judul }}
                                </div>
                                {{ __('user.genre') }}: {{ $book->book->category->kategori_buku }}
                                <br>{{ __('user.author') }} : {{ $book->book->penulis }}
                                @if ($book->status == "Tidak tersedia")
                                <p class="text-danger">{{ $book->book->status }} </p>
                                @endif
                                @if ($book->status == "Tersedia")
                                <p class="text-success">{{ $book->book->status }} </p>
                                @endif
                                <td>
                                    <a href="{{ route('book.detail-data', $book->book->id) }}" class="badge badge-info">detail</a>
                                </td>
                            </div>
                        @php
                            $i += 1;    
                        @endphp
                        @endforeach
                </div>
            </div>
        </div>
@endsection