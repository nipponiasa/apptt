@isset($sp_for_model)                     
                                        
                                            <x-adminlte-datatable id="table_sp" :heads="$heads_sp" :config="$config"    striped hoverable with-buttons>
                                             @foreach($sp_for_model as $key=>$sp)
                                                    <tr>
                                                    <td style="text-align: right;">{{$sp['product_nbr']}}</td>
                                                    <td style="text-align: right;">{{$sp['product_name']}}</td>
                                                    <td style="text-align: right;">{{$sp['qty_avail']}}</td>
                                                    <td style="text-align: right;">{{$sp['virtual_avail']}}</td>
                                                    <td style="text-align: right;">@isset($soldsp[$key]) {{$soldsp[$key]}} @endisset</td>
                                                    </tr>
                                                @endforeach

                                            </x-adminlte-datatable>
                                      

                                            @endisset