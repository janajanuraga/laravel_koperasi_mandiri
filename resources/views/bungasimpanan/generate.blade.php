@extends('layout.layout')

@section('content')
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Proses Bunga Simpanan</h3>          
        <!-- row -->
        <div class="row mt">
        <div class="col-md-12">
            <div class="content-panel">
            <table class="table table-striped table-advance table-hover">
                <b>Bulan<span style="margin-left: 88px;">: {{ $detail->bulan }}</span></b><div></div>
                <b>Tahun<span style="margin-left: 86px;">: {{ $detail->tahun }}</span></b><div></div>
                <b>Persentase Bunga<span style="margin-left: 10px;">: {{ $detail->persentase_bunga }}%</span></b><div></div>
                <b>Status<span style="margin-left: 84px;">: {{ $detail->status == 0 ? "Belum Diproses" : "Sudah Diproses" }}</span></b><div></div>
                
                <hr>
                <thead>
                <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Tanggal Proses</th>
                    <th>Persentase Bunga</th>
                    <th>User</th>
                </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($transaksi); $i++)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $transaksi[$i]->trx_bulan }}</td>
                            <td>{{ $transaksi[$i]->trx_tahun }}</td>
                            <td>{{ $transaksi[$i]->tanggal_proses }}</td>
                            <td>{{ $transaksi[$i]->persentase_bunga }}</td>
                            <td>{{ $users[$i] }}</td>
                        </tr>
                    @endfor
                </tbody>
            
            </table>
            @if ($detail->status == 0 && date("Y-m-d") == date("Y-m-t"))
                <div class="detail-footer">
                    <form action="/bungasimpanan" method="POST">
                    @csrf
                        <button type="submit" style="margin-left: 10px;" class="btn btn-theme">Proses</button>
                    </form>
                </div>
            @endif
            </div>
            <!-- /content-panel -->
        </div>
        <!-- /col-md-12 -->
        </div>
        <!-- /row -->
        </form>
    </section>

@endsection