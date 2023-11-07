@extends('layouts.app')

@section('contents')

<h3 class="font-weight-bold mb-3 ml-3 text-gray-800">Pemesanan</h3>

<div class="card shadow mb-4 border-bottom-info bg-gray-200">
    <div class="card-header py-3  border-bottom-info">
        <h6 class="m-0 font-weight-bold text-info" style="font-size: 20px;">Data Pemesanan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="/transaksidipesan" method="GET">
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
                        <th scope="col">NP</th>
                        <th scope="col">Nama Peminjam</th>
                        <th scope="col">Buku</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php($no = 1)
                    @foreach($data as $index => $row)
                        @if($row->status == 'Dipesan') <!-- Tampilkan hanya jika status adalah 'Pinjam' -->
                        <tr>
                            <th scope="row">{{ $index + $data->firstItem() }}</th>
                            <td>NP{{ $row->users->id }}</td>
                            <td>{{ $row->users->nama }}</td>
                            <td>{{ $row->buku->judul }}</td>
                            <td>
                                <div class="badge bg-secondary text-white rounded-pill" style="font-size: 15px;">{{ $row->status }}</div>
                            </td>
                            <td>
                                <a href="{{ route('transaksidipesan.edit', $row->id) }}" class="btn btn-info btn-sm">Ubah Status</a>
                            </td>
                        </tr>
                        @endif
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