@extends('adminlte::page')

@section('title', 'Dashboard')
@section('plugins.Datatables', true)
@section('content_header')
    <h1>{{ $user_current->name }} {{ $user_current->role }} </h1>
@stop

@section('content')


<div class="container">
  <!-- Content here -->



<form action="{{url('update_user_details')}}" method="post" >
<input type="hidden" class="form-control" name="modified_by" id="modified_by" value={{ Auth::user()->name }}  >
<input type="hidden" class="form-control" name="id" id="id" value={{ $user_current->id }}  >
{{ csrf_field() }}


<div class="row">
              <div class="col-md-3 mb-5">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" value={{ $user_current->name }} >
                </div>
              </div>
              <div class="col-md-3 mb-5">
                <div class="form-group">
                  <label for="email">email</label>
                  <input type="text" class="form-control" name="email" id="email" value={{ $user_current->email }} >
                </div>
                </div>



 




                <div class="col-md-3 mb-5">
                <label for="role">Role</label>
                    <select class="form-control"  name="role" id="role">
                    <option value={{ $user_current->role }} selected></option>
                     <option value='user' >User</option>
                    <option value='admin'>Admin</option>
                    <option value='manager'>Manager</option>
                    <option value='warehouse_administrator' >Warehouse Administrator</option>
                    <option value='marketing_user' selected>Marketing User</option>
                    </select>
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
   









   










@stop


            