@extends('adminlte::page')
@section('title', 'Delivery-Pick Form')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="ttcustom.css">
{{--   signature --}}
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
{{--   signature --}}

@section('content_header')

<div class="container">

    <form id="mainform" action="{{url('/del_pick')}}" method="post" >


    <div class="row leftspace">

       <div class="col-md-3 mb-3" >
            <h1>Delivery-Pick Form</h1>
      </div>


        <div class="col-md-2 mb-3">
                    <div class="form-group">
                          <select id="pickingtype" name="pickingtype" class="form-control"  aria-label="Default select example">
                            <option value="Choose Type.." selected>Selecteer een Type..</option>
                            <option value="Delivery">Delivery</option>
                            <option value="Pick up">Pick up</option>
                           </select>
                      </div>
        </div>




        <div class="col-md-2 mb-3">
                    <div class="form-group">
                          <select id="operationtype" name="operationtype" class="form-control"  aria-label="Default select example">
                            <option value="Choose Operation.." selected>Selecteer een Operation..</option>
                            <option value="Consignment">Consignment</option>
                            <option value="Loan Vehicle">Loan Vehicle</option>
                            <option value="New Delivery">New Delivery</option>
                            <option value="Repair">Repair</option>
                           </select>
                      </div>
        </div>



        <div class="col-md-1 mb-3">
                    <div class="form-group">
                          <select id="routingnbr" name="routingnbr" class="form-control"  aria-label="Default select example">
                            <option  value="Routing.." selected>Route..</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                           </select>
                      </div>
        </div>








        <div class="col-md-2 mb-3">
                    <div class="form-group">
                    <input type="date" class="form-control" id="routingdate" name="routingdate" placeholder="Date to ">
                      </div>
        </div>

       


        <div class="col-md-2 mb-2">
           <button type="submit" class="btn btn-primary" onclick="return validateoptions();">Creeren</button>
        </div>

  {{--  div class="col-md-1 mb-2">
        <a class="btn btn-primary" href="{{ URL::to('/forms/del_pick/pdf') }}">Export to PDF</a>
        </div>
--}}
        

   </div>






{{ csrf_field() }}



@stop

@section('content')

                      @php
                              foreach($uii as $dealer){
                                $selected_dealers[$dealer['id']]=$dealer['display_name'];
                              }
                              $selected_dealers_option="Please choose option..";
                      @endphp

     <div class="container-fluid">
<!-- arxi -->
<div class="row">
     <div class="col-md-6">
                    @include('layouts.pick_del.form_veh_det')
     </div>
     <div class="col-md-6">
                    @include('layouts.pick_del.form_del_det')
     </div>
 </div>


 <div class="row">
     <div class="col-md-3">
                    @include('layouts.pick_del.form_checkbox')
     </div>
     <div class="col-md-5">
                    @include('layouts.pick_del.form_bat_det')
     </div>
     <div class="col-md-4">
                    @include('layouts.pick_del.form_charger_det')
     </div>
 </div>

 <div class="row">
     <div class="col-md-8">
                    @include('layouts.pick_del.form_com_det')
     </div>

 </div>














</form>


{{--  

<div class="row">
     <div class="col-md-4">
     <img src="#" id="hideunhide" class="img-fluid img-thumbnail rounded border border-primary"  style="display:none;" alt="" > 

                    @include('layouts.pick_del.form_sign_pad')
     </div>

 </div>
--}}


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


            