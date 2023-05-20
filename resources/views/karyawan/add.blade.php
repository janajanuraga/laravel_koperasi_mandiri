@extends('layout.layout')

@section('content')
<section class="wrapper">
      <h3><i class="fa fa-angle-right"></i> Tambah Karyawan KSP Mandiri</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Form Tambah Karyawan</h4>
              <form class="form-horizontal style-form" action="/karyawan" method="post">
                @csrf
                
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">NIK</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nik" name="nik" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" name="username" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">User Role</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="user_role" required>
                    <option value="">-Pilih-</option>
                    <option value="1">Pengelola Simpanan</option>
                    <option value="2">Pengelola Pinjaman</option>
                    <option value="3">Admin</option> 
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-10">
                    <button class="btn btn-theme" type="submit">Submit</button>
                  </div>
                </div>
                @if(session('success'))
                  <div class="alert alert-success">
                    <p style="text-align: center"><b>{{ session('success') }}</b></p>
                  </div>
                @elseif(session('warning'))
                  <div class="alert alert-warning">
                    <p style="text-align: center"><b>{{ session('warning') }}</b></p>
                  </div>
                @elseif(session('danger'))
                  <div class="alert alert-danger">
                    <p style="text-align: center"><b>{{ session('danger') }}</b></p>
                  </div>
                @endif
          </div>
        </div>
        <!-- /row -->
      </section>

@endsection