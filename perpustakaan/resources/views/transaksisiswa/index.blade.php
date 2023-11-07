@extends('layouts.app')

@section('contents')

<h3 class="font-weight-bold mb-3 ml-3 text-gray-800">Transaksi</h3>

<div class="card shadow mb-4 border-bottom-info bg-gray-200">
    <div class="card-header py-3  border-bottom-info">
        <h6 class="m-0 font-weight-bold text-info" style="font-size: 20px;">Data Transaksi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="/transaksi" method="GET">
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
                        <th scope="col">Nama Peminjam</th>
                        <th scope="col">Tgl Pinjam</th>
                        <th scope="col">Tempo</th>
                        <th scope="col">Tgl Kembali</th>
                        <th scope="col">Denda</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php($no = 1)
                    @foreach($data as $index => $row)
                    <tr>
                        <th scope="row">{{ $index + $data->firstItem() }}</th>
                        <td>{{ $row->users->nama }}</td>
                        <td>{{ $row->tglpinjam }}</td>
                        <td>{{ $row->tempo }}</td>
                        <td>{{ $row->tglkembali }}</td>
                        <td>{{ $row->denda }}</td>
                        <td>
                            @if($row->status == 'Pinjam')
                            <div class="badge bg-danger text-white rounded-pill" style="font-size: 15px;">{{ $row->status }}</div>
                            @elseif($row->status == 'Kembali')
                            <div class="badge bg-success text-white rounded-pill" style="font-size: 15px;">{{ $row->status }}</div>
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