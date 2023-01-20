@extends('adminlte::page')
@section('title', 'Revenew Targets vs Realisation 2022')
@section('plugins.Datatables', true)
@section('content_header')
        <a href="{{ URL::previous() }}">Go Back</a>
        <h1>Trade and Traffic Plus - Revenew Targets vs Realisation @php echo $selected_year; @endphp </h1>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>





        <style>
.table thead th {
    text-align: right;
}
</style>
@stop



@php

$heads_motos = [ 'Month','Invoiced Untaxed €', 'Target €','Percentage(%)'];
$config = [

        'order' => [[0, 'asc']],
        'columns' => [['orderable' => false], null, null, null ],
        'paging'=>   false,
        'searching'=>   false,
        ];


@endphp




@section('content')
{{-- Example with empty option (for Select) --}}









<form method="get" action="/revenue_target">
        @csrf
<div class="row">

       
<div class="col-md-3">   


<x-adminlte-select name="year">
    <x-adminlte-options :options="[ '2021'=>2021, '2022'=>2022, '2023'=>2023, '2024'=>2024]"  empty-option="Select year..."/>
    <option selected>{{$selected_year}}</option>
</x-adminlte-select>


</div>



<div class="col-md-3">   
<button type="submit" class="btn btn-primary">Update</button>
</div>

</div>

</form>








<!-- arxi -->
<div class="row">
    <div class="col-md-6">
      <!-- Line chart -->
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">
            <i class="far fa-chart-bar"></i>
           Table for @php echo $selected_year; @endphp
          </h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
         @include('layouts.revenue_table')
        

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
             Graph for @php echo $selected_year; @endphp
            </h3>
  
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <canvas id="reveneu_canvas" style="min-height: 315px; height: 315px; max-height: 315px; max-width: 100%;" ></canvas>
          </div>
          <!-- /.card-body-->
        </div>
        <!-- /.card -->
  
  






 <!-- Line chart cumulative -->
 <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="far fa-chart-bar"></i>
            Cumulative Graph for @php echo $selected_year; @endphp
            </h3>
  
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <canvas id="reveneu_cumulative_canvas" style="min-height: 315px; height: 315px; max-height: 315px; max-width: 100%;" ></canvas>
          </div>
          <!-- /.card-body-->
        </div>
        <!-- /.card -->


      </div>
      <!-- /.col -->

    <!-- /.col -->
  </div>

 <!-- telos -->



@stop





@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')


<script>

// totalpermonthtarget pinakas dedomenon
var timesstoxos=[
@php for($i = 1; $i <=12; $i++)
      echo $totalpermonthtarget[$i].","; 
@endphp
]

// revenue pinakas dedomenon

var times=[
@php for($i = 1; $i <=12; $i++)
      echo $revenue[$i].","; 
@endphp
]







var timesstoxos_cumul=[
@php $totalpermonthtarget_cumulative=0;
for($i = 1; $i <=12; $i++){
      $totalpermonthtarget_cumulative+=$totalpermonthtarget[$i];
      echo $totalpermonthtarget_cumulative.",";
    }
      
@endphp
]

// revenue cumulative pinakas dedomenon

var times_cumul=[
@php $revenue_cumulative=0;
for($i = 1; $i <=12; $i++)
{
$revenue_cumulative+=$revenue[$i];
echo $revenue_cumulative.","; 
}
@endphp
]









var mines=["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]
var minesperiodos = mines.slice(0, 11 + 1);

//console.log(minesperiodos);

new Chart(document.getElementById("reveneu_canvas"), {
  type: 'line',
  data: {
    labels: minesperiodos,
    datasets: [{ 
        data: timesstoxos,
        label: "Target",
        borderColor: "#3e95cd",
        fill: false
      }, { 
        data: times,
        label: "Realization",
        borderColor: "#8e5ea2",
        fill: false
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'Sales Targets vs Realization'
    }
  }
});









new Chart(document.getElementById("reveneu_cumulative_canvas"), {
  type: 'line',
  data: {
    labels: minesperiodos,
    datasets: [{ 
        data: timesstoxos_cumul,
        label: "Target Cumulative",
        borderColor: "#3e95cd",
        fill: false
      }, { 
        data: times_cumul,
        label: "Realization Cumulative",
        borderColor: "#8e5ea2",
        fill: false
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'Sales Cumulative Target vs Realization'
    }
  }
});


















</script>









@stop