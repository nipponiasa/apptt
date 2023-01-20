@extends('adminlte::page')
@section('title', 'Apps - Trade And Traffic')
@section('content_header')
<a href="{{ URL::previous() }}">Go Back</a>
    <h1></h1>
@stop

@section('plugins.Datatables', true)
@section('content')

                <table id="example" class="display stripe" style="width:100%">
                    <thead>
                        <tr>
                        <th>Model</th>
                        <th>Units Sold</th>
                    </tr>
                    </thead>
                <tbody>


            {{-------------------------------------------------------------------------------------------------------}}
            @php

            $size = count($modelcount);
            for($i = 0; $i < $size; $i++)
            {
                    echo '<tr> <td>'.$modelcount[$i]["name"].'</td><td>'.$modelcount[$i]["sold"].'</td> </tr>';

            }

            @endphp

            {{-------------------------------------------------------------------------------------------------------}}

                    </tbody>
                    <tfoot>
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



        }
    } );
} );


</script>
@stop








