@extends('adminlte::page')
@section('title', 'Units Target vs Realisation')
@section('plugins.Datatables', true)
@section('content_header')
        <a href="{{ URL::previous() }}">Go Back</a>
        <h1>Trade and Traffic Plus - Units Target vs Realisation @php echo $selected_month_name." ".$selected_year; @endphp </h1>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>






@stop

@php

$heads_motos = [ 'Model','Ordered',['label' => 'Delivered', 'no-export' => true],'Invoiced', 'Target',  ['label' => 'Discount', 'no-export' => true]];
$config = [
        'order' => [[1, 'asc']],
        'columns' => [['orderable' => false,'visible'=> true, 'className' => 'text-center','width'=> '5%' ], ['className' => 'text-center wrap','width'=> '7%'], ['className' => 'text-center'], ['className' => 'text-center'], ['className' => 'text-center'] , ['className' => 'text-center']],
        'paging'=>   false,
        'searching'=>   false,
        'info'=>   false,
        'scrollX'=> 400,
        ];
$selected_year_option=[$selected_year];
$selected_month_option=[$selected_month];
@endphp







@section('content')
{{-- Example with empty option (for Select) --}}





<form method="get" action="/units_target">

              <div class="row">
                          <div class="col-md-3">   
                                    <x-adminlte-select name="year">
                                              <x-adminlte-options :options="[ '2021'=>2021, '2022'=>2022, '2023'=>2023, '2024'=>2024]" :selected="$selected_year_option" />
                                    </x-adminlte-select>
                          </div>
                                  <div class="col-md-3">   
                                  <x-adminlte-select name="month">
                                          <x-adminlte-options :options="[ 1=>'January', 2=>'February', 3=>'March', 4=>'April',5=>'May', 6=>'June', 7=>'July', 8=>'August',9=>'September', 10=>'October', 11=>'November', 12=>'December', 0=>'All']"  :selected="$selected_month_option"/>
                                    </x-adminlte-select>
                                  </div>
                          <div class="col-md-3">   
                                    <button type="submit" class="btn btn-primary">Update</button>
                          </div>
              </div>
</form>




@php

//var_dump($uii);

@endphp

<!-- arxi -->
<div class="row">
    <div class="col-md-9">
      <!-- pinakas -->
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">
            <i class="far fa-chart-bar"></i>
           Sales (units) per model for @php echo $selected_month_name." ".$selected_year; @endphp
          </h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>
          </div>


        </div>



        <div class="card-body">


         @include('layouts.units_target_sales_table')
        

        </div>
        <!-- /.card-body-->
      </div>
      <!-- /.card -->


    </div>
    <!-- /.col -->

 
  






    

    <div class="col-md-3">
      <!-- shmeioseis -->
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">
                    Notes on Report
          </h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>
          </div>


        </div>



        <div class="card-body">


        <x-adminlte-callout>The sale order names, that appear on hover can be less than the ordered quantity, because more than one can be ordered per sale order.</x-adminlte-callout>
        <x-adminlte-callout><b>Ordered</b>: Quantity of units with confirmed SO during the selected month.</x-adminlte-callout>
        <x-adminlte-callout><b>Invoiced</b>: Quantity of units invoiced of those <b>Ordered</b> (regardless of the invoice date).</x-adminlte-callout>
        <x-adminlte-callout><b>Discount</b>: Invoiced price from Wholesale price</x-adminlte-callout>
      


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











@stop