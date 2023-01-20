<x-adminlte-datatable id="table_stock" :heads="$heads_stock" :config="$config"   striped hoverable with-buttons>
                                           
@php

               $disas_total=0;
               $nb_total=0;
               $total_price=0;
                foreach($modelcount as $result) {
                        $in_disas=$result["WH"];
                        $nb=$result["soon"];
                        $list_price=$result["list_price"]*0.75;
                        $total_price_per_model=($in_disas+$nb)*$list_price;
                        $disas_total+=$result["WH"];
                        $nb_total+=$result["soon"];
                        $total_price+=($in_disas+$nb)*$list_price;
                        echo '<tr> <td><a href=current_stock_model2?catid='.$result["cat_id"].'>'.$result["category_name"].'</a></td><td>'.$in_disas.'</td><td>'. $nb.'</td><td>'.number_format($list_price, 2, '.', ',').' €</td><td>'.number_format($total_price_per_model, 2, '.', ',').' €</td></tr>';
                        }


                        echo '<tfoot> <td>Totals</td><td>'.$disas_total.'</td><td>'. $nb_total.'</td><td></td><td>'.number_format($total_price, 2, '.', ',').' € </td></tfoot>';
                @endphp




                </x-adminlte-datatable>
           