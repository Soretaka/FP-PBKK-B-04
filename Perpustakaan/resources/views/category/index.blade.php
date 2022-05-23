@extends('layout.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Kategori</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('category.input-data') }}" class="btn btn-primary btn-icon-split btn-sm">
                <span class="icon text-grey-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah kategori buku</span>
            </a>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Kategori Buku</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($categories as $category)
                    <tbody>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $category->kategori_buku }}</td>
                            <td>
                                <a href="{{ route('category.edit-form', $category->id) }}" class="btn btn-warning float-left mr-2">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <a class="btn btn-danger float-left mr-2" data-toggle="modal" data-target="#modalDelete-{{ $category->id }}">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                    @php
                        $i += 1;
                    @endphp
                    @endforeach

                    <!-- Delete Modal-->
                    @foreach ($categories as $category)
                        @include('category.delete-modal')  
                    @endforeach
                </table>
            </div>
        </div>
    </div>    
@endsection