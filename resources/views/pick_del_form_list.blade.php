@extends('adminlte::page')
@section('title', 'Delivery-Pick Form')
@section('plugins.Datatables', true)


@section('content_header')



@stop

@section('content')


<div class="container">
<!-- arxi -->
<div class="row">
     <div class="col-md-12 mb-3 mt-5">
                   <h1>Pickings and Deliveries</h1>
     </div>
 </div>


</div>







                
<div class="container-fluid">
<!-- arxi -->
<div class="row">
     <div class="col-md-12">
                    @include('layouts.pick_del.del_pick_list_table')
     </div>
 </div>


</div>






@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
  @stop

@section('js')
   
<script src="{{ asset('js/va/pick_del_list.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@stop


            