@extends('layouts.app')

@section('contents')

<h3 class="font-weight-bold mb-3 ml-3 text-gray-800">Users</h3>

<div class="card shadow mb-4 border-bottom-info bg-gray-200">
    <div class="card-header py-3  border-bottom-info">
        <h6 class="m-0 font-weight-bold text-info" style="font-size: 20px; color: #3498db;">Data Users</h6>
    </div>
    <div class="card-body">
        <form action="/userssiswa" method="GET" class="row justify-content-end mb-3">
            <div class="col-md-3 input-group">
                <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-info" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-striped mb-4 text-gray-900" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Prodi</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php($no = 1)
                    @foreach($data as $index=> $row)
                    <tr>
                        <th scope="row">{{ $index + $data->firstItem() }}</th>
                        <td>
                            @if ($row->foto)
                            <img src="{{ asset('ppimages/'. $row->foto) }}" alt="" style="width: 58px; height: 58px; border-radius: 50%;">
                            @else
                            <img src="{{ asset('ppimages/user4.png') }}" alt="Default User" style="width: 56px; height: 56px; border-radius: 50%;">
                            @endif
                        </td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->kelas }}</td>
                        <td>{{ $row->jurusan->nama_prodi }}</td>
                        <td>
                            @if($row->status == 'Admin')
                            <div class="badge bg-secondary text-white rounded-pill" style="font-size: 16px;">{{ $row->status }}</div>
                            @elseif($row->status == 'Petugas')
                            <div class="badge bg-info text-white rounded-pill" style="font-size: 16px;">{{ $row->status }}</div>
                            @elseif($row->status == 'Guru')
                            <div class="badge bg-success text-white rounded-pill" style="font-size: 16px;">{{ $row->status }}</div>
                            @elseif($row->status == 'Siswa')
                            <div class="badge bg-warning text-white rounded-pill" style="font-size: 16px;">{{ $row->status }}</div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right mr-4">
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>
@include('sweetalert::alert')
@endsection