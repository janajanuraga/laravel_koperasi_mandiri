<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>KSP Mandiri</title>

  <!-- Favicons -->
  <link href="/img/koperasi.png" rel="icon">
  <link href="/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker/css/datepicker.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-daterangepicker/daterangepicker.css" />
  <!-- Custom styles for this template -->
  <link href="/css/style.css" rel="stylesheet">
  <link href="/css/style-responsive.css" rel="stylesheet">

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>
<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="/" class="logo"><b>KSP<span>Mandiri</span></b></a>
      <!--logo end-->
      <div class="nav notify-row" id="top_menu">       
        
      </div>
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li>
            <form action="/logout" method="POST">
              @csrf
              <div class="btn-group">
                <button class="btn btn-theme" type="submit" style="margin-top : 10px;">Logout</button>
              </div>
            </form>
          </li>
        </ul>
      </div>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><img src="/img/koperasi.png" class="img-circle" width="80" style="background-color: gray;"></a></p>
          <h4 class="centered" style="color: white;">{{ $user->nama }}</h4>
                <h5 class="centered">
                    <span>
                        @if ($user->user_role == 1)
                            Pengelola Simpanan
                        @elseif ($user->user_role == 2)
                            Pengelola Pinjaman
                        @elseif ($user->user_role == 3)
                            Admin
                        @endif
                    </span>
                </h5>

          <li class="mt">
            <a class="active" href="/">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
              </a>
          </li>
            <li class="sub-menu">
              <a href="javascript:;">
                <i class="fa fa-desktop"></i>
                <span>Master Data</span>
                </a>
              <ul class="sub">
                <li><a href="/karyawan">Data User</a></li>
                <li><a href="/anggota">Data Anggota</a></li>
                <li><a href="/bunga">Data Bunga</a></li>
              </ul>
            </li>
            <li class="sub-menu">
              <a href="javascript:;">
                <i class="fa fa-money"></i>
                <span>Transaksi</span>
              </a>
              <ul class="sub">
                <li><a href="/simpanan">Setoran & Penarikan</a></li>
                <li><a href="/bungasimpanan">Perhitungan Bunga</a></li>
              </ul>
            </li>
            <li class="sub-menu">
              <a href="javascript:;">
                <i class="fa fa-book"></i>
                <span>Report</span>
              </a>
              <ul class="sub">
                <li><a href="/report/member">Report per Member</a></li>
                <li><a href="/report/harian">Report Harian</a></li>
                <li><a href="/report/mingguan">Report Mingguan</a></li>
                <li><a href="/report/bulanan">Report Bulanan</a></li>
                <li><a href="/report/tahunan">Report Tahunan</a></li>
              </ul>
            </li>
          <!-- <li>
            <a href="/profil">
              <i class="fa fa-sign-in {{ Request::is('profil') ? 'active' : '' }}"></i>
              <span>Profil</span>
              </a>
          </li> -->
          
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>

    <section id="main-content">
        @yield('content')
    </section>

    
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="/lib/jquery/jquery.min.js"></script>
  <script src="/lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="/lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="/lib/jquery.scrollTo.min.js"></script>
  <script src="/lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="/lib/common-scripts.js"></script>
  <!--script for this page-->
  <script src="/lib/jquery-ui-1.9.2.custom.min.js"></script>
  <!--custom switch-->
  <script src="/lib/bootstrap-switch.js"></script>
  <!--custom tagsinput-->
  <script src="/lib/jquery.tagsinput.js"></script>
  <!--custom checkbox & radio-->
  <script type="text/javascript" src="/lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="/lib/bootstrap-daterangepicker/date.js"></script>
  <script type="text/javascript" src="/lib/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="/lib/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
  <script src="/lib/form-component.js"></script>

</body>

</html>