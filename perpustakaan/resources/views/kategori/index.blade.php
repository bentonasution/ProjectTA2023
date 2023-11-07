@extends('layouts.app')

@section('contents')

<h3 class="font-weight-bold mb-3 ml-3 text-gray-800">Kategori</h3>

<div class="text-right">
    <a href="{{ route('kategori.tambah') }}" class="btn btn-info mb-3 mr-3">Tambah Kategori <i class="fas fa-plus"></i></a>
</div>
<div class="card shadow mb-4 border-bottom-info bg-gray-200">
    <div class="card-header py-3  border-bottom-info">
        <h6 class="m-0 font-weight-bold text-info" style="font-size: 20px;">Data Kategori</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="/kategori" method="GET">
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
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php($no = 1)
                    @foreach($data as $index => $row)
                    <tr>
                        <th scope="row">{{ $index + $data->firstItem() }}</th>
                        <td>{{ $row->nama }}</td>
                        <td>
                            @if ($row->keterangan)
                            {{ $row->keterangan }}
                            @else
                            <text>Tidak Ada Keterangan</text>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('kategori.edit', $row->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-user-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm hapuskategori" data-kategori="{{ $row->id }}"><i class="fas fa-trash-alt"></i></a>
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
    $('.hapuskategori').click(function() {

        var kategoriid = $(this).attr('data-kategori');

        Swal.fire({
            title: 'Yakin?',
            text: "Ingin menghapus kategori ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yaa',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "kategori/hapus/" + kategoriid
                Swal.fire(
                    'Deleted!',
                    'Kategori Berhasil dihapus',
                    'success',
                )
            }
        });
    });
</script>
@include('sweetalert::alert')
@endsection