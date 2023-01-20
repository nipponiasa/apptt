@extends('adminlte::page')
@section('title', 'Apps - Trade And Traffic')
@section('content_header')
<a href="{{ URL::previous() }}">Go Back</a>
    <h1>Trade and Traffic Demands </h1>
@stop


@section('plugins.Datatables', true)
@section('content')
                    <p>These are confirmed orders that either we have chosen wrong warehouse either there is not stock at all.</p>
                    <p>  <a href="/who_demands_what?serial=false">Spare Parts only </a> or  <a href="/who_demands_what?serial=true">Scooters only </a></p>
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>@if($withserial==='true')Model (with variants)@else Spare Parts @endif   </th>
                                <th>Qty</th>
                                <th>Dealer Demanding</th>
                                <th>Sale Order</th>
                                <th>Confirmation Date</th>
                                <th>Vendor</th>
                        </tr>
                        </thead>
                    <tbody>
                {{-------------------------------------------------------------------------------------------------------}}
                @php
//var_dump($uii);

$total=0;
                        foreach($uii as $result)
                        {
                            if(!is_bool($result['partner_id'])){
                                $total+=$result['product_uom_qty']; 
                        echo '<tr> <td>'.$result['product_id'][1].'</td><td>'.$result['product_uom_qty'].'</td><td>'.$result['partner_id'][1].'</td><td>'.$result['origin'].'</td><td>'.date('Y-m-d', strtotime($result['create_date'])).'</td><td>'.$result['x_factory'].'</td></tr>';
                            }
                        }
                @endphp

                {{-------------------------------------------------------------------------------------------------------}}
                    
                        </tbody>
                        <tfoot>
                            <tr>
                            <th style="text-align:right">Total:</th>
                                <th>@php echo  $total; @endphp</th>
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

{{---------
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
 
            // Update footer
            $( api.column( 1 ).footer() ).html(
                'Total:'+pageTotal +' ( '+ total +')'
            );
        }
    } );
} );


</script>-----}}





<script>



$(document).ready(function() {

    $('#example').dataTable( {
        "lengthMenu": [ [10, 25,100, 500, -1], [10, 25,100, 500, "All"] ]
} );







} );


</script>













@stop











