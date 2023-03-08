<x-adminlte-datatable id="table_stock" :heads="$heads_stock" :config="$config"   striped hoverable with-buttons>
                                           
@php
               // $size = count($modelcount);
                // var_dump($uii);
                // echo '<pre>'; print_r($modelcount); echo '</pre>';
                // echo '<pre>'; print_r($cost_per_cat); echo '</pre>';
                $inWHWHL_total=0;
               $nonWH_total=0;
               $reserv_total=0;
               $demands_total=0;
               $cost_total=0;
               $total_price=0;


                foreach($modelcount as $result) {

               $inWHWHL=$result["WH"];
               $nonWH=$result["nonWH"];
               $reserv=$result["reserv"];
               $demands=$result["demands"];
               //   this is the last row (Total Cost): $cost_per_cat[$modelcountChild["cat_id"]]['cost']
               $cost_per_cat_single=array_key_exists($result["cat_id"],$cost_per_cat)?$cost_per_cat[$result["cat_id"]]['cost']:0;
               $nocostcount_single=array_key_exists($result["cat_id"],$cost_per_cat)?$cost_per_cat[$result["cat_id"]]['nocostcount']:0;
               $asterix_up=$nocostcount_single===0?'&nbsp;':'*';
               $list_price=$result["list_price"]*0.75;
               $total_price_per_model=($inWHWHL+$nonWH)*$list_price;
               $inWHWHL_total+=$result["WH"];
               $nonWH_total+=$result["nonWH"];
               $reserv_total+=$result["reserv"];
               $demands_total+=$result["demands"];
               $cost_total+=$cost_per_cat_single;
               $total_price+=($inWHWHL+$nonWH+$reserv)*$list_price;

                            echo '<tr> <td><a href=current_stock_model?catid='.$result["cat_id"].'>'.$result["category_name"].'</a></td><td>'.$inWHWHL.'</td><td>'. $nonWH.'</td><td  title='.substr_replace($result['originr'] ,"", -1).'   >'.$reserv.'</td><td  title='.substr_replace($result['origind'] ,"", -1).'   >'.$demands.'</td><td>'.number_format($list_price, 2, '.', ',').' €</td><td>'.number_format($total_price_per_model, 2, '.', ',').' €</td><td  style="white-space:nowrap;" title='.$nocostcount_single.' >'.number_format($cost_per_cat_single, 2, '.', ',').' €'.$asterix_up.'</td></tr>';
                        }

                        
                        echo '<tfoot> <td>Totals</td><td>'.$inWHWHL_total.'</td><td>'. $nonWH_total.'</td><td>'.$reserv_total.'</td><td>'.$demands_total.'</td><td></td><td>'.number_format($total_price, 2, '.', ',').' € </td><td>'.number_format($cost_total, 2, '.', ',').' € </td></tfoot>';
                @endphp




                </x-adminlte-datatable>
           