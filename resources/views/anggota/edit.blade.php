@extends('layout.layout')

@section('content')
<section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Edit Anggota KSP Mandiri</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Form Edit Data Anggota</h4>
              <form class="form-horizontal style-form" action="/anggota/{{$anggota->id}}" method="post">
                @csrf
                @method("PUT")
 
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $anggota->nama }}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Alamat</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $anggota->alamat }}" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">No. Telpon</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="telepon" name="telepon" value="{{ $anggota->telepon }}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">No. KTP</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="noktp" name="noktp" value="{{ $anggota->noktp }}">
                    <span class="help-block">Ex.5102050101990001</span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Jenis Kelamin</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="kelamin_id">
                    <option value="">-Pilih-</option>
                    <option value="1" {{ $anggota->kelamin_id == 1 ? "selected" : "" }}>Laki-laki</option>
                    <option value="2" {{ $anggota->kelamin_id == 2 ? "selected" : "" }}>Perempuan</option> 
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