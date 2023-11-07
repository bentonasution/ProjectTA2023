@extends('layouts.app')

@section('contents')

<h3 class="font-weight-bold mb-3 ml-3 text-gray-800">Details</h3>

<div class="row mr-5">
    <div class="col-md-4">
        <div class="card shadow mt-2 ml-4 mb-4 border-left-info">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Foto Buku</h6>
            </div>
            <div class="card-body text-center">
                <div class="form-group">
                    <img style="width: 90%;" src="{{ asset('bukuimages/'. $buku->foto) }}">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow mt-2 ml-2 mr-2 mb-4 border-left-info">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Details Buku</h6>
            </div>
            <div class="form-group mt-4 ml-4 mr-5">
                <span>Judul</span><span style="margin-left: 50px;">:</span>
                <span>{{ isset($buku) ? $buku->judul : '' }}</span>
            </div>
            <div class="form-group mt-2 ml-4 mr-5">
                <span>Pengarang</span><span style="margin-left: 10px;">:</span>
                <span>{{ isset($buku) ? $buku->pengarang : '' }}</span>
            </div>
            <div class="form-group mt-2 ml-4 mr-5">
                <span>ISBN</span><span style="margin-left: 52px;">:</span>
                <span>{{ isset($buku) ? $buku->isbn : '' }}</span>
            </div>
            <div class="form-group mt-2 ml-4 mr-5">
                <span>Penerbit</span><span style="margin-left: 29px;">:</span>
                <span>{{ isset($buku) ? $buku->penerbit : '' }}</span>
            </div>
            <div class="form-group mt-2 ml-4 mr-5">
                <span>Tahun Terbit</span><span>:</span>
                <span>{{ isset($buku) ? $buku->tahun : '' }}</span>
            </div>
            <div class="form-group mt-2 ml-4 mr-5">
                <span>Kategori</span><span style="margin-left: 30px;">:</span>
                <span>{{ isset($buku) ? $buku->id_kategori : '' }}</span>
            </div>
            <div class="form-group mt-2 ml-4 mr-5">
                <span>Halaman</span><span style="margin-left: 26px;">:</span>
                <span>{{ isset($buku) ? $buku->jmlhal : '' }}</span>
            </div>
            <div class="form-group mt-2 ml-4 mr-5">
                <span>Buku</span><span style="margin-left: 55px;">:</span>
                <span>{{ isset($buku) ? $buku->jmlbuku : '' }} Pcs</span>
            </div>
            <div class="form-group mt-2 ml-4 mr-5">
                <span>Rak Buku</span><span style="margin-left: 25px;">:</span>
                <span>{{ isset($buku) ? $buku->rak : '' }}</span>
            </div>
            <div style="text-align: justify;" class="form-group mt-2 ml-4 mr-5">
                <span>Sinopsis</span><span style="margin-left: 28px;">:</span>
                <span>{{ isset($buku) ? $buku->sinopsis : '' }}</span>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
    @endsection