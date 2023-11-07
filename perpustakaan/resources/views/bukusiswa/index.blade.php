@extends('layouts.app')

@section('contents')

<h3 class="font-weight-bold mb-3 ml-3 text-gray-800">Buku</h3>

<div class="text-right">
    <a href="{{ route('pemesanan.tambah') }}" class="btn btn-info mb-3 mr-3">Pemesanan <i class="fas fa-plus"></i></a>
</div>
<div class="card shadow mb-4 border-bottom-info bg-gray-200">
    <div class="card-header py-3  border-bottom-info">
        <h6 class="m-0 font-weight-bold text-info" style="font-size: 20px;">Data Buku</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="/bukusiswa" method="GET">
                <div class="row justify-content-between mb-3">
                <div class="col-md-3 input-group">
                        <select class="form-control" id="kategoriFilter" name="kategori">
                            <option value="">Pilih Kategori</option>
                            @foreach($kategori as $kategori)
                            <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>
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
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Jml Buku</th>
                        <th scope="col">Yg dipinjam</th>
                        <th scope="col">Yg dipesan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php($no = 1)
                    @foreach($data as $index => $row)
                    <tr>
                        <th scope="row">{{ $index + $data->firstItem() }}</th>
                        <td>
                            <img src="{{ asset('bukuimages/'. $row->foto) }}" alt="" style="max-width: 70px;">
                        </td>
                        <td>{{ $row->judul }}</td>
                        <td>{{ $row->penerbit }}</td>
                        <td>{{ $row->kategori->nama }}</td>
                        <td>{{ $row->jmlbuku }}</td>
                        <td>{{ $row->hitungPeminjaman() }}</td>
                        <td>{{ $row->hitungPemesanan() }}</td>
                        <td>
                            <a href="{{ route('detail', $row->id) }}" class="btn btn-info btn-sm mt-1 ml-1" style="font-size:16px">Details</a>
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
    $('#kategoriFilter').change(function() {
        var selectedKategori = $(this).val();
        var currentUrl = window.location.href;
        var newUrl = updateQueryStringParameter(currentUrl, 'kategori', selectedKategori);
        window.location.href = newUrl;
    });

    function updateQueryStringParameter(uri, key, value) {
        var re = new RegExp('([?&])' + key + '=.*?(&|$)', 'i');
        var separator = uri.indexOf('?') !== -1 ? '&' : '?';
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + '=' + value + '$2');
        } else {
            return uri + separator + key + '=' + value;
        }
    }
</script>
@include('sweetalert::alert')
@endsection