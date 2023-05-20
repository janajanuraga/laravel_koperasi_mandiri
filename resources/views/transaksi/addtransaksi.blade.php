@extends('layout.layout')

@section('content')
<section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Transaksi Anggota</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <form class="form-horizontal style-form" action="/simpanan" method="post">
                @csrf
                <input type="hidden" name="anggota_id" value="{{ $transaksi->id }}">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">No. Anggota</label>
                  <div class="col-sm-10">
                    <label class="form-control">{{ $transaksi->no_anggota }}</label>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nama</label>
                  <div class="col-sm-10">
                  <label class="form-control">{{ $transaksi->nama }}</label>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Alamat</label>
                  <div class="col-sm-10">
                  <label class="form-control">{{ $transaksi->alamat }}</label>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">No. Telpon</label>
                  <div class="col-sm-10">
                  <label class="form-control">{{ $transaksi->telepon }}</label>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Saldo</label>
                  <div class="col-sm-10">
                  <label class="form-control">{{ $saldo }}</label>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Tanggal </label>
                  <div class="col-sm-10">
                  <label class="form-control">{{ date('Y-m-d')}}</label>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Jenis Transaksi </label>
                  <div class="col-sm-10">
                    <div class="radio">
                    <label>
                      <input type="radio" name="jenis_transaksi" id="Simpanan" value="1">
                      Setoran
                      </label>
                    </div>
                    <div class="radio">
                    <label>
                      <input type="radio" name="jenis_transaksi" id="Penarikan" value="2">
                      Tarikan
                      </label>
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nominal Transaksi (Rp)</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nominal_transaksi" name="nominal_transaksi">
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