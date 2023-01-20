
                                        
                                            <x-adminlte-datatable id="table_invoices" :heads="$heads_motos" :config="$config"   striped hoverable with-buttons>
                                           
                                            @php
                                            $in_so=0;
                                            $delivered=0;
                                            $real_invoiced=0;
                                            $target=0;
                                            $expected_total_unit_sales=0;
                                            $untaxed_amount_invoiced_total=0;
foreach($sales_odoo_models_id as $result) {
    $wholesale_total=$result['wholesale_price']*$result['real_invoiced'];
    $pososto_inv_wholes=$wholesale_total!=0?sprintf("%.2f%%",(1-$result['untaxed_amount_invoiced']/$wholesale_total) * 100):"";
          echo '<tr> <td >'.$result['bi_name'].'</td><td   title='.substr_replace($result['so_name'] ,"", -1).'>'.$result['in_so'].'</td><td style="text-align: right;">'.$result['delivered'].'</td><td style="text-align: right;">'.$result['real_invoiced'].'</td><td style="text-align: right;">'.$result['target'].'</td><td  style="text-align: right;" title='.$result['untaxed_amount_invoiced']."/".$wholesale_total."/".$result['wholesale_price'].' (>'.$pososto_inv_wholes.'</td> </tr>'."\n";
                                            $in_so+=$result['in_so'];
                                            $delivered+=$result['delivered'];
                                            $real_invoiced+=$result['real_invoiced'];
                                            $target+=$result['target'];
                                            $expected_total_unit_sales+=$result['wholesale_price']*$result['real_invoiced'];
                                            $untaxed_amount_invoiced_total+=$result['untaxed_amount_invoiced'];

}

echo '<tr> <td >Total</td><td >'.$in_so.'</td><td style="text-align: right;">'.$delivered.'</td><td style="text-align: right;">'.$real_invoiced.'</td><td style="text-align: right;">'. $target.'</td><td style="text-align: right;" title='.$untaxed_amount_invoiced_total."//".$expected_total_unit_sales.' (></td> </tr>'."\n";//sprintf("%.2f%%",(1-$untaxed_amount_invoiced_total/ $expected_total_unit_sales) * 100)


@endphp
                                           
                                           
                             
                                           
                                           
                                           
                                           
          

                                            </x-adminlte-datatable>
                                      

 