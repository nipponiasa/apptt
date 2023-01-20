@extends('adminlte::page')
@section('title', 'Spare Parts Availability per Model Catalog')
@section('plugins.Datatables', true)
@section('content_header')
        <a href="{{ URL::previous() }}">Go Back</a>
        <h1>Trade and Traffic Plus - Spare Parts Availability for Model @isset($selected_model) {{$selected_model}} @endisset  </h1>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>


@stop


@php

//$heads_sp = [ 'Product', 'Avail','Forecasted'];

$heads_sp = [ 
  ['label' => 'Product nbr.'],
  ['label' => 'Product Name'],
  ['label' => 'Avail'],
  ['label' => 'Forecasted'],
  ['label' => 'Invoiced(YTD)'],
  ];





$config = [

        'order' => [[0, 'asc']],
        'columns' => [
          ['orderable' => true,'className' => 'text-left'],
          ['orderable' => true,'className' => 'text-left'],
          ['orderable' => true,'className' => 'text-left'],
          ['orderable' => true,'className' => 'text-right'],
          ['orderable' => true,'className' => 'text-right'],
            ],
        'paging'=>   false,
        'searching'=>   false,
        ];


@endphp




@section('content')
{{-- Example with empty option (for Select) --}}


<form method="post" action="/avail_per_catalog">
        @csrf
<div class="row">
      
<div class="col-md-3">   

<x-adminlte-select name="model">
    <x-adminlte-options :options="$model_list"  empty-option="Select Model..."/>
    @isset($selected_model) <option selected>{{$selected_model}}</option> @endisset
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
           Table for @isset($selected_model) {{$selected_model}} @endisset
          </h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
         @include('layouts.sp_per_catalog_table')
        

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