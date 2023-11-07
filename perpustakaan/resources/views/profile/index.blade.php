@extends('layouts.app')

@section('contents')

<h3 class="font-weight-bold mb-3 ml-3 text-gray-800">Profile</h3>

<div class="row mr-5">
    <div class="col-md-4">
        <div class="card shadow mt-2 ml-4 mb-4 border-left-info">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Foto Profile</h6>
            </div>
            <div class="card-body text-center">
                <div class="form-group">
                    @if(Auth::user()->foto)
                    <img src="{{ asset('ppimages/'. Auth::user()->foto) }}" alt="Foto Profil" class="img-fluid rounded-circle">
                    @else
                    <img src="{{ asset('ppimages/user4.png') }}" alt="Default User" class="img-fluid rounded-circle">
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow mt-2 ml-2 mr-2 mb-4 border-left-info">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Details Akun</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ Auth::user()->nama }}" readonly>
                </div>
                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" value="{{ Auth::user()->nik }}" readonly>
                </div>
                @if(Auth::user()->status !== 'Guru' && Auth::user()->status !== 'Petugas' && Auth::user()->status !== 'Admin')
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="kelas">Kelas</label>
                        <input type="text" class="form-control" id="kelas" name="kelas" value="{{ Auth::user()->kelas }}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nama_prodi">Jurusan</label>
                        @php
                        $userJurusan = App\Models\Jurusan::find(Auth::user()->id_prodi);
                        @endphp
                        <input type="text" class="form-control" id="id_prodi" name="id_prodi" value="{{ $userJurusan ? $userJurusan->nama_prodi : '' }}" readonly>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="nohp">No Hp</label>
                        <input type="text" class="form-control" id="nohp" name="nohp" value="{{ Auth::user()->nohp }}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" class="form-control" id="status" name="status" value="{{ Auth::user()->status }}" readonly>
                </div>
            </div>
        </div>
    </div>
</div>
@include('sweetalert::alert')
@endsection