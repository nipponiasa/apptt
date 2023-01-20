@extends('adminlte::page')
@section('title', 'Apps - Trade And Traffic')
@section('content_header')
<a href="{{ URL::previous() }}">Go Back</a>
    <h1>Statistics based on units registered in Belgium</h1>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

@stop


@section('plugins.Datatables', true)
@section('content')






   <!-- arxi -->
<div class="row">
    <div class="col-md-6">
      <!-- Line chart -->
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">
            <i class="far fa-chart-bar"></i>
            Total Registrations in Belgium for 2020
          </h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
        <canvas id="registrationschart" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;" ></canvas>
        </div>
        <!-- /.card-body-->
      </div>
      <!-- /.card -->


    </div>
    <!-- /.col -->

 
    <div class="col-md-6">
        <!-- Line chart -->
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="far fa-chart-bar"></i>
              Nipponia's Brands registrations distribution for 2020
            </h3>
  
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <canvas id="donutChart" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;" ></canvas>
          </div>
          <!-- /.card-body-->
        </div>
        <!-- /.card -->
  
  
      </div>
      <!-- /.col -->










    <!-- /.col -->
  </div>

 <!-- telos -->















   <!-- arxi -->
   <div class="row">
    <div class="col-md-6">
      <!-- Line chart -->
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">
            <i class="far fa-chart-bar"></i>
            Percentage (%) of MC2 (max 45km/h) registered to total (MC1+MC2)
          </h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
        <canvas id="line-chart" width="400" height="225"></canvas>
        </div>
        <!-- /.card-body-->
      </div>
      <!-- /.card -->


    </div>
    <!-- /.col -->

 
    <div class="col-md-6">
        <!-- Line chart -->
      
        <!-- /.card -->
  
  
      </div>
      <!-- /.col -->










    <!-- /.col -->
  </div>

 <!-- telos -->

















             
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Brand</th>
                                <th>Category</th>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Units</th>
                        </tr>
                        </thead>
                    <tbody>
             
                    
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                
@stop


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@stop

@section('js')
<script>
$(document).ready(function() {
    var groupColumn = 0;
    var table = $('#example').DataTable({
        "columnDefs": [
            { "visible": false, "targets": groupColumn }
        ],
        "order": [[ groupColumn, 'asc' ]],
        "displayLength": 25,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        }
    } );
 
    // Order by the grouping
    $('#example tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
            table.order( [ groupColumn, 'desc' ] ).draw();
        }
        else {
            table.order( [ groupColumn, 'asc' ] ).draw();
        }
    } );
} );

</script>

<script>
new Chart(document.getElementById("line-chart"), {
  type: 'line',
  data: {
    labels: [
      @php
        echo App\StatCountr::ratio45tototal("statbe","MC2")['label'];
      @endphp
      ],
    datasets: [{ 
      


        data: [@php
        echo App\StatCountr::ratio45tototal("statbe","MC2")['data'];
      @endphp],
        label: "Percentage (%)  of MC2 (max 45km/h) registered to total (MC1+MC2)",
        borderColor: "#3e95cd",
        fill: false
      }
    ]
  },
  options: {
    title: {
      display: true,
    //  text: 'Snorfiets(max 25km/h) per one Bromfiet (max 45km/h) throughout the year'
    }
  }
});

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
        @php
              echo App\StatCountr::registrnippo("statbe","2020")['label'];
            @endphp 
      
      ],
      datasets: [
        {
          data: [@php
              echo App\StatCountr::registrnippo("statbe","2020")['data'];
            @endphp],
            backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions      
    })



  //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#registrationschart').get(0).getContext('2d')
    var donutData        = {
      labels: [@php
              echo App\StatCountr::registrtotal("statbe","2020")['label'];
            @endphp     
      ],
      datasets: [
        {
          data: [ @php
              echo App\StatCountr::registrtotal("statbe","2020")['data'];
            @endphp],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#fc9954','#fd5954','#f5b854','#fd9959','#fd9954',],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions      
    })





</script>


@stop











