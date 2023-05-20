@extends('layout.layout')

@section('content')
<section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Tambah Data Bunga Simpanan </h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Form Master Bunga Simpanan </h4>
              <form class="form-horizontal style-form" action="/bunga" method="post">
                @csrf
                
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Persentase Bunga</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="persentase" name="persentase" required>
                    <span class="help-block">Input tanpa %</span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Tanggal Berlaku</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggal_mulai_berlaku" name="tanggal_mulai_berlaku" required>
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