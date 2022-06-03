@extends('layout.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Peminjaman</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    {{-- @if(Auth::User()->isAdmin) --}}
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('borrow.input-data') }}" class="btn btn-primary btn-icon-split btn-sm">
                <span class="icon text-grey-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Peminjaman buku</span>
            </a>
        </div>
    {{-- @endif --}}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>Judul Buku</th>
                            <th>ISBN</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($borrows as $borrow)
                    <tbody>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $borrow->user->name }}</td>
                            <td>{{ $borrow->user->NIS }}</td>
                            <td>{{ $borrow->book->judul }}</td>
                            <td>{{ $borrow->book->isbn }}</td>
                            <td>{{ $borrow->created_at }}</td>
                            <td>
                                <a href="{{ route('borrow.detail-data', $borrow->id) }}" class="badge badge-info">detail</a>
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