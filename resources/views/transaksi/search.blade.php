@extends('layout.layout')

@section('content')
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Tambah Transaksi KSP Mandiri</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">

          <div class="col-sm-12">
            <section class="panel">
              <header class="panel-heading wht-bg" style="display: flex; align-items: center;">
                <h4 class="gen-case" style="flex-grow: 1;">
                    Cari Anggota
                </h4>

                <form action="/cari" method="GET" class="pull-right mail-src-position">
                  <div class="input-append" style="display: flex;">
                    <input type="text" class="form-control" name="no_anggota" placeholder="Cari Anggota">
                    <div class="form-group" style="margin-bottom: 0;">
                      <div class="col-lg-offset-2 col-lg-10" style="margin-left: -20px;">
                        <button class="btn btn-theme" type="submit">Cari</button>
                      </div>
                    </div>
                  </div>              
                </form>
              </header>
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
            </section>
          </div>
        </div>
      </section>
            
        <div class="col-md-12">
            <div class="content-panel">
            <table class="table table-striped table-advance table-hover">
            <h3>Simpanan 7 Hari Terakhir</h3>
                
                <hr>
                <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jumlah Penyetoran</th>
                    <th>Jumlah Penarikan</th>
                    
                </tr>
                </thead>
                <tbody>
                
                    <tr>
                    @for ($i = 0; $i < count($simpanan); $i++)
                      <tr>
                          <td>{{ $i+1 }}</td>
                          <td>{{ $simpanan[$i]->tanggal }}</td>
                          <td>{{ $simpanan[$i]->penyetoran }}</td>
                          <td>{{ strstr($simpanan[$i]->penarikan, "-") ? substr($simpanan[$i]->penarikan, 1) : $simpanan[$i]->penarikan }}</td>
                      </tr>
                    @endfor
                    </tr>   
                </tbody>
            
            </table>
            </div>
            <!-- /content-panel -->
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
        <!-- /col-md-12 -->        

@endsection