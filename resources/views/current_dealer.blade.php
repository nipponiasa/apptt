
@extends('adminlte::page')
@section('title', 'Apps - Trade And Traffic')
@section('content_header')
<a href="{{ URL::previous() }}">Go Back</a>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>






{{-- Orismos pinaka invoices --}}


@php
//var_dump($consignment_list);
$heads_invoices = [
    'INV',
    'Ammount',
    'Date',
];
$config = [
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, ['orderable' => false]],
];
@endphp

{{-- Orismos pinaka invoices --}}

{{-- Orismos pinaka 2 --}}


@php
//var_dump($sales_list);
$heads = [
    'Model',
    'SO',
    'Date',
];

@endphp

{{-- Orismos pinaka 2 --}}


<h1>Dealer {{ $dealer_data[0]['display_name'] }}</h1>
@stop
@section('plugins.Datatables', true)
@section('plugins.Chartjs', true)
@section('plugins.DateRangePicker', true)

@section('content')
               

@include('current_dealer.date_picker_input')


<div class="row">
<div class="col-md-3 mb-5">
<x-adminlte-callout theme="info" title="Total Invoiced VAT excl.(INV)">
@php echo number_format($total_inv,2); @endphp   €
    </x-adminlte-callout>
    </div>
    <div class="col-md-3 mb-5">
    <x-adminlte-callout theme="info" title="Total Returns VAT excl. (RINV)">
@php echo number_format($total_rinv,2); @endphp   €
    </x-adminlte-callout>   
    </div>
    <div class="col-md-3 mb-5">
    <x-adminlte-callout theme="info" title="Total Bills VAT excl. (BIL)">
@php echo number_format($total_bill,2); @endphp   €
    </x-adminlte-callout>  
</div>



@if ($totalvaluesnl!=0)
 
<div class="col-md-3 mb-5">
    <x-adminlte-alert theme="primary" title="Old customer">
    This customer has been invoiced in Snelstart with a total of <a href="{{url("/snelstart_invoices?id=$currentdealerid")}}"><b>@php echo number_format($totalvaluesnl,2); @endphp  €</b> </a> for the period from 1/1/2019 to 1/7/2020.
</x-adminlte-alert>

    </div>
    @endif

</div>

<div class="row">
            @include('current_dealer.consign_array')
            <div class="col-md-1 mb-5">     </div>
            <div class="col-md-5 mb-5">
                    <h1>MOTO SALES (units)</h1>
                    <canvas id="motosaleschart" width="400" height="400"></canvas>
            </div>
 </div>
  




  
  <div class="row">
  @include('current_dealer.backorders_array')
        <div class="col-md-6 mb-5">
            <h1>SALES MOTORCYCLES</h1>
            <x-adminlte-datatable id="table_moto_sold" :heads="$heads">
                    @foreach($sales_list as $moto_sold)
                    @php  $date = date_create($moto_sold['display_name']);  @endphp
                        <tr><td>{!! $moto_sold['product_tmpl_id'][1] !!}</td><td>{!! $moto_sold['name'] !!}</td><td>@php echo date_format($date, 'Y-m-d');  @endphp</td></tr>
                    @endforeach
                    </x-adminlte-datatable>
            </div>

            </div>


        
                                    



              


<div class="row">
        <div class="col-md-6 mb-5">
       
        <h1>INVOICES-BILLS-RETURNS</h1>
            <x-adminlte-datatable id="table_invoices" :heads="$heads_invoices">
                @foreach($invoices_list as $invoice)
                @php  $date = date_create($invoice['invoice_date']);  @endphp
                     <tr><td>{!! $invoice['name'] !!}</td><td>{!! $invoice['amount_untaxed_signed'] !!}</td><td>@php echo date_format($date, 'Y-m-d');  @endphp</td></tr>
                @endforeach
            </x-adminlte-datatable>
        </div>






        <div class="col-md-6 mb-5">
       
        <div style="width:100%;">
        <canvas id="canvas"></canvas>
            </div>
        </div>




  </div>









<script>
    var timeFormat = 'YYYY-MM-DD';

    var config = {
        type: 'line',
        data:    {
            datasets: [
                {
                    label: "Total TandT",
                    data: [

                @foreach($invoices_list as $invoice)
                        {x:"{!! $invoice['invoice_date'] !!}" , y:{!! $invoice['amount_untaxed_signed'] !!}  }, 
                @endforeach


              



],
                    fill: false,
                    borderColor: 'red'
                },
                {
                    label: "Dealer",
                    data:  [
                        
          @foreach($invoices_list as $invoice)
                        {x:"{!! $invoice['invoice_date'] !!}" , y:{!! $invoice['amount_untaxed_signed'] !!}  }, 
         @endforeach
                ],
                    fill:  false,
                    borderColor: 'blue'
                }
            ]
        },
        options: {
            responsive: true,
            title:      {
                display: true,
                text:    "Invoices timeline"
            },
            scales:     {
                xAxes: [{
                    type:       "time",
                    time:       {
                        format: timeFormat,
                        tooltipFormat: 'll'
                    },
                    scaleLabel: {
                        display:     true,
                        labelString: 'Date'
                    }
                }],
                yAxes: [{
                    scaleLabel: {
                        display:     true,
                        labelString: 'value'
                    }
                }]
            }
        }
    };

    window.onload = function () {
        var ctx       = document.getElementById("canvas").getContext("2d");
        window.myLine = new Chart(ctx, config);
    };

</script>




















@stop

@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@stop

@section('js')
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        "pageLength": 25,
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
  
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages column1
            total = api
                .column( 1 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page column1
            pageTotal1 = api
                .column( 1, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer column1
            $( api.column( 1 ).footer() ).html(
                'Total:'+pageTotal1 +' ( '+ total +')'
            );





            // Total over all pages column2
            total2 = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );





	// Total over this page column2
            pageTotal2 = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer column2
            $( api.column( 2 ).footer() ).html(
                'Total:'+pageTotal2 +' ( '+ total2 +')'
            );





            // Total over all pages column3
            total3 = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page column3
            pageTotal3 = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer column3
            $( api.column( 3 ).footer() ).html(
                'Total:'+pageTotal3 +' ( '+ total3 +')'
            );











        }
   } );
} );


</script>
















<script>


var ctx = document.getElementById("motosaleschart");
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {







    labels: [


    
       
    @foreach($per_model_sold_qty as $model)
                        "{!! $model['name'] !!}", 
                @endforeach



            ],










    datasets: [{
      label: '# of Moto',
      data: [
          
          
          
          
        @foreach($per_model_sold_qty as $model)
                        "{!! $model['qty'] !!}", 
                @endforeach
          
          
          
          ],







          backgroundColor: [
'rgba(101, 239, 149, 0.3)',
'rgba(166, 60, 125, 0.2) ',
'rgba(159, 184, 100, 0.9) ',
'rgba(147, 244, 199, 0.8)',
'rgba(41, 209, 251, 0.5)',
'rgba(223, 31, 190, 0.5) ',
'rgba(76, 209, 57, 0.3) ',
'rgba(131, 107, 185, 0.7)',
'rgba(115, 205, 252, 0.6)',
'rgba(76, 169, 100, 1)',
'rgba(202, 14, 176, 0.2)',
'rgba(189, 52, 79, 0.5)',
'rgba(234, 13, 86, 0.7)',
'rgba(108, 64, 158, 0.1)',
'rgba(167, 7, 169, 0.4)',
'rgba(111, 248, 247, 0.2)',
'rgba(242, 152, 90, 0.2)',
'rgba(203, 158, 32, 0.8)',
'rgba(220, 6, 39, 0.3)'







      ],
      borderColor: [
'rgba(101, 239, 149, 1)',
'rgba(166, 60, 125, 1) ',
'rgba(159, 184, 100, 1) ',
'rgba(147, 244, 199, 1)',
'rgba(41, 209, 251, 1)',
'rgba(223, 31, 190, 1) ',
'rgba(76, 209, 57, 1) ',
'rgba(131, 107, 185, 1)',
'rgba(115, 205, 252, 1)',
'rgba(76, 169, 100, 1)',
'rgba(202, 14, 176, 1)',
'rgba(189, 52, 79, 1)',
'rgba(234, 13, 86, 1)',
'rgba(108, 64, 158, 1)',
'rgba(167, 7, 169, 1)',
'rgba(111, 248, 247, 1)',
'rgba(242, 152, 90, 1)',
'rgba(203, 158, 32, 1)',
'rgba(220, 6, 39, 1)'

      ],







    
      borderWidth: 1
    }]
  },
  options: {
   	//cutoutPercentage: 40,
    responsive: false,

  }
});



</script>





























@stop








