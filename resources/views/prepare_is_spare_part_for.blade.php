@extends('adminlte::page')
@section('title', 'Import to Odoo after you remove this line')
@section('plugins.Datatables', true)
@section('content_header')
        <a href="{{ URL::previous() }}">Go Back</a>
        <h1>Prepare Xl file for the relation: "Model Has Spare Part"</h1>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
@stop





@section('content')


<form class="forms" method="POST" enctype="multipart/form-data" action="/sp/prepareimports">
@csrf
<div class="form-group">
                               <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Moto</label>
                                </div>
                                <select class="custom-select" id="model_select" name="model_select">
                                    <option selected>Choose...</option>
                                    @foreach($models as $category_id => $model_name)
                                                                    <option value="{{$category_id}}">{{$model_name}}</option>
                                    @endforeach
                                </select>
                                </div>

                                <div class="col mb-3">
                <h5 ><span class="badge badge-dark">Has Spare Part</span></h5>
                </div>

                            <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>Spare Part</b></span>
                            </div>
                            <input type="text" class="form-control" id="spare_part" name="spare_part" placeholder="Part number only" aria-label="Part number only" aria-describedby="basic-addon1">
                            </div>

              <div class="col-md-3">   
                                    <button type="submit" class="btn btn-primary">Update</button>
                </div>


 @if ($errors->any())
    <div class="alert alert-danger mt-5" >
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
@endforeach
        </ul>
    </div>
@endif

</form>




@php
echo "<br>";


$heads_export = [ 
        'left_product_id',
        'type_id',
        'right_product_id'
];
$config = [
        'order' => [[1, 'asc']],
        'paging'=>   false,
        'searching'=>   false,
        'info'=>   false,
        'scrollX'=> 400,
        'buttons'=> ['excel'],
        ];

@endphp




        <x-adminlte-datatable id="table_invoices" :heads="$heads_export" :config="$config"   striped hoverable with-buttons>



@php    
if (is_array($exports))
{


foreach($exports as $export)
{
         echo '<tr> <td >'.$export['code'].'</td><td>Has Spare Part</td><td>'.$sp.'</td></tr>';
}
 
     

}


@endphp






</x-adminlte-datatable>



@stop





@section('css')

    <link rel="stylesheet" href="/css/admin_custom.css">

@stop


















