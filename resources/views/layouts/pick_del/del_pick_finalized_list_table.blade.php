<div class="table-responsive" >
                                  <table id="pickdellist" class="table mikro"  >
                                                                               <thead >
                                   
                                                                                   <tr>
                                                                                       <th>#</th>
                                                                                       <th id="dealer" class="searchable">Dealer</th>
                                                                                       <th id="type" class="searchable">Type</th>
                                                                                       <th id="vin" class="searchable">VIN</th>
                                                                                       <th id="operation" class="searchable">Operation</th>
                                                                                       <th id="gegevens" class="searchable">Model gegevens</th>
                                                                                       <th id="accunummer" class="searchable">Accunummer</th>
                                                                                       <th>Routing</th>
                                                                                       <th>Updated by</th>
                                   
                                                                                   </tr>
                                                                               </thead>
                                                                               <tbody>
                                                                                               @foreach($uii as $result) 
                                                                                                                   <tr>
                                                                                                                           <td><a href=del_pick_edit?id={{$result->id}}>{{$result->id}}</a></td>
                                                                                                                           <td>{{$result->address}}</td>
                                                                                                                           <td>{{$result->pickingtype}}  @if($result->vin!='') ✅ @endif    </td>
                                                                                                                           <td>{{$result->vin}}</td>
                                                                                                                           <td>{{$result->operationtype}}</td>
                                                                                                                           <td>{{$result->modeldet}}</td>
                                                                                                                           <td>{{$result->batterynbr}}</td>
                                                                                                                           <td>@if($result->hide_reason!=NULL) <span class="badge bg-info text-dark"> {{$result->hide_reason}}</span> @else    @if($result->routingdate=='2000-01-01') Not set @else  {{$result->routingnbr}} at {{$result->routingdate}}@endif                   @endif  </td>
                                                                                                                           <td>{{$result->name}}</td>
                                                                                                                   </tr>
                                                                                               @endforeach
                                                                               </tbody>
                                                             <tfoot>
                                   
                                                               </tfoot>
                                   </table>
                                   </div>
                                 
                                   
                                   <link rel="stylesheet" href="{{ asset('css/pick_del_list.css') }}">
                                   
                                   
                                   
                                       <!-- custom -->
                                     <script type="text/javascript" src="{{ asset('js/va/pick_del_list.js') }}"></script>

                                   
                                   
                                   

                                                              
                                   
                                   
                                   
                                   
                                   
                                   
                                   
                                   
                                   