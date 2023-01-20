
@extends('adminlte::page')
@section('title', 'Apps - Trade And Traffic')
@section('content_header')
<a href="{{ URL::previous() }}">Go Back</a>
<h1></h1>
@stop
@section('plugins.Datatables', true)
@section('content')
                <h1>Aged Motorcycles in consignment</h1>
                    <table id="example" class="display stripe" style="width:100%">
                        <thead>
                            <tr>
                                <th>Model</th>
                                <th>1-30</th>
                                <th>31-60</th>
                                <th>61-90</th>
                                <th>91-120</th>
                                <th>Older</th>
                                <th>Total</th>
                               
                        </tr>
                        </thead>
                        <tbody>
                    
                {{-------------------------------------------------------------------------------------------------------}}
                @php

                $size = count($modelcount);
                for($i = 0; $i < $size; $i++)
                        {
                             //echo '<tr> <td>'.$modelcount[$i]["name"].'</td><td><a href=aged_consign_models_cust?modelid='.$modelcount[$i]["referenceid"].'&periodclass=1>'.$modelcount[$i]["d1_30"].'</a></td><td><a href=aged_consign_models_cust?modelid='.$modelcount[$i]["referenceid"].'&periodclass=31>'.$modelcount[$i]["d31_60"].'</td><td><a href=aged_consign_models_cust?modelid='.$modelcount[$i]["referenceid"].'&periodclass=61>'.$modelcount[$i]["d61_90"].'</td><td><a href=aged_consign_models_cust?modelid='.$modelcount[$i]["referenceid"].'&periodclass=91>'.$modelcount[$i]["d91_120"].'</td><td><a href=aged_consign_models_cust?modelid='.$modelcount[$i]["referenceid"].'&periodclass=121>'.$modelcount[$i]["older"].'</td><td><a href=aged_consign_models_cust?modelid='.$modelcount[$i]["referenceid"].'&periodclass=0>'.$modelcount[$i]["total"].'</td></tr>';
   echo '<tr> <td>'.$modelcount[$i]["name"].'</td><td><a href=aged_consign_models_cust?modelid='.$modelcount[$i]["referenceid"].'&periodclass=1>'.$modelcount[$i]["d1_30"].'</a></td><td><a href=aged_consign_models_cust?modelid='.$modelcount[$i]["referenceid"].'&periodclass=31>'.$modelcount[$i]["d31_60"].'</a></td><td><a href=aged_consign_models_cust?modelid='.$modelcount[$i]["referenceid"].'&periodclass=61>'.$modelcount[$i]["d61_90"].'</a></td><td><a href=aged_consign_models_cust?modelid='.$modelcount[$i]["referenceid"].'&periodclass=91>'.$modelcount[$i]["d91_120"].'</a></td><td><a href=aged_consign_models_cust?modelid='.$modelcount[$i]["referenceid"].'&periodclass=121>'.$modelcount[$i]["older"].'</a></td><td><a href=aged_consign_models_cust?modelid='.$modelcount[$i]["referenceid"].'&periodclass=0>'.$modelcount[$i]["total"].'</a></td></tr>';
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


            // Total over all pages column4
            total4 = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page column4
            pageTotal4 = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer column4
            $( api.column( 4 ).footer() ).html(
                'Total:'+pageTotal4 +' ( '+ total4 +')'
            );




            // Total over all pages column5
            total5 = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page column5
            pageTotal5 = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer column5
            $( api.column( 5 ).footer() ).html(
                'Total:'+pageTotal5 +' ( '+ total5 +')'
            );





            // Total over all pages column6
            total6 = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page column6
            pageTotal6 = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer column6
            $( api.column( 6 ).footer() ).html(
                'Total:'+pageTotal6 +' ( '+ total6 +')'
            );















        }
   } );
} );


</script>
@stop








