@extends('layout.layout')

@section('content')
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Anggota KSP Mandiri</h3>          
        <!-- row -->
        <div class="row mt">
        <div class="col-md-12">
            <div class="content-panel">
            <table class="table table-striped table-advance table-hover">
                <form action="/anggota/create" method="GET">
                    <button type="submit" class="btn btn-theme" style="margin-left: 10px;"><i class="fa fa-plus"></i> Tambah Anggota</button>
                </form>
                <hr>
                <thead>
                <tr>
                    <th>No.</th>
                    <th>No. Anggota </th>
                    <th>Nama </th>
                    <th>Alamat </th>
                    <th>Telp </th>
                    <th>No. KTP </th>
                    <th>Jenis Kelamin </th>
                    <th>Saldo</th>
                    <th>Status </th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @for ($i = 0; $i < count($anggota); $i++)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $anggota[$i]->no_anggota }}</td>
                        <td>{{ $anggota[$i]->nama }}</td>
                        <td>{{ $anggota[$i]->alamat }}</td>
                        <td>{{ $anggota[$i]->telepon }}</td>
                        <td>{{ $anggota[$i]->noktp }}</td>
                        <td>{{ $anggota[$i]->kelamin_id == 1 ? "Laki-laki" : "Perempuan" }}</td>
                        <td>{{ $anggota[$i]->saldo }}</td>
                        <td>{{ $anggota[$i]->status_aktif == 1 ? "Aktif" : "Nonaktif" }}</td>
                            <td>
                            @if ($anggota[$i]->status_aktif == 1)
                            <form action="/anggota/{{$anggota[$i]->id}}" method="GET">
                                @csrf 
                                <button type="submit" class="btn btn-info btn-xs"><i class="fa fa-dollar" style="width: 10px;"></i></button>
                            </form>
                            <form action="/anggota/{{$anggota[$i]->id}}/edit" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-xs"><i class="fa fa-pencil" style="width: 10px;"></i></button>
                            </form>
                            <form action="/anggota/{{$anggota[$i]->id}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" onclick="return confirm('Yakin ingin menghapus data?')" style="width: 10px;"></i></button>
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