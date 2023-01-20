@extends('adminlte::page')
@section('title', 'Apps - Trade And Traffic')
@section('content_header')
<a href="{{ URL::previous() }}">Go Back</a>
        <h1>Trade and Traffic Plus - Dealers (sometimes Vendors also)</h1>
        <p>Click on the dealers name to find out more.</p>
@stop
@section('plugins.Datatables', true)
@section('content')
    <table id="example" class="display stripe" style="width:100%">
        <thead>
            <tr>
               <th>Dealer</th>
               <th>Total Due (€)</th>
               <th>Total Invoiced (Odoo) (€)</th>
               <th>Total Invoiced (1/1/19 to 1/7/2020) (€)</th>
               <th>Sale Orders</th>
               <th>Purchase Orders</th>
           </tr>
        </thead>
	 <tbody>
	
{{-------------------------------------------------------------------------------------------------------}}

@php
//var_dump($uii);
foreach($uii as $result) {
  //var_dump($totalvaluesnl);

    $snl_total=array_key_exists($result['id'], $totalvaluesnl) ? $totalvaluesnl[intval($result['id'])] : 0;

          echo '<tr> <td><a href=current_dealer?id='.$result['id']. '>'.$result['display_name'].'</a></td><td>'.number_format($result['total_due'], 2, ".", ",").'</td><td>'.number_format($result['total_invoiced'], 2, ".", ",").'</td><td>'.number_format($snl_total, 2, ".", ",").'</td><td>'.$result['sale_order_count'].'</td><td>'.$result['purchase_order_count'].'</td> </tr>'."\n";
          
}
@endphp

{{-------------------------------------------------------------------------------------------------------}}


        </tbody>
        <tfoot>
            <tr>
             <th ></th>
             <th ></th>
             <th ></th>
             <th ></th>
             <th ></th>
             <th ></th>
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



    $('#example').DataTable( {
        "pageLength": 30,
        "columnDefs": [
      { className: "dt-right", "targets": [1,2,3,4] },
      { className: "dt-nowrap", "targets": [1] }
    ],
            "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 1 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 1, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
          
        }
    } 
    
    
    
    );
   
} );


</script>

@stop








