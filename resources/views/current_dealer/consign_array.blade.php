
{{-- Orismos pinaka  --}}


@php
//var_dump($per_model_sold_qty);
$heads = [
    'Model',
    'VIN',
    'Delivery Date',
    'Info',
];
$config = [
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, ['orderable' => false]],
];
@endphp

{{-- Orismos pinaka  --}}



<div class="col-md-6 mb-5">
    <h1>CONSIGNMENTS</h1>
            <x-adminlte-datatable id="table1" :heads="$heads">
                @foreach($consignment_list as $bike)
                @php  $date = date_create($bike['create_date']);
                $info_array=explode("/",$bike['location_id'][1]);
                $info=sizeof($info_array)>2? $info_array[2]:"";
                @endphp
                     <tr><td>{!! $bike['display_name'] !!}</td><td>{!! $bike['lot_id'][1] !!}</td><td>@php echo date_format($date, 'Y-m-d');  @endphp</td><td>@php echo $info;  @endphp</td></tr>
                @endforeach
            </x-adminlte-datatable>
</div>



