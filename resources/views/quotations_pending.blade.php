@extends('adminlte::page')
@section('title', 'Apps - Trade And Traffic')
@section('content_header')
<a href="{{ URL::previous() }}">Go Back</a>
<h1>Trade and Traffic Plus - Quotations</h1>
<p>Following is a table with all the quotations. Each needs to be checked if the products exist, or need to be reconfigured.</br> If they exist please confirm the order.If needs to be reconfigured please correct the <b>quotation</b>.</br> If does not exist at all please confirm the order so we know there is demand. </p>
@stop
@section('plugins.Datatables', true)
@section('content')
                    <table id="example" class="display stripe" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SO number</th>
                                    <th>Dealer</th>
                                    <th>Date created</th>
                            </tr>
                            </thead>
                        <tbody>
                        
                    {{-------------------------------------------------------------------------------------------------------}}
                    @php
                            foreach($uii as $result) {
                                    echo '<tr> <td>'.$result['name'].'</td><td>'.$result['partner_id'][1].'</td><td>'.$result['create_date'].'</td> </tr>'."\n";
                            }
                    @endphp

                    {{-------------------------------------------------------------------------------------------------------}}


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th ></th>
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
    } );
} );


</script>

@stop








