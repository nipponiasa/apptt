@extends('adminlte::page')
@section('title', 'Delivery-Pick Form')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="ttcustom.css">
{{--   signature --}}
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>






<style>
.wrappers {
  position: relative;
  width:300px;
  height: 200px;
  -moz-user-select: none;
  -webkit-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.signature-pad {
  position: absolute;
  left: 0;
  top: 0;
  width:300px;
  height:200px;
  background-color: white;
}

</style>
{{--   signature --}}

@section('content_header')

<div class="container">

    <form id="pickdelform" action="{{url('/del_pick_edit')}}" method="post" >
    <input id="pickdelid" name="pickdelid" type="hidden" value="{{$uii->id}}">
    <input id="signaturesvg" name="signaturesvg" type="hidden" value="">
    <div class="row leftspace">

       <div class="col-md-3 mb-3" >
            <h1>Delivery-Pick Form</h1>
      </div>


        <div class="col-md-1 mb-3">
                    <div class="form-group">
                          <select id="pickingtype" name="pickingtype" class="form-control"  aria-label="Default select example">
                            <option value="Choose Type.." {{$uii->pickingtype=="Choose Type.."  ? 'selected' : ''}}>Type..</option>
                            <option value="Delivery"  {{$uii->pickingtype=="Delivery"  ? 'selected' : ''}}>Delivery</option>
                            <option value="Pick up"  {{$uii->pickingtype=="Pick up"  ? 'selected' : ''}}>Pick up</option>
                           </select>
                      </div>
        </div>




        <div class="col-md-1 mb-3">
                    <div class="form-group">
                          <select id="operationtype" name="operationtype" class="form-control"  aria-label="Default select example">
                            <option value="Choose Operation.." {{$uii->operationtype==" Selecteer een Operation.."  ? 'selected' : ''}}>Operation..</option>
                            <option value="Consignement"  {{$uii->operationtype=="Consignment"  ? 'selected' : ''}}>Consignment</option>
                            <option value="Loan Vehicle"  {{$uii->operationtype=="Loan Vehicle"  ? 'selected' : ''}}>Loan Vehicle</option>
                            <option value="New Delivery"  {{$uii->operationtype=="New Delivery"  ? 'selected' : ''}}>New Delivery</option>
                            <option value="Repair"  {{$uii->operationtype=="Repair"  ? 'selected' : ''}}>Repair</option>
                           </select>
                      </div>
        </div>


        <div class="col-md-1 mb-3">
                    <div class="form-group">
                          <select id="routingnbr" name="routingnbr" class="form-control"  aria-label="Default select example">
                            <option value="Routing.." {{$uii->routingnbr=="Route.."  ? 'selected' : ''}}>Route..</option>
                            <option value="A"  {{$uii->routingnbr=="A"  ? 'selected' : ''}}>A</option>
                            <option value="B"  {{$uii->routingnbr=="B"  ? 'selected' : ''}}>B</option>
                            <option value="C"  {{$uii->routingnbr=="C"  ? 'selected' : ''}}>C</option>
                            <option value="D"  {{$uii->routingnbr=="D"  ? 'selected' : ''}}>D</option>
                            <option value="E"  {{$uii->routingnbr=="E"  ? 'selected' : ''}}>E</option>
                           </select>
                      </div>
        </div>



        <div class="col-md-2 mb-3">
                  <div class="form-group">
                    <input type="date" class="form-control" id="routingdate" value="{{$uii->routingdate}}" name="routingdate" >
                  </div>
        </div>

       











        <div class="col-md-1 mb-2">
           <button type="submit" class="btn btn-primary">Update</button>
        </div>

        <div class="col-md-1 mb-2">
                <a class="btn btn-warning" id="finalize" href="#">Afronden</a>
        </div>
      

        <div class="col-md-1 mb-2">
        <a class="btn btn-danger" id="cancel" href="#">Annuleer</a>
        </div>

        <div class="col-md-1 mb-2">
                <a class="btn btn-default" id="refused" href="#">Geweigerd</a>
        </div>




        <!--  href="{{ URL::to('/forms/del_pick/pdf') }}" -->

   </div>
</div>





{{ csrf_field() }}



@stop

@section('content')



     <div class="container-fluid">
<!-- arxi -->
<div class="row">
     <div class="col-md-6">
                    @include('layouts.pick_del_edit.form_veh_det')
     </div>
     <div class="col-md-6">
                    @include('layouts.pick_del_edit.form_del_det')
     </div>
 </div>


 <div class="row">
     <div class="col-md-3">
                    @include('layouts.pick_del_edit.form_checkbox')
     </div>
     <div class="col-md-5">
                    @include('layouts.pick_del_edit.form_bat_det')
     </div>
     <div class="col-md-4">
                    @include('layouts.pick_del_edit.form_charger_det')
     </div>
 </div>

 <div class="row">
     <div class="col-md-8">
                    @include('layouts.pick_del_edit.form_com_det')
     </div>

 </div>





</form>


@if($signexists)


<div class="row">
     <div class="col-md-4">
     <img src="{{$uii->imagesignurl}}" id="hideunhide" class="img-fluid img-thumbnail rounded border border-primary" alt="" > 
  
                
     </div>

 </div>



@else

<div class="row">
     <div class="col-md-4">
     <img src="#" id="hideunhide" class="img-fluid img-thumbnail rounded border border-primary" alt="" > 
  
                    @include('layouts.pick_del_edit.form_sign_pad')
     </div>

 </div>

@endif


</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
  @stop

@section('js')
   
<script src="{{ asset('js/va/pick_del_form.js') }}"></script>
<script src="{{ asset('js/va/pick_del_form_signat.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@stop


            