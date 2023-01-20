@extends('adminlte::page')
@section('title', 'Current  Stock Report')
@section('plugins.Datatables', true)
@section('content_header')
        <a href="{{ URL::previous() }}">Go Back</a>
        <h1>Trade and Traffic Plus - Current Non Deliverable Stock </h1>


<style>
.text-overflow-center {
    margin-left: -100%;
    margin-right: -100%;
    text-align: center;
}

.text-overflow-right {
    margin-left: -100%;
    margin-right: -100%;
    text-align: right;
}
</style>

@stop



@php
//ini_set("memory_limit", "2048M");
$heads_stock = [ 'Model','Jan', 'Feb','Mar','Apr','May', 'Jun','Jul','Aug','Sep', 'Oct','Nov','Dec'];
$config = [
  //'columns' => [['className' => 'text-left','width'=> '20%' ], ['className' => 'text-overflow-center','width'=> '5%' ], ['className' => 'text-overflow-center','width'=> '5%' ] ,['className' => 'text-overflow-right','width'=> '20%' ],['className' => 'text-overflow-right','width'=> '20%' ]],
        'order' => [[0, 'asc']],
       'columns' => [['orderable' => false], null, null, null, null, null , null, null, null, null, null, null , null ],
        'paging'=>   false,
        'searching'=>   true,
        ];
       
@endphp




@section('content')
{{-- Example with empty option (for Select) --}}



<form method="post" action="/bi/sales_targets_input">
        @csrf
<div class="row">

    


<div class="col-md-3">   
<button type="submit" class="btn btn-primary">Update</button>
</div>

</div>


<br>




<!-- arxi -->
<div class="row">
    <div class="col-md-8">
      <!-- Line chart -->
      <div class="card card-primary card-outline">
                          <div class="card-header">

                                                    <h3 class="card-title">
                                                      <i class="far fa-chart-bar"></i>
                                                    Forecasted sales for 2023
                                                    </h3>

                                                    <div class="card-tools">
                                                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                      </button>
                                                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                                      </button>
                                                    </div>
                        
                        
                          </div>





        <div class="card-body">
         @include('layouts.sales_target_input_table')
        

        </div>
        <!-- /.card-body-->
      </div>
      <!-- /.card -->


    </div>
    <!-- /.col -->

 
   









    <!-- /.col -->
  </div>

 <!-- telos -->

 </form>

@stop





@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')


<script>


</script>









@stop