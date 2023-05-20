@extends('layout.layout')

@section('content')
<section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Edit Data Bunga Simpanan </h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Form Master Bunga Simpanan </h4>
              <form class="form-horizontal style-form" action="/bunga/{{$bunga -> id }}" method="post">
                @csrf
                @method("put")
                
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Persentase Bunga</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="persentase" name="persentase" value="{{ $bunga->persentase }}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Tanggal Berlaku</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggal_mulai_berlaku" name="tanggal_mulai_berlaku"  value="{{ $bunga->tanggal_mulai_berlaku }}">
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