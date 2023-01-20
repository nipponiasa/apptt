

{{-- Form::text('foo') --}}



@extends('adminlte::page')



@section('title', 'Reporting Platform - Trade And Traffic Plus B.V.')



@section('content_header')

    <h1>Trade and Traffic reporting platform</h1>

@stop



@section('plugins.Datatables', true)

@section('content')




    <p>Welcome to Trade And Traffic Plus B.V. reporting platform.</p>
  
    @can('manager' | 'admin')

    <div class="row">
    <div class="col-md-4">
            <x-adminlte-small-box  text="Units Target Sales" icon="fas fa-motorcycle"
            theme="primary" url="https://bi.trade-traffic.com/units_target?year=2022&month=3" url-text="Units Target Sales per month"/>
    </div>
    <div class="col-md-4">
            <x-adminlte-small-box  text="Revenue Target" icon="fas fa-dollar-sign"
            theme="purple" url="https://bi.trade-traffic.com/revenue_target?year=2022" url-text="Revenue Target per month"/>
   </div>
   </div>
   @endcan

   <div class="row">
    <div class="col-md-4">
            <x-adminlte-small-box  text="New trip" icon="fas fa-road"
            theme="yellow" url="https://bi.trade-traffic.com/del_pick" url-text="Create a new trip"/>
    </div>
    <div class="col-md-4">
            <x-adminlte-small-box  text="Routes" icon="fas fa-map"
            theme="green" url="https://bi.trade-traffic.com/del_pick_list" url-text="List all pending trips"/>
   </div>
   </div>


















@stop





@section('css')

    <link rel="stylesheet" href="/css/admin_custom.css">

@stop











