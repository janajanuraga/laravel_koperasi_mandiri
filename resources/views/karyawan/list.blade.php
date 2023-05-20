@extends('layout.layout')

@section('content')
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Karyawan KSP Mandiri</h3>          
        <!-- row -->
        <div class="row mt">
        <div class="col-md-12">
            <div class="content-panel">
            <table class="table table-striped table-advance table-hover">
                <form action="/karyawan/create" method="GET">
                    <button type="submit" class="btn btn-theme" style="margin-left: 10px;"><i class="fa fa-plus"></i> Tambah Karyawan</button>
                </form>

                <hr>
                <thead>
                <tr>
                    <th>No.</th>
                    <th>NIK </th>
                    <th>Nama </th>
                    <th>User Role </th>
                    <th>Status </th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= sizeof($karyawan); $i++)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $karyawan[$i-1]->nik }}</td>
                            <td>{{ $karyawan[$i-1]->nama }}</td>
                            <td>
                                @if ($karyawan[$i-1]->user_role == 1)
                                    Pengelola Simpanan
                                @elseif ($karyawan[$i-1]->user_role == 2)
                                    Pengelola Pinjaman
                                @elseif ($karyawan[$i-1]->user_role == 3)
                                    Admin
                                @endif
                            </td>
                            <td>{{ $karyawan[$i-1]->status_aktif == 1 ? "Aktif" : "Nonaktif" }}</td> 
                            <td>
                            @if ($karyawan[$i-1]->status_aktif == 1)
                            <form action="/karyawan/{{$karyawan[$i-1]->id}}" method="GET">
                                <button type="submit" class="btn btn-info btn-xs"><i class="fa fa-dollar" style="width: 10px;"></i></button>
                            </form>
                            <form action="/karyawan/{{$karyawan[$i-1]->id}}/edit" method="GET">
                                <button type="submit" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                            </form>
                            <form action="/karyawan/{{$karyawan[$i-1]->id}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" onclick="return confirm('Yakin ingin menonaktifkan user?')"></i></button>
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