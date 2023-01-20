
@extends('adminlte::page')
@section('title', 'Apps - Trade And Traffic')
@section('content_header')
<a href="{{ URL::previous() }}">Go Back</a>
<h1></h1>
@stop
@section('plugins.Datatables', true)
@section('content')
                <h1>Snelstart Old invoices</h1>
                    <table id="example" class="display stripe" style="width:100%">
                        <thead>
                            <tr>
                            <th>Invoice Nbr</th>
                                <th>Date</th>

                                <th>Value</th>

                               
                        </tr>
                        </thead>
                        <tbody>
                    
                {{-------------------------------------------------------------------------------------------------------}}
                @php
               
                
              
               $size = count($old_inv);
                for($i = 0; $i < $size; $i++)
                        {
                           
                           
                            echo '<tr> <td>'.$old_inv[$i]->invoicenbr.'</td><td>'.$old_inv[$i]->invoicedate.'</td><td>'.$old_inv[$i]->invoicevalue.'</td></tr>'; 
                        }

     
                

                @endphp
                {{-------------------------------------------------------------------------------------------------------}}
                    </tbody>
                        <tfoot>
                            <tr>
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
@stop








