@extends('adminlte::page')
@section('title', 'Apps - Trade And Traffic')
@section('content_header')
<a href="{{ URL::previous() }}">Go Back</a>
        <h1>SO lines</h1>
    
@stop
@section('plugins.Datatables', true)
@section('content')
    <table id="example" class="display stripe" style="width:100%">
        <thead>
            <tr>
               <th>Product</th>
               <th>SO</th>
               <th>Desc</th>
               <th>SO subtotal</th>
               <th>Inv subtotal</th>
               <th>Invoice status</th>
               <th>SO date</th>
           </tr>
        </thead>
	 <tbody>
	
{{-------------------------------------------------------------------------------------------------------}}

@php
//var_dump($uii);
foreach($uii as $result) {
  //var_dump($totalvaluesnl);

  

          echo '<tr> <td>'.$result['product_id'][1].'</td><td>'.$result['order_id'][1].'</td><td>'.$result['name'].'</td><td>'.$result['price_subtotal'].'</td><td>'.$result['x_invoice_line_total'].'</td><td>'.$result['invoice_status'].'</td><td>'.$result['create_date'].'</td></tr>'."\n";
          
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
           </tr>
        </tfoot>
    </table>


@stop


@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@stop

@section('js')


@stop








