@extends('layout.layout')

@section('content')
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Data Transaksi User</h3>          
        <!-- row -->
        <div class="row mt">
        <div class="col-md-12">
            <div class="content-panel">
            <table class="table table-striped table-advance table-hover">
                <b>NIK<span style="margin-left: 48px;">: {{ $current_user->nik }}</span></b><div></div>
                <b>Nama<span style="margin-left: 35px;">: {{ $current_user->nama }}</span></b><div></div>
                <b>User Role
                <span style="margin-left: 6px;">: 
                    @if ($current_user->user_role == 1)
                        Pengelola Simpanan
                    @elseif ($current_user->user_role == 2)
                        Pengelola Pinjaman
                    @elseif ($current_user->user_role == 3)
                        Admin
                    @endif
                </span></b><div></div>

                <hr>
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal </th>
                    <th>No. Anggota</th>
                    <th>Nominal Transaksi</th>
                    <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($transaksi); $i++)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $transaksi[$i]->tanggal }}</td>
                            <td>{{ $no_anggota[$i] }}</td>
                            <td>{{ $transaksi[$i]->nominal_transaksi }}</td>
                            <td>
                                @if ($transaksi[$i]->jenis_transaksi == 1)
                                    Penyetoran
                                @elseif ($transaksi[$i]->jenis_transaksi == 2)
                                    Penarikan
                                @elseif ($transaksi[$i]->jenis_transaksi == 3)
                                    Bunga Simpanan
                                @elseif ($transaksi[$i]->jenis_transaksi == 4)
                                    Pajak Simpanan
                                @endif
                            </td>
                        </tr>
                    @endfor
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