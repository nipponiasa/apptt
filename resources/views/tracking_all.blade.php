@extends('adminlte::page')
@section('title', 'Apps - Trade And Traffic')
@section('content_header')
<a href="{{ URL::previous() }}">Go Back</a>
        <h1>Trade and Traffic Plus - Mol Cargo Delivery Tracking</h1>
        <p>Refresh if you want to get latest tracking information (this might take a while).</p>
        <a class="btn btn-primary" id="refresh" href="/update_moltranfers" role="button">Refresh</a>
        

@stop
@section('plugins.Datatables', true)
@section('content')
    <table id="example" class="display stripe" style="width:100%">
        <thead>
            <tr>
            <th>Name</th>
            <th>Transfer nbr</th>
            <th>Date</th>
               <th>Model</th>
               <th>Destination</th>
               <th>Track Type</th>
               <th>VIN</th>
               <th>Days to Del.(as mentioned in Del.)</th>
               <th>Action</th>
           </tr>
        </thead>
	 <tbody>
	
{{-------------------------------------------------------------------------------------------------------}}

@php
//var_dump($uii);
foreach($listalltranfers  as $result) {
  //var_dump($totalvaluesnl);
  $status=$result->Status;
  if($status=="Delivered"){
    $from =new DateTime($result->dateorder_as_mentioned_in_delivery);
    $to =new DateTime($result->date_mentioned_in_data);
    $interval = $from->diff($to);
    echo '<tr> <td>'.$result->Tranfernbr.'</td><td>'.$result->Tranfernbr_cleaned.'</td><td>'.$result->date_mentioned_in_data. '</td><td>'.$result->Model.'</td><td>'.$result->DestinationName.'</td><td><span class="badge badge-primary">3. '.$status.'</span></td><td>'.$result->VIN.'</td><td>'.$interval->format('%R%a days').'</td><td><a href=/transfer_edit_form?transferid='.$result->id.'><button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit"><i class="fa fa-lg fa-fw fa-pen"></i></button></a></td></tr>';
                        }
    elseif  ($status=="Shipping")
  {
    echo '<tr> <td>'.$result->Tranfernbr.'</td><td>'.$result->Tranfernbr_cleaned.'</td><td>'.$result->date_mentioned_in_data. '</td><td>'.$result->Model.'</td><td>'.$result->DestinationName.'</td><td><span class="badge badge-warning">2.'.$status. '</span></td><td></td><td></td><td><a href=/transfer_edit_form?transferid='.$result->id.'><button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit"><i class="fa fa-lg fa-fw fa-pen"></i></button></a></td></tr>';
                        }
                        elseif  ($status=="OrderReceived")
  {
    echo '<tr> <td>'.$result->Tranfernbr.'</td><td>'.$result->Tranfernbr_cleaned.'</td><td>'.$result->date_mentioned_in_data. '</td><td>'.$result->Model.'</td><td>'.$result->DestinationName.'</td><td><span class="badge badge-info">1. '.$status.'</span></td><td></td><td></td><td><a href=/transfer_edit_form?transferid='.$result->id.'><button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit"><i class="fa fa-lg fa-fw fa-pen"></i></button></a></td></tr>';
                        }

                        elseif  ($status=="Invoiced")
  {
    echo '<tr> <td>'.$result->Tranfernbr.'</td><td>'.$result->Tranfernbr_cleaned.'</td><td>'.$result->date_mentioned_in_data. '</td><td>'.$result->Model.'</td><td>'.$result->DestinationName.'</td><td><span class="badge badge-inv-val">'.$status.'</span></td><td>'.$result->VIN.'</td><td></td><td></td></tr>';
                        }
                        elseif  ($status=="Validated")
  {
    echo '<tr> <td>'.$result->Tranfernbr.'</td><td>'.$result->Tranfernbr_cleaned.'</td><td>'.$result->date_mentioned_in_data. '</td><td>'.$result->Model.'</td><td>'.$result->DestinationName.'</td><td><span class="badge badge-inv-val">'.$status.'</span></td><td>'.$result->VIN.'</td><td></td><td></td></tr>';
                        }
                        else
                        {
                          echo '<tr> <td>'.$result->Tranfernbr.'</td><td>'.$result->Tranfernbr_cleaned.'</td><td>'.$result->date_mentioned_in_data. '</td><td>'.$result->Model.'</td><td>'.$result->DestinationName.'</td><td><span class="badge badge-secondary">'.$status.'</span></td><td></td><td></td><td><a href=/transfer_edit_form?transferid='.$result->id.'><button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit"><i class="fa fa-lg fa-fw fa-pen"></i></button></a></td></tr>';
                        }



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
  <style>
  .badge-inv-val {
    color: #fff;
    background-color: #875A7B;
}
</style>
@stop

@section('js')
<script>
$(document).ready(function() {



    $('#example').DataTable( {
        "pageLength": 30
       
   
   
} );
} );

</script>



<script>
$('#refresh').click(function(){
  this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';

});

</script>




@stop








