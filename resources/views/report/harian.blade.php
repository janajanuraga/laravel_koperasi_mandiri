@extends('layout.layout')

@section('content')
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Report Harian</h3>          
        <!-- row -->
        <div class="row mt">
        <div class="col-md-12">
            <div class="content-panel">
   
            <section class="panel">
              <header class="panel-heading wht-bg" style="display: flex; align-items: center;">
                <h4 class="gen-case" style="flex-grow: 1;">
                    Ubah Tanggal
                </h4>

                <form action="/report/harian" method="GET" class="pull-right mail-src-position">
                  <div class="input-append" style="display: flex;">
                    <input type="date" class="form-control" name="tanggal" placeholder="Masukkan Tanggal">
                    <div class="form-group" style="margin-bottom: 0;">
                      <div class="col-lg-offset-2 col-lg-10" style="margin-left: -20px;">
                        <button class="btn btn-theme" type="submit">Cari</button>
                      </div>
                    </div>
                  </div>              
                </form>
              </header>
            </section>

            <table class="table table-striped table-advance table-hover">

            <hr>
                <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                </tr>
                </thead>
                <tbody>                    
                        <tr>
                        <td>1</td>
                        <td>{{ $tanggal }}</td>
                        <td>{{ strstr($debit, "-") ? substr($debit, 1) : $debit }}</td>
                        <td>{{ $kredit }}</td> 
                        </tr>  
                </tbody>
            
            </table>
            </div>
            <!-- /content-panel -->
        </div>
        <!-- /col-md-12 -->
        </div>
        <!-- /row -->
        </form>
    </section>

       
@endsection

