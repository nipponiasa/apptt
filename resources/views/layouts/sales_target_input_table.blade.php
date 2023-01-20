<x-adminlte-datatable id="table_stock" :heads="$heads_stock" :config="$config"   striped hoverable>
                                           
@php

$i=0;
                foreach($model_list as $result) {
                        $i++;
                        echo '<tr> 
                                <td>'.$result.'</td>
                                <td> <input type="text" id="row-'.$result.'-01" name="row-'.$result.'-01" value="0" style="max-width:45px;"></td>
                                <td> <input type="text" id="row-'.$result.'-02" name="row-'.$result.'-02" value="0" style="max-width:45px;"></td>
                                <td> <input type="text" id="row-'.$result.'-03" name="row-'.$result.'-03" value="0" style="max-width:45px;"></td>
                                <td> <input type="text" id="row-'.$result.'-04" name="row-'.$result.'-04" value="0" style="max-width:45px;"></td>
                                <td> <input type="text" id="row-'.$result.'-05" name="row-'.$result.'-05" value="0" style="max-width:45px;"></td>
                                <td> <input type="text" id="row-'.$result.'-06" name="row-'.$result.'-06" value="0" style="max-width:45px;"></td>
                                <td> <input type="text" id="row-'.$result.'-07" name="row-'.$result.'-07" value="0" style="max-width:45px;"></td>
                                <td> <input type="text" id="row-'.$result.'-08" name="row-'.$result.'-08" value="0" style="max-width:45px;"></td>
                                <td> <input type="text" id="row-'.$result.'-09" name="row-'.$result.'-09" value="0" style="max-width:45px;"></td>
                                <td> <input type="text" id="row-'.$result.'-10" name="row-'.$result.'-10" value="0" style="max-width:45px;"></td>
                                <td> <input type="text" id="row-'.$result.'-11" name="row-'.$result.'-11" value="0" style="max-width:45px;"></td>
                                <td> <input type="text" id="row-'.$result.'-12" name="row-'.$result.'-12" value="0" style="max-width:45px;"></td>
                        </tr>';
                        }


                     
                @endphp

                <tfoot>
                         <td>Totals</td>
                         <td id="row-sum-01"></td>
                         <td id="row-sum-02"></td>
                         <td id="row-sum-03"></td>
                         <td id="row-sum-04"></td>
                         <td id="row-sum-05"></td>
                         <td id="row-sum-06"></td>
                         <td id="row-sum-07"></td>
                         <td id="row-sum-08"></td>
                         <td id="row-sum-09"></td>
                         <td id="row-sum-10"></td>
                         <td id="row-sum-11"></td>
                         <td id="row-sum-12"></td>
                </tfoot>


</x-adminlte-datatable>
           