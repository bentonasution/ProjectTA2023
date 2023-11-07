@extends('layouts.app')

@section('contents')

<form action="{{ isset($buku) ? route('buku.tambah.update', $buku->id) : route('buku.tambah.simpan') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card shadow mt-4 mb-4 border-bottom-info bg-gray-200 text-gray-900">
                <div class="card-header py-3 border-bottom-info">
                    <h6 class="m-0 font-weight-bold text-info" style="font-size: 20px;">{{ isset($buku) ? 'Form Edit Buku' : 'Form Tambah Buku'}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label for="judul">Judul Buku</label>
                                <input type='text' class="form-control" id="judul" name="judul" value="{{ isset($buku) ? $buku->judul : ''}}">
                                @error('judul')
                                <div class="alert alert-danger">Masukan Judul</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="form-group col-8">
                                    <label for="pengarang">Pengarang</label>
                                    <input type='text' class="form-control" id="pengarang" name="pengarang" value="{{ isset($buku) ? $buku->pengarang : ''}}"></select>
                                    @error('pengarang')
                                    <div class="alert alert-danger">Masukan Pengarang</div>
                                    @enderror
                                </div>
                                <div class="form-group col-4">
                                    <label for="isbn">ISBN</label>
                                    <input type='text' class="form-control" id="isbn" name="isbn" value="{{ isset($buku) ? $buku->isbn : ''}}">
                                    @error('isbn')
                                    <div class="alert alert-danger">ISBN tidak boleh kosong</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="jmlbuku">Jumlah Buku</label>
                                    <input type='text' class="form-control" id="jmlbuku" name="jmlbuku" value="{{ isset($buku) ? $buku->jmlbuku : ''}}">
                                    @error('jmlbuku')
                                    <div class="alert alert-danger">Jumlah Buku harus berisikan angka dan tidak boleh kosong</div>
                                    @enderror
                                </div>
                                <div class="form-group col-4">
                                    <label for="jmlhal">Jumlah Halaman</label>
                                    <input type='text' class="form-control" id="jmlhal" name="jmlhal" value="{{ isset($buku) ? $buku->jmlhal : ''}}">
                                    @error('jmlhal')
                                    <div class="alert alert-danger">Halaman harus berisikan angka dan tidak boleh kosong</div>
                                    @enderror
                                </div>
                                <div class="form-group col-4">
                                    <label for="tahun">Tahun Terbit</label>
                                    <input type='text' class="form-control" id="tahun" name="tahun" value="{{ isset($buku) ? $buku->tahun : ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kategori_buku">Kategori</label>
                                <select name="id_kategori" id="id_kategori" class="custom-select">
                                    <option value="" selected disabled hidden>Pilih Kategori</option>
                                    @foreach ($kategori as $row)
                                    <option value="{{ $row->id }}" {{ (isset($buku) && $buku->id_kategori == $row->id) || old('id_kategori') == $row->id ? 'selected' : '' }}>{{ $row->nama }}</option>
                                    @endforeach
                                </select>
                                @error('id_kategori')
                                <div class="alert alert-danger">Silahkan pilih kategori</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="penerbit">Penerbit</label>
                                    <input type='text' class="form-control" id="penerbit" name="penerbit" value="{{ isset($buku) ? $buku->penerbit : ''}}">
                                    @error('penerbit')
                                    <div class="alert alert-danger">Masukan Penerbit</div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="rak">Rak</label>
                                    <input type='text' class="form-control" id="rak" name="rak" value="{{ isset($buku) ? $buku->rak : ''}}">
                                    @error('rak')
                                    <div class="alert alert-danger">Masukan Rak</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sinopsis">Sinopsis</label>
                                <textarea class="form-control mb-3" placeholder="Comment Here" id="sinopsis" name="sinopsis" style="height: 90px">{{ isset($buku) ? $buku->sinopsis : ''}}</textarea>
                            </div>
                        </div>
                        <div width="">
                            <div class="card shadow mt-2 ml-4 mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Masukan Foto</h6>
                                </div>
                                <div class="form-group">
                                    <input value="{{ isset($buku) ? $buku->foto : '' }}" class="form-control mt-3 @error('foto') is-valid @enderror" type="file" id="foto" name="foto" accept="/bukuimages" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                                    @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    @if(isset($buku) && $buku->foto)
                                    <label class="mt-3 ml-4 mb-4"><img src="{{ asset('bukuimages/'. $buku->foto) }}" id="output" width="200"></label>
                                    @else
                                    <label class="mt-3 ml-4 mb-4"><img src="" id="output" width="200"></label>
                                    @endif
                                </div>
                            </div>
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