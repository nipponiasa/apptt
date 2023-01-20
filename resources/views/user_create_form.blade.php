@extends('adminlte::page')

@section('title', 'Create new spare part')
@section('plugins.Datatables', true)
@section('content_header')
    <h1>New user</h1>
@stop

@section('content')


<div class="container">
  <!-- Content here -->



<form action="{{url('create_new_user')}}" method="post" >


{{ csrf_field() }}


<div class="row">
              <div class="col-md-3 mb-5">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" >
                </div>
              </div>
              <div class="col-md-3 mb-5">
                <div class="form-group">
                  <label for="email">email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" >
                </div>
                </div>

                <div class="col-md-3 mb-5">
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control"  name="password" id="password">
                </div>
                </div>


                <div class="col-md-3 mb-5">
                <div class="form-group">


                <label for="role">Role</label>

                <select class="form-control"  name="role" id="role">
                    <option value='user' >User</option>
                    <option value='admin'>Admin</option>
                    <option value='manager'>Manager</option>
                    <option value='warehouse_administrator' >Warehouse Administrator</option>
                    <option value='marketing_user' selected>Marketing User</option>
                               
                </select>
                </div>

                </div>
  </div>




  
  <div class="row">
        <div class="col-md-3 mb-5">
        <button type="submit" class="btn btn-primary">Create and open new</button>
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


            