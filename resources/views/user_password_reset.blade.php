@extends('adminlte::page')

@section('title', 'Dashboard')
@section('plugins.Datatables', true)
@section('content_header')
    <h1>Change Password for {{ $user_current->name }}</h1>
@stop

@section('content')


<div class="container">
  <!-- Content here -->



<form action="{{url('reset_user_password')}}" method="post" >

<input type="hidden" class="form-control" name="modified_by" id="modified_by" value={{ Auth::user()->name }}  >
<input type="hidden" class="form-control" name="id" id="id" value={{ $user_current->id }}  >
{{ csrf_field() }}


<div class="row">
           



 


<div class="col-md-3 mb-5">
                <div class="form-group">
                  <label for="password">New Password</label>
                  <input type="password" class="form-control"  name="password" id="password">
                </div>
                </div>














  </div>


  













  
  <div class="row">
        <div class="col-md-3 mb-5">
        <button type="submit" class="btn btn-primary">Update</button>
        </div>
  </div>





</form>

</div>

















@stop





@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
  @stop

@section('js')
   

    <script>
          var invoicenipcheck = document.getElementById('invoiced');
          var inv_nbr = document.getElementById('inv_nipponia_nbr');
          var inv_nipponia_paid = document.getElementById('inv_nipponia_paid');
          var inv_nipponia_date = document.getElementById('inv_nipponia_date');
          invoicenipcheck.onchange = function() {
            inv_nipponia_nbr.disabled = !this.checked ;
            inv_nipponia_paid.disabled = !this.checked ;
            inv_nipponia_date.disabled = !this.checked ;
                   };


                



</script>


<script> 

          var sold = document.getElementById('sold');
          var registration_nbr = document.getElementById('registration_nbr');
          var location_stock = document.getElementById('location');
          var inv_eccity_nbr = document.getElementById('inv_eccity_nbr');
          var inv_eccity_date = document.getElementById('inv_eccity_date');
          sold.onchange = function() {
            registration_nbr.disabled = !this.checked ;
            location_stock.disabled = !this.checked ;
            inv_eccity_nbr.disabled = !this.checked ;
            inv_eccity_date.disabled = !this.checked ;
                   };








 </script>




   










@stop


            