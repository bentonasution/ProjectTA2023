@extends('layouts.app')

@section('contents')

<form action="{{ isset($transaksi) ? route('pemesanan.tambah.update', $transaksi->id) : route('pemesanan.tambah.simpan') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card shadow mt-4 mb-4 border-bottom-info bg-gray-200 text-gray-900">
                <div class="card-header py-3 border-bottom-info">
                    <h6 class="m-0 font-weight-bold text-info" style="font-size: 20px;">{{ isset($transaksi) ? 'Form Edit Transaksi' : 'Form Pemesanan Buku'}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label for="nomor_peminjaman">Nomor Peminjaman</label>
                                <input type="text" class="form-control" id="nomor_peminjaman" name="nomor_peminjaman" value="{{ $transaksi->nomor_peminjaman ?? '' }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="id_nama">Nama Peminjam</label>
                                <select name="id_nama" id="id_nama" class="custom-select">
                                    <option value="" selected disabled hidden>Pilih Nama Anda</option>
                                    <option value="{{ auth()->user()->id }}">
                                        {{ auth()->user()->nama }}
                                    </option>
                                </select>
                                @error('id_nama')
                                <div class="alert alert-danger">Masukan Nama</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="id_judul">Buku yg dipinjam</label>
                                <select name="id_judul" id="id_judul" class="custom-select">
                                    <option value="" selected disabled hidden>-- Pilih Buku --</option>
                                    @foreach ($buku as $row)
                                    <option value="{{ $row->id }}" {{ isset($transaksi) && $transaksi->buku->id === $row->id ? 'selected' : '' }}>
                                        {{ $row->judul }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('id_judul')
                                <div class="alert alert-danger">Masukan Buku</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-4">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="" selected disabled hidden>-- Pilih Status --</option>
                                @php
                                $pinjamCount = 0;
                                if (isset($transaksi) && $transaksi->status === 'Pinjam' && $transaksi->user) {
                                $pinjamCount = $transaksi->user->pinjamTransactions->count();
                                }
                                @endphp
                                <option value="Dipesan" {{ (isset($transaksi) && $transaksi->status === 'Dipesan') ? 'selected' : '' }}>Dipesan</option>
                            </select>
                            @if ($pinjamCount >= 2)
                            <small class="text-danger">Peminjam sudah mencapai batas maksimal pinjaman</small>
                            @else
                            @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info" id="tambahdata">Simpan Data <i class="fas fa-save"></i></button>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const namaPeminjamField = document.getElementById("id_nama");
        const nomorPeminjamanField = document.getElementById("nomor_peminjaman");

        namaPeminjamField.addEventListener("change", function() {
            const selectedUser = namaPeminjamField.options[namaPeminjamField.selectedIndex];
            nomorPeminjamanField.value = "NP" + selectedUser.value; // Format nomor peminjaman

            // Cek denda saat nama peminjam dipilih
            $('#cekDendaButton').trigger('click');
        });
    });
</script>

@endsection