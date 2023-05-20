@extends('layout.layout')

@section('content')

<head>
<link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
<link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
<!-- Custom styles for this template -->
<link href="css/style.css" rel="stylesheet">
<link href="css/style-responsive.css" rel="stylesheet">
<script src="lib/chart-master/Chart.js"></script>

</head>
<body>
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12 main-chart">
            <!--CUSTOM CHART START -->

            <!--custom chart end-->
            <div class="row mt">
              <!-- SERVER STATUS PANELS -->
              <div class="col-md-4 col-sm-4 mb">
                <div class="grey-panel pn donut-chart">
                  <div class="grey-header">
                    <h5>TOTAL ANGGOTA</h5>
                  </div>
                  
                  <div class="chart mt">
                    <div class="col-sm-12 col-xs-6">
                      <h2 style="font-size: 70px;">{{ $jumlahAnggota }}</h2>
                    </div>
                  </div>
                </div>
                <!-- /grey-panel -->
              </div>
              <!-- /col-md-4-->
              <div class="col-md-4 col-sm-4 mb">
                <div class="darkblue-panel pn">
                  <div class="darkblue-header">
                    <h5>TOTAL SIMPANAN</h5>
                  </div>

                  <div class="chart mt">
                  <p>{{ date("Y-m-d") }}</p>
                    <div class="col-sm-12 col-xs-6">
                      <h2 style="color: white;">Rp.{{ $totalSimpanan }}</h2>
                    </div>
                  </div>                  
                </div>
                <!--  /darkblue panel -->
              </div>
              <!-- /col-md-4 -->
              <div class="col-md-4 col-sm-4 mb">
                <!-- REVENUE PANEL -->
                <div class="green-panel pn">
                  <div class="green-header">
                    <h5>BUNGA SIMPANAN</h5>
                  </div>
                  <div class="chart mt">
                  </div>
                  <div><h3 style="font-size: 70px;">{{$bungaSimpanan ? $bungaSimpanan->persentase : 0}}%</h3></div>
                </div>
              </div>
              <!-- /col-md-4 -->
            </div>          
            <!-- /row -->
          </div>
          <!-- /col-lg-9 END SECTION MIDDLE -->
      </section>

<script src="/lib/jquery/jquery.min.js"></script>

<script src="/lib/bootstrap/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="/lib/jquery.dcjqaccordion.2.7.js"></script>
<script src="/lib/jquery.scrollTo.min.js"></script>
<script src="/lib/jquery.nicescroll.js" type="text/javascript"></script>
<script src="/lib/jquery.sparkline.js"></script>

<!--script for this page-->
<script src="/lib/sparkline-chart.js"></script>
<script src="/lib/zabuto_calendar.js"></script>
<script type="text/javascript">
  
</script>
<script type="application/javascript">
  $(document).ready(function() {
    $("#date-popover").popover({
      html: true,
      trigger: "manual"
    });
    $("#date-popover").hide();
    $("#date-popover").click(function(e) {
      $(this).hide();
    });

    $("#my-calendar").zabuto_calendar({
      action: function() {
        return myDateFunction(this.id, false);
      },
      action_nav: function() {
        return myNavFunction(this.id);
      },
      ajax: {
        url: "show_data.php?action=1",
        modal: true
      },
      legend: [{
          type: "text",
          label: "Special event",
          badge: "00"
        },
        {
          type: "block",
          label: "Regular event",
        }
      ]
    });
  });

  function myNavFunction(id) {
    $("#date-popover").hide();
    var nav = $("#" + id).data("navigation");
    var to = $("#" + id).data("to");
    console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
  }
</script>
</body>

@endsection