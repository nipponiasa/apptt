                                  
                                        
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
                                                    <tr>
                                                    <td style="text-align: right;">Total:</td>
                                                            <td style="text-align: right;">@php echo number_format($totalrevenueall,2); @endphp</td>
                                                            <td style="text-align: right;">@php echo number_format($totaltargetall,2); @endphp</td>
                                                        <td style="text-align: right;">@php echo $totaltargetall != 0 ? number_format(100 * ($totalrevenueall - $totaltargetall) / $totaltargetall, 2) . "%" : "N/A"; @endphp</td>   
                                                       
                                                    </tr>

                                            </x-adminlte-datatable>
                                      

 