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
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Email</th>
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
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->NIS }}</td>
                            <td>{{ $member->email }}</td>
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