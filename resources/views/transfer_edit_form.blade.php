@extends('adminlte::page')

@section('title', 'Apps - Trade And Traffic')
@section('plugins.Datatables', true)
@section('content_header')
    <a href="{{ URL::previous() }}">Go Back</a>
    <h1  class="display-4">Edit transfer {{ $transfer_current->Tranfernbr }} </h1>
   
    
@stop

@section('content')


<div class="container" style="margin-top:40px;">
  <!-- Content here -->



<form action="{{url('update_transfer_details')}}" method="post" >
<input type="hidden" class="form-control" name="modified_by" id="modified_by" value={{ Auth::user()->id }}  >
<input type="hidden" class="form-control" name="transfer_id" id="transfer_id" value={{ $transfer_current->id }}  >

<input type="hidden" class="form-control" name="Tranfernbr_cleaned_before" id="Tranfernbr_cleaned_before" value="{{ $transfer_current->Tranfernbr_cleaned }}"  >
<input type="hidden" class="form-control" name="status_before" id="status_before" value="{{ $transfer_current->Status }}"  >

{{ csrf_field() }}


<div class="row">
              <div class="col-md-3 mb-5">
                <div class="form-group">
                  <label for="cleantransfernbr">Transfer nbr.</label>
                  <input type="text" class="form-control" name="cleantransfernbr" id="cleantransfernbr" value="{{ $transfer_current->Tranfernbr_cleaned }}" >
                </div>
              </div>



              <div class="col-md-3 mb-5">
                <label for="status">Status</label>
                    <select class="form-control"  name="status" id="status" >
                     <option value='OrderSent' @if($transfer_current->Status =='OrderSent') selected @endif >OrderSent</option>
                    <option value='OrderReceived' @if($transfer_current->Status =='OrderReceived') selected @endif>OrderReceived</option>
                    <option value='Shipping' @if($transfer_current->Status =='Shipping') selected @endif>Shipping</option>
                    <option value='Delivered' @if($transfer_current->Status =='Delivered') selected @endif >Delivered</option>
                    <option value='Invoiced' @if($transfer_current->Status =='Invoiced') selected @endif >Invoiced</option>
                    <option value='Validated' @if($transfer_current->Status =='Validated') selected @endif >Validated</option>
                    <option value='Other' @if($transfer_current->Status =='Other') selected @endif >Other</option>
                    </select>
                </div>

  </div>






  <div class="row">

  <div class="col-md-12 mb-5">




                <div class="form-group">
                  <label for="note">Note</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="note" id="note" value=""></textarea>
                 </div>
                </div>




  </div>


















  

  <div class="row">
        <div class="col-md-3 mb-5">
        <button type="submit" class="btn btn-primary">Update</button>
        </div>
  </div>




</form>










































<p class="text-muted">Log Notes</p>




@php

foreach($transfer_current_edits  as $result) {
  $type_of_edit="";
if($result->user_explain!="")
                      {
                      $type_of_edit='User notes';
                      }
 else
 
                      {
                        $type_of_edit='User modifications';
                        
                        }
  
 
  




                        echo

'<div class=list-group>

              <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1 badge badge-primary">' . $type_of_edit . '</h5>
                  <small>'.$result->created_at.'</small>
                </div>
                <div class="mb-3" style="padding-left:2em;">
                    <p >'.$result->user_explain.'</p>
                    <p >'.$result->system_explain.'</p>
                 </div>
                <small>'.$result->name.'</small>
             </a>
             
            
</div>';


                      }

@endphp
















</div>

<br>
<br>




@stop





@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
  @stop

@section('js')
   
    <script>

</script>



@stop


            