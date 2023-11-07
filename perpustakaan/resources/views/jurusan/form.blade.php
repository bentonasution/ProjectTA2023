@extends('layouts.app')

@section('contents')

<form action="{{ isset($jurusan) ? route('jurusan.tambah.update', $jurusan->id) : route('jurusan.tambah.simpan') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card shadow mt-4 mb-4 border-bottom-info bg-gray-200 text-gray-900">
                <div class="card-header py-3 border-bottom-info">
                    <h6 class="m-0 font-weight-bold text-info" style="font-size: 20px;">{{ isset($jurusan) ? 'Form Edit Jurusan' : 'Form Tambah Jurusan'}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label for="nama_prodi">Jurusan</label>
                                <input type='text' class="form-control" id="nama_prodi" name="nama_prodi" value="{{ isset($jurusan) ? $jurusan->nama_prodi : ''}}">
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea type='text' class="form-control" id="keterangan" name="keterangan" style="height: 90px" placeholder="Comment Here">{{ isset($kategori) ? $kategori->keterangan : ''}}</textarea>
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
@endsection