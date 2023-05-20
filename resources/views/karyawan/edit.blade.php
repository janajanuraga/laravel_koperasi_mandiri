@extends('layout.layout')

@section('content')
<section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Edit Anggota KSP Mandiri</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Form Edit Data Anggota</h4>
              <form class="form-horizontal style-form" action="/karyawan/{{$karyawan->id}}" method="post">
                @csrf
                @method("PUT")
                
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">NIK</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nik" name="nik" value="{{ $karyawan->nik }}" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $karyawan->nama }}" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" name="username" value="{{ $karyawan->username }}"required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">User Role</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="user_role" required>
                    <option value="">-Pilih-</option>
                    <option value="1" {{ $karyawan->user_role == 1 ? "selected" : "" }}>Pengelola Simpanan</option>
                    <option value="2" {{ $karyawan->user_role == 2 ? "selected" : "" }}>Pengelola Pinjaman</option>
                    <option value="3" {{ $karyawan->user_role == 3 ? "selected" : "" }}>Admin</option> 
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-10">
                    <button class="btn btn-theme" type="submit">Submit</button>
                  </div>
                </div>
          </div>
        </div>
        <!-- /row -->
      </section>

@endsection