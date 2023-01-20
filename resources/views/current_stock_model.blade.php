
@extends('adminlte::page')
@section('title', 'Apps - Trade And Traffic')
@section('plugins.Datatables', true)
@section('content_header')
<a href="{{ URL::previous() }}">Go Back</a>
<h1></h1>

<style>

.text-overflow-right {
    margin-left: -100%;
    margin-right: -100%;
    text-align: right;
}
</style>
@stop






@section('content')

@php

$heads_stock = [ 'Model','VIN', 'Location', 'PO' ,'Cost (€)'];
$config = [
  'columns' => [
    ['className' => 'text-left','width'=> '10%' ],
    ['className' => 'text-overflow-center','width'=> '25%' ],
    ['className' => 'text-overflow-center','width'=> '25%' ],
    ['className' => 'text-overflow-center','width'=> '25%' ],
    ['className' => 'text-overflow-right','width'=> '15%' ]
   ],
'order' => [[0, 'asc']],
'paging'=>   false,
'searching'=>   true,
        ];
       
@endphp




<!-- arxi -->
<div class="row">
    <div class="col-md-8">
      <!-- Line chart -->
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">
            <i class="far fa-chart-bar"></i>
          Model Availability
          </h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">








        <x-adminlte-datatable id="table_stock" :heads="$heads_stock" :config="$config"   striped hoverable with-buttons>
                                           
                 @php
                                                       
                                    $total_cost=0;
                                    $size = count($model_list);
                for($i = 0; $i < $size; $i++)
                        {
                         
                            $vin=is_bool($model_list[$i]["lot_id"])?'N/A':$model_list[$i]["lot_id"][1];   // gia kapoio logo epistrefei kapoia fora boolean otan den exei oristei sosta
                            $cost_per_cat_one=array_key_exists($vin,$vin_cost)?$vin_cost[$vin]['cost']:0;
                            $po_per_cat_one=array_key_exists($vin,$vin_cost)?$vin_cost[$vin]['po']:0;
                            
                            
                            if(!is_bool($model_list[$i]["lot_id"])){ echo '<tr> 
                              <td>'.$model_list[$i]["display_name"].'</td>
                              <td>'. $vin.'</td>
                              <td>'.$model_list[$i]["location_id"][1].'</td>
                              <td>'.$po_per_cat_one.'</td>
                              <td>'.number_format($cost_per_cat_one,2).' €</tr>';

                            $total_cost+=$cost_per_cat_one;
                           
                          }

                        }
                        echo '<tfoot> <td>Total</td><td></td><td></td><td></td><td>'.number_format($total_cost,2).' €</td></tfoot>';
                                           
                   @endphp
                                           
                                           
                                           
                                           
                                                           </x-adminlte-datatable>
        














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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@stop








