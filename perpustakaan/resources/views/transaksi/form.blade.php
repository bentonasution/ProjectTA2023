@extends('layouts.app')

@section('contents')

<form action="{{ isset($transaksi) ? route('transaksi.tambah.update', $transaksi->id) : route('transaksi.tambah.simpan') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card shadow mt-4 mb-4 border-bottom-info bg-gray-200 text-gray-900">
                <div class="card-header py-3 border-bottom-info">
                    <h6 class="m-0 font-weight-bold text-info" style="font-size: 20px;">{{ isset($transaksi) ? 'Form Edit Transaksi' : 'Form Tambah Transaksi'}}</h6>
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
                                    <option value="" selected disabled hidden>-- Pilih Nama --</option>
                                    @foreach ($users as $row)
                                    <option value="{{ $row->id }}" {{ isset($transaksi) && $transaksi->users->id === $row->id ? 'selected' : '' }}>
                                        {{ $row->nama }}
                                    </option>
                                    @endforeach
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

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="tglpinjam">Tanggal Pinjam</label>
                                    <input type="date" class="form-control" id="tglpinjam" name="tglpinjam" value="{{ isset($transaksi) ? $transaksi->tglpinjam : '' }}">
                                    @error('tglpinjam')
                                    <div class="alert alert-danger">Masukkan Tanggal Pinjam</div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="tempo">Tanggal Kembali</label>
                                    <input type="date" class="form-control" id="tempo" name="tempo" value="{{ isset($transaksi) ? $transaksi->tempo : '' }}">
                                    @error('tempo')
                                    <div class="alert alert-danger">Masukkan Tempo</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="tglkembali">Pengembalian</label>
                                    <input type="date" class="form-control" id="tglkembali" name="tglkembali" value="{{ isset($transaksi) ? $transaksi->tglkembali : '' }}">
                                    @error('tglkembali')
                                    <div class="alert alert-danger">Masukkan Tanggal Kembali</div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="denda">Denda</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="denda" name="denda" value="Rp.0" readonly>
                                        <div class="input-group-append">
                                            <button class="btn btn-info" type="button" id="cekDendaButton">Cek Denda</button>
                                        </div>
                                    </div>
                                </div>
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
                                <option value="Pinjam" {{ (isset($transaksi) && $transaksi->status === 'Pinjam') ? 'selected' : '' }} {{ $pinjamCount >= 2 ? 'disabled' : '' }}>Pinjam</option>
                                <option value="Kembali" {{ (isset($transaksi) && $transaksi->status === 'Kembali') ? 'selected' : '' }}>Kembali</option>
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
    $('#cekDendaButton').on('click', function() {
        var tglKembali = new Date($('#tglkembali').val());
        var tempo = new Date($('#tempo').val()); // Perbaikan: seharusnya mengambil nilai dari elemen dengan id="tempo"
        var diffTime = tglKembali - tempo;
        var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        var dendaPerHari = 200; // Ubah sesuai dengan nilai denda per hari

        if (diffDays > 0) {
            var denda = diffDays * dendaPerHari;
            $('#denda').val('Rp.' + denda);
        } else {
            $('#denda').val('Rp.0');
        }
    });

    $(document).ready(function() {
        $('#cekDendaButton').trigger('click');
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const namaPeminjamField = document.getElementById("id_nama");
        const nomorPeminjamanField = document.getElementById("nomor_peminjaman");

        // Inisialisasi nilai nomor peminjaman berdasarkan default user terpilih
        const defaultSelectedUser = namaPeminjamField.options[namaPeminjamField.selectedIndex];
        nomorPeminjamanField.value = "NP" + defaultSelectedUser.value;

        namaPeminjamField.addEventListener("change", function() {
            const selectedUser = namaPeminjamField.options[namaPeminjamField.selectedIndex];
            nomorPeminjamanField.value = "NP" + selectedUser.value; // Format nomor peminjaman

            // Cek denda saat nama peminjam dipilih
            $('#cekDendaButton').trigger('click');
        });
    });
</script>

@endsection