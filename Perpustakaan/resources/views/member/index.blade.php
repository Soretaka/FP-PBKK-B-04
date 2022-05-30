@extends('layout.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-grey-800">Data Anggota</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('member.input-data') }}" class="btn btn-primary btn-icon-split btn-sm">
                <span class="icon text-grey-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah data anggota</span>
            </a>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>No Handphone</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @php
                        $i = 1
                    @endphp
                    @foreach ($members as $member)
                    <tbody>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $member->nama }}</td>
                            <td>{{ $member->nis }}</td>
                            <td>{{ $member->nomor_hp }}</td>
                            <td>
                                <a href="{{ route('member.detail-data', $member->id) }}" class="badge badge-info">detail</a>
                            </td>
                        </tr>
                    </tbody>
                    @php
                        $i += 1
                    @endphp
                    @endforeach
                </table>
            </div>
        </div>
    </div> 
@endsection