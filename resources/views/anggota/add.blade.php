@extends('layout.layout')

@section('content')
<section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Tambah Anggota KSP Mandiri</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Form Tambah Anggota</h4>
              <form class="form-horizontal style-form" action="/anggota" method="post">
                @csrf
                
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Alamat</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">No. Telpon</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="telepon" name="telepon"required >
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">No. KTP</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="noktp" name="noktp"required >
                    <span class="help-block">Ex.5102050101990001</span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Jenis Kelamin</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="kelamin_id" required>
                    <option value="">-Pilih-</option>
                    <option value="1">Laki-laki</option>
                    <option value="2">Perempuan</option>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-10">
                    <button class="btn btn-theme" type="submit">Submit</button>
                  </div>
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
        <!-- /row -->
      </section>

@endsection