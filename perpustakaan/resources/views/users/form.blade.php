@extends('layouts.app')

@section('contents')

<form action="{{ isset($users) ? route('users.tambah.update', $users->id) : route('users.tambah.simpan') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card shadow mt-4 mb-4 border-bottom-info bg-gray-200 text-gray-900">
                <div class="card-header py-3 border-bottom-info">
                    <h6 class="m-0 font-weight-bold text-info" style="font-size: 20px;">{{ isset($users) ? 'Form Edit Users' : 'Form Tambah Users'}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type='text' class="form-control" id="nama" name="nama" value="{{ isset($users) ? $users->nama : ''}}">
                                @error('nama')
                                <div class="alert alert-danger">Masukan Nama</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="" selected disabled hidden>Pilih Status</option>
                                    <option value="Admin" {{ (isset($users) && $users->status === 'Admin') ? 'selected' : '' }}>Admin</option>
                                    <option value="Petugas" {{ (isset($users) && $users->status === 'Petugas') ? 'selected' : '' }}>Petugas</option>
                                    <option value="Guru" {{ (isset($users) && $users->status === 'Guru') ? 'selected' : '' }}>Guru</option>
                                    <option value="Siswa" {{ (isset($users) && $users->status === 'Siswa') ? 'selected' : '' }}>Siswa</option>
                                </select>
                                @error('status')
                                <div class="alert alert-danger">Silahkan Pilih Status</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type='text' class="form-control" id="nik" name="nik" value="{{ isset($users) ? $users->nik : ''}}">
                                @error('nik')
                                <div class="alert alert-danger">Masukan Nik, Nik Berupa Angka, Max 16</div>
                                @enderror
                            </div>
                            <div class="id=" kelasJurusanSection>
                            <div class="row">
                                <div class="form-group col-3">
                                    <label for="kelas">Kelas</label>
                                    <input type='text' class="form-control" id="kelas" name="kelas" value="{{ isset($users) ? $users->kelas : ''}}">
                                </div>
                                <div class="form-group col-9">
                                    <label for="nama_prodi">Jurusan</label>
                                    <select name="id_prodi" id="id_prodi" class="custom-select">
                                        <option value="" selected disabled hidden>Pilih Jurusan</option>
                                        @foreach ($jurusan as $row)
                                        <option value="{{ $row->id }}" {{ (isset($users) && $users->id_prodi == $row->id) || old('id_prodi') == $row->id ? 'selected' : '' }}>{{ $row->nama_prodi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-3">
                                    <label for="nohp">No Hp</label>
                                    <input type='text' class="form-control" id="nohp" name="nohp" value="{{ isset($users) ? $users->nohp : ''}}">
                                </div>
                                <div class="form-group col-9">
                                    <label for="email">Email</label>
                                    <input type='text' class="form-control" id="email" name="email" value="{{ isset($users) ? $users->email : ''}}">
                                    @error('email')
                                    <div class="alert alert-danger">Masukan Email</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-9">
                                    <label for="password">{{ isset($users) ? '' : 'Password'}}</label>
                                    @if(!isset($users)) <!-- Cek apakah ini form tambah (data belum ada) -->
                                    <input type="text" class="form-control" id="password" name="password" value="{{ isset($users) ? $users->password : ''}}">
                                    @error('password')
                                    <div class="alert alert-danger">Masukan Passwod, Min 6</div>
                                    @enderror
                                    @endif
                                </div>
                                <div class="form-group col-3">
                                    <label for="role">{{ isset($users) ? '' : 'Role'}}</label>
                                    @if(!isset($users))
                                    <select class="form-control" id="role" name="role">
                                        <option value="" selected disabled hidden>Pilih Role</option>
                                        <option value="admin" {{ (isset($users) && $users->status === 'admin') ? 'selected' : '' }}>admin</option>
                                        <option value="petugas" {{ (isset($users) && $users->status === 'petugas') ? 'selected' : '' }}>petugas</option>
                                        <option value="user" {{ (isset($users) && $users->status === 'user') ? 'selected' : '' }}>user</option>
                                    </select>
                                    @error('role')
                                    <div class="alert alert-danger">Silahkan Pilih Role</div>
                                    @enderror
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div width="">
                            <div class="card shadow mt-2 ml-4 mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Masukan Foto</h6>
                                </div>
                                <div class="form-group">
                                    <input class="form-control mt-3 @error('foto') is-valid @enderror" type="file" id="foto" name="foto" accept="/images" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" value="{{ isset($users) ? $users->foto : ''}}">
                                    @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    @if(isset($users) && $users->foto)
                                    <label class="mt-3 ml-4 mb-4"><img src="{{ asset('ppimages/'. $users->foto) }}" id="output" width="200"></label>
                                    @else
                                    <label class="mt-3 ml-4 mb-4"><img src="" id="output" width="200"></label>
                                    @endif
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
    </div>

</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const statusField = document.getElementById("status");
        const kelasField = document.getElementById("kelas");
        const jurusanField = document.getElementById("id_prodi");

        // Fungsi untuk menampilkan/menyembunyikan bidang berdasarkan status
        function toggleFields() {
            if (statusField.value === "Admin") {
                kelasField.parentElement.style.display = "none";
                jurusanField.parentElement.style.display = "none"; // Tampilkan jurusan jika status adalah Guru
            } else if (statusField.value === "Petugas"){
                kelasField.parentElement.style.display = "none";
                jurusanField.parentElement.style.display = "none";
            } else if (statusField.value === "Guru"){
                kelasField.parentElement.style.display = "none";
                jurusanField.parentElement.style.display = "block";
            } else {
                kelasField.parentElement.style.display = "block";
                jurusanField.parentElement.style.display = "block";
            }
        }

        // Status awal
        toggleFields();

        // Perbarui bidang saat status berubah
        statusField.addEventListener("change", toggleFields);
    });
</script>


@endsection