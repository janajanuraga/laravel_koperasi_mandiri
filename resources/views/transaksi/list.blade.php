@extends('layout.layout')

@section('content')
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Data Transaksi Anggota</h3>          
        <!-- row -->
        <div class="row mt">
        <div class="col-md-12">
            <div class="content-panel">
            <table class="table table-striped table-advance table-hover">
                <b>No Anggota<span style="margin-left: 13px;">: {{ $anggota->no_anggota }}</span></b><div></div>
                <b>Nama<span style="margin-left: 51px;">: {{ $anggota->nama }}</span></b><div></div>
                <b>Alamat<span style="margin-left: 44px;">: {{ $anggota->alamat }}</span></b><div></div>
                <b>Telepon<span style="margin-left: 38px;">: {{ $anggota->telepon }}</span></b><div></div>
                <b>Saldo<span style="margin-left: 51px;">: {{ $saldo }}</span></b><div></div> 

                <hr>
                <thead>
                <tr>
                    <th></i> No.</th>
                    <th></i> Tanggal </th>
                    <th></i> Debit </th>
                    <th></i> Kredit </th>
                    <th></i> Keterangan </th>
                </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($transaksi); $i++)
                    
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $transaksi[$i]->tanggal }}</td>
                            <td>{{ $transaksi[$i]->nominal_transaksi < 0 ? substr($transaksi[$i]->nominal_transaksi, 1) : "-" }}</td>
                            <td>{{ $transaksi[$i]->nominal_transaksi > 0 ? $transaksi[$i]->nominal_transaksi : "-" }}</td>
                            <td>
                                @if ($transaksi[$i]->jenis_transaksi == 1)
                                    Simpanan
                                @elseif ($transaksi[$i]->jenis_transaksi == 2)
                                    Penarikan
                                @elseif ($transaksi[$i]->jenis_transaksi == 3)
                                    Bunga
                                @elseif ($transaksi[$i]->jenis_transaksi == 4)
                                    Pajak
                                @endif
                            </td>
                        </tr>  
                    @endfor
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
        </div>
        <!-- /row -->
        </form>
    </section>
@endsection