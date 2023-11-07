@extends('layouts.app')

@section('contents')

<h3 class="font-weight-bold mb-3 ml-3 text-gray-800">Jurusan</h3>

<div class="text-right">
    <a href="{{ route('jurusan.tambah') }}" class="btn btn-info mb-3 mr-3">Tambah Jurusan <i class="fas fa-plus"></i></a>
</div>
<div class="card shadow mb-4 border-bottom-info bg-gray-200">
    <div class="card-header py-3  border-bottom-info">
        <h6 class="m-0 font-weight-bold text-info" style="font-size: 20px;">Data Jurusan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="/jurusan" method="GET">
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
                        <th scope="col">Nama Jurusan</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php($no = 1)
                    @foreach($data as $index => $row)
                    <tr>
                        <th scope="row">{{ $index + $data->firstItem() }}</th>
                        <td>{{ $row->nama_prodi }}</td>
                        <td>
                            @if ($row->keterangan)
                            {{ $row->keterangan }}
                            @else
                            <text>Tidak Ada Keterangan</text>
                            @endif
                        </td>  
                        <td>
                            <a href="{{ route('jurusan.edit', $row->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-user-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm hapusjurusan" data-jurusan="{{ $row->id }}"><i class="fas fa-trash-alt"></i></a>
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
    $('.hapusjurusan').click(function() {

        var jurusanid = $(this).attr('data-jurusan');

        Swal.fire({
            title: 'Yakin?',
            text: "Ingin menghapus jurusan ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yaa',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "jurusan/hapus/" + jurusanid
                Swal.fire(
                    'Deleted!',
                    'Jurusan Berhasil dihapus',
                    'success',
                )
            }
        });
    });
</script>
@include('sweetalert::alert')
@endsection