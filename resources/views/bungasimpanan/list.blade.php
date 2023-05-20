@extends('layout.layout')

@section('content')

    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Bunga Simpanan KSP Mandiri</h3>          
        <!-- row -->
        <div class="row mt">
        <div class="col-md-12">
            <div class="content-panel">
            <table class="table table-striped table-advance table-hover">
                <form action="/bunga/create" method="GET">
                    <button type="submit" class="btn btn-theme" style="margin-left: 10px;"><i class="fa fa-plus"></i> Tambah Master Bunga Simpanan</button>
                </form>

                <hr>
                <thead>
                <tr>
                    <th>No</th>
                    <th>Persentase Bunga</th>
                    <th>Tanggal Berlaku</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @for ($i = 0; $i < count($bunga); $i++)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $bunga[$i]->persentase }}%</td>
                        <td>{{ $bunga[$i]->tanggal_mulai_berlaku }}</td>
                        <td>
                            @php
                                $tanggal_mulai_berlaku = date_create($bunga[$i]->tanggal_mulai_berlaku);
                                $tanggal_sekarang = date_create("now");
                                $perbedaan_tanggal = date_diff($tanggal_sekarang, $tanggal_mulai_berlaku);
                            @endphp
                            @if ($perbedaan_tanggal->format("%R") == "+")
                                <form action="/bunga/{{ $bunga[$i]->id }}/edit" method="GET">
                                    <button type="submit" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                                </form>
                                <form action="/bunga/{{ $bunga[$i]->id }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" onclick="return confirm('Yakin ingin menghapus data?')"></i></button>
                                </form>

                                
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