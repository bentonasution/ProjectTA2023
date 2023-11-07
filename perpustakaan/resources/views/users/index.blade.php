@extends('layouts.app')

@section('contents')

<h3 class="font-weight-bold mb-3 ml-3 text-gray-800">Users</h3>

<div class="text-right">
    <a href="{{ route('users.exportexcel') }}" class="btn btn-success mb-3">Export Excel <i class="fas fa-file-excel"></i></a>
    <a href="{{ route('users.exportpdf') }}" class="btn btn-danger mb-3 mr-3">Export PDF <i class="fas fa-file-pdf"></i></i></i></a>
    <a href="{{ route('users.tambah') }}" class="btn btn-info mb-3 mr-3"><i class="fas fa-plus"></i> Tambah Users</a>
</div>
<div class="card shadow mb-4 border-bottom-info bg-gray-200">
    <div class="card-header py-3  border-bottom-info">
        <h6 class="m-0 font-weight-bold text-info" style="font-size: 20px; color: #3498db;">Data Users</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="/users" method="GET">
                <div class="row justify-content-end mb-3">
                    <div class="col-md-3 input-group">
                        <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-info" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <table class="table table-striped mb-4 text-gray-900" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
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
                        <td>{{ $row->kelas ?: '-' }}</td>
                        <td>{{ $row->jurusan ? $row->jurusan->nama_prodi : '-' }}</td>
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
                        <td>
                            <a href="{{ route('users.edit', $row->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-user-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm hapususers" data-users="{{ $row->id }}"><i class="fas fa-trash-alt"></i></a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $('.hapususers').click(function() {

        var usersid = $(this).attr('data-users');

        Swal.fire({
            title: 'Yakin?',
            text: "Ingin menghapus Pengguna ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yaa',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "users/hapus/" + usersid
                Swal.fire(
                    'Deleted!',
                    'Pengguna Berhasil dihapus',
                    'success',
                )
            }
        });
    });
</script>
@include('sweetalert::alert')
@endsection