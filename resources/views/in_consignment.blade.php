
{{-- Form::text('foo') --}}

@extends('adminlte::page')

@section('title', 'Apps - Trade And Traffic')

@section('content_header')
<a href="{{ URL::previous() }}">Go Back</a>
    <h1></h1>
@stop

@php
use Ripcord\Ripcord;
use PhpXmlRpc\Client;
//connection strings
$url = "https://alpiek-oisterwijk-traden-and-traffic-modules.odoo.com"; 
$db = "alpiek-oisterwijk-traden-and-traffic-modules";
$db = "alpiek-oisterwijk-traden-and-traffic-modules-13-0-874478";
$username = "vgorgolis@nipponia.com";
$password = "1234$#@!";
//connection strings
$common = Ripcord::client("$url/xmlrpc/2/common");
$uid = $common->authenticate($db, $username, $password, array());
$models = Ripcord::client("$url/xmlrpc/2/object");
$uii=$models->execute_kw($db, $uid, $password, 'stock.quant', 'search_read', array(array(
array(
'quantity', '=', 1
)
)));
@endphp



@section('plugins.Datatables', true)
@section('content')
    <p>Welcome to Trade and Traffic Apps.</p>
 
    <table id="tableopen" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Model</th>
                <th>Availability in WH</th>
            </tr>
        </thead>
        <tbody>
            @php


$modelcount= array();
foreach($uii as $result)
 {
	$modelochk=$result['product_tmpl_id'][1];
        if($result['location_id'][1]=="WH/Stock" and !is_null($result['lot_id'][1])):
		if (array_key_exists($modelochk,$modelcount) ):
              		  $modelcount[$modelochk]=1+$modelcount[$modelochk];
		else:
			  $modelcount[$result['product_tmpl_id'][1]]=1;
		endif;
	endif;
}




//echo 'hhj';
foreach(array_keys($modelcount) as $modelo) {

              echo '<tr> <td>'.$modelo.'<td>'.$modelcount[$modelo].'</td> </tr>';
           

}

            
            @endphp
        </tbody>
        <tfoot>
            <tr>
                <th>Model</th>
                <th>Availability in WH</th>
            </tr>
        </tfoot>
    </table>
 


@stop



@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>$(document).ready(function() {
    $('#tableopen').DataTable({
        "iDisplayLength": 20
           });
    
} );</script>
    <script> console.log('Hi!'); </script>
@stop





