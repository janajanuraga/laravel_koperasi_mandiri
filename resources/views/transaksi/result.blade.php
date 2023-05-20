@extends('layout.layout')

@section('content')
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Anggota KSP Mandiri</h3>          
        <!-- row -->
        <div class="row mt">
        <div class="col-md-12">
            <div class="content-panel">
            <table class="table table-striped table-advance table-hover">
                
                <hr>
                <thead>
                <tr>
                    <th></i> No. Anggota </th>
                    <th></i> Nama </th>
                    <th></i> Alamat </th>
                    <th></i> Telp </th>
                    <th></i> No. KTP </th>
                    <th></i> Jenis Kelamin </th>
                    <th></i> Saldo</th>
                    <th><i></i> Status </th>
                    <th><i class=" fa fa-edit"></i></th>
                </tr>
                </thead>
                <tbody>
                
                    <tr>
                        <td>{{ $anggota->no_anggota }}</td>
                        <td>{{ $anggota->nama }}</td>
                        <td>{{ $anggota->alamat }}</td>
                        <td>{{ $anggota->telepon }}</td>
                        <td>{{ $anggota->noktp }}</td>
                        <td>{{ $anggota->kelamin_id == 1 ? "Laki-laki" : "Perempuan" }}</td>
                        <td>{{ $anggota->saldo }}</td>
                        <td>{{ $anggota->status_aktif == 1 ? "Aktif" : "Nonaktif" }}</td>
                            <td>
                            
                            <form action="/anggota/{{$anggota->id}}" method="GET">
                                @csrf 
                                <button type="submit" class="btn btn-info btn-xs"><i class="fa fa-dollar" style="width: 10px;"></i></button>
                            </form>
                            </td>
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