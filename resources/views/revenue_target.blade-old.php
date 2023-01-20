@extends('adminlte::page')
@section('title', 'Revenew Targets vs Realisation 2022')
@section('plugins.Datatables', true)
@section('content_header')
        <a href="{{ URL::previous() }}">Go Back</a>
        <h1>Trade and Traffic Plus - Revenew Targets vs Realisation</h1>


        <style>
.table thead th {
    text-align: right;

</style>
@stop



@php

$heads_motos = [ 'Month','Invoiced Untaxed €', 'Target','Percentage(%)'];
$config = [

        'order' => [[0, 'asc']],
        'columns' => [['orderable' => false], null, null, null ],
        'paging'=>   false,
        'searching'=>   false,
        ];


@endphp




@section('content')
{{-- Example with empty option (for Select) --}}








<div class="container">
<form method="get" action="/revenue_target">
        @csrf
<div class="row">

       
<div class="col-md-3">   


<x-adminlte-select name="year">
    <x-adminlte-options :options="['2020'=>2020, '2021'=>2021, '2022'=>2022, '2023'=>2023, '2024'=>2024]"  empty-option="Select year..."/>
</x-adminlte-select>
</div>



<div class="col-md-3">   
<button type="submit" class="btn btn-primary">Update</button>
</div>

</div>

</form>





                                    <div class="row">
                                        
                                            <x-adminlte-datatable id="table_invoices" :heads="$heads_motos" :config="$config"   striped>
                                             
                                                    <tr>
                                                    <td style="text-align: right;">01.January</td>
                                                    <td style="text-align: right;">@php echo number_format($revenue[1],2); @endphp</td>
                                                    <td style="text-align: right;">@php echo number_format($totalpermonthtarget[1],2); @endphp</td>
                                                    <td style="text-align: right;">@php echo  number_format($percentage[1],2) ."%"; @endphp</td>   
                                                    </tr>
                                                
                                                    <tr>
                                                    <td style="text-align: right;">02.February</td>
                                                     <td style="text-align: right;">@php echo number_format($revenue[2],2); @endphp</td>
                                                     <td style="text-align: right;">@php echo number_format($totalpermonthtarget[2],2); @endphp</td>
                                                    <td style="text-align: right;">@php echo number_format($percentage[2],2) ."%"; @endphp</td>   
                                                          
                                                    </tr>

                                                    <tr>
                                                    <td style="text-align: right;">03.March</td>
                                                            <td style="text-align: right;">@php echo number_format($revenue[3],2); @endphp</td>
                                                            <td style="text-align: right;">@php echo number_format($totalpermonthtarget[3],2); @endphp</td>
                                                    <td style="text-align: right;">@php echo number_format($percentage[3],2) ."%"; @endphp</td>   
                                                          
                                                    </tr>
                                                
                                                    <tr>
                                                    <td style="text-align: right;">04.April</td>
                                                            <td style="text-align: right;">@php echo number_format($revenue[4],2); @endphp</td>
                                                            <td style="text-align: right;">@php echo number_format($totalpermonthtarget[4],2); @endphp</td>
                                                    <td style="text-align: right;">@php echo number_format($percentage[4],2) ."%"; @endphp</td>   
                                                          
                                                    </tr>

                                                    <tr>
                                                    <td style="text-align: right;">05.May</td>
                                                            <td style="text-align: right;">@php echo number_format($revenue[5],2); @endphp</td>
                                                            <td style="text-align: right;">@php echo number_format($totalpermonthtarget[5],2); @endphp</td>
                                                    <td style="text-align: right;">@php echo number_format($percentage[5],2) ."%"; @endphp</td>   
                                                    </tr>
                                                
                                                    <tr>
                                                    <td style="text-align: right;">06.June</td>
                                                            <td style="text-align: right;">@php echo number_format($revenue[6],2); @endphp</td>
                                                            <td style="text-align: right;">@php echo number_format($totalpermonthtarget[6],2); @endphp</td>
                                                    <td style="text-align: right;">@php echo number_format($percentage[6],2) ."%"; @endphp</td>   
                                                    </tr>



                                                    <tr>
                                                    <td style="text-align: right;">07.July</td>
                                                            <td style="text-align: right;">@php echo number_format($revenue[7],2); @endphp</td>
                                                            <td style="text-align: right;">@php echo number_format($totalpermonthtarget[7],2); @endphp</td>
                                                    <td style="text-align: right;">@php echo number_format($percentage[7],2) ."%"; @endphp</td>   
                                                          
                                                    </tr>
                                                
                                                    <tr>
                                                    <td style="text-align: right;">08.August</td>
                                                            <td style="text-align: right;">@php echo number_format($revenue[8],2); @endphp</td>
                                                            <td style="text-align: right;">@php echo number_format($totalpermonthtarget[8],2); @endphp</td>
                                                    <td style="text-align: right;">@php echo number_format($percentage[8],2) ."%"; @endphp</td>   
                                                          
                                                    </tr>


                                                    <tr>
                                                    <td style="text-align: right;">09.September</td>
                                                            <td style="text-align: right;">@php echo number_format($revenue[9],2); @endphp</td>
                                                            <td style="text-align: right;">@php echo number_format($totalpermonthtarget[9],2); @endphp</td>
                                                    <td style="text-align: right;">@php echo number_format($percentage[9],2) ."%"; @endphp</td>   
                                                          
                                                    </tr>
                                                
                                                    <tr>
                                                    <td style="text-align: right;">10.October</td>
                                                            <td style="text-align: right;">@php echo number_format($revenue[10],2); @endphp</td>
                                                            <td style="text-align: right;">@php echo number_format($totalpermonthtarget[10],2); @endphp</td>
                                                    <td style="text-align: right;">@php echo number_format($percentage[10],2) ."%"; @endphp</td>   
                                                          
                                                    </tr>





                                                    <tr>
                                                    <td style="text-align: right;">11.November</td>
                                                            <td style="text-align: right;">@php echo number_format($revenue[11],2); @endphp</td>
                                                            <td style="text-align: right;">@php echo number_format($totalpermonthtarget[11],2); @endphp</td>
                                                    <td style="text-align: right;">@php echo number_format($percentage[11],2) ."%"; @endphp</td>   
                                                          
                                                    </tr>
                                                
                                                    <tr>
                                                    <td style="text-align: right;">12.December</td>
                                                            <td style="text-align: right;">@php echo number_format($revenue[12],2); @endphp</td>
                                                            <td style="text-align: right;">@php echo number_format($totalpermonthtarget[12],2); @endphp</td>
                                                        <td style="text-align: right;">@php echo number_format($percentage[12],2) ."%"; @endphp</td>   
                                                          
                                                    </tr>







                                            </x-adminlte-datatable>
                                      

                                    </div>



                                    </div>





@stop





@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>



</script>


@stop