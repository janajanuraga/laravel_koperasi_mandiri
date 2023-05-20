@extends('layout.layout')

@section('content')

    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Report Bulanan</h3>          
        <!-- row -->
        <div class="row mt">
        <div class="col-md-12">
            <div class="content-panel">
   
            <section class="panel">
              <header class="panel-heading wht-bg" style="display: flex; align-items: center;">
                <h4 class="gen-case" style="flex-grow: 1;">
                    Ubah Tanggal
                </h4>

                <form action="/report/bulanan" method="GET" class="pull-right mail-src-position">
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
                    @for ($i = 0; $i < sizeof($tanggal); $i++)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $tanggal[$i] }}</td>
                        <td>{{ strstr($debit[$i], "-") ? substr($debit[$i], 1) : $debit[$i] }}</td>
                        <td>{{ $kredit[$i] }}</td>
                    </tr>
                    @endfor
                    <tr>
                        <td colspan="2">Total</td>
                        <td>{{ strstr($total_debit, "-") ? substr($total_debit, 1) : $total_debit }}</td>
                        <td>{{ $total_kredit }}</td>
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

