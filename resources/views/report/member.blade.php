@extends('layout.layout')

@section('content')
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Report per Member </h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">

          <div class="col-sm-12">
            <section class="panel">
              <header class="panel-heading wht-bg" style="display: flex; align-items: center;">
                <h4 class="gen-case" style="flex-grow: 1;">
                    Cari Anggota
                </h4>
                <form action="/report/member" method="POST" class="pull-right mail-src-position">
                @csrf
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

@endsection

