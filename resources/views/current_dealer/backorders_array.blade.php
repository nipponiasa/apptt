
{{-- Orismos pinaka  --}}


@php
//var_dump($per_model_sold_qty);
$headsbo = [
    'Model',
    '',
    '',
];
$configbo = [
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, ['orderable' => false]],
];
@endphp

{{-- Orismos pinaka  --}}



<div class="col-md-6 mb-5">
    <h1>BACK-ORDERS</h1>
            <x-adminlte-datatable id="table2" :heads="$headsbo">
                @foreach($bo_list as $bo)
                              <tr><td>{!! $bo['name'] !!}</td><td></td><td></td></tr>
                @endforeach
            </x-adminlte-datatable>
</div>



