<div class="table-responsive" >
                                  <table id="pickdellist" class="table mikro"  >
                                                                               <thead >
                                   
                                                                                   <tr>
                                                                                       <th>#</th>
                                                                                       <th id="dealer">Dealer</th>
                                                                                       <th id="type">Type</th>
                                                                                       <th>Routing</th>
                                                                                       <th>Updated by</th>
                                   
                                                                                   </tr>
                                                                               </thead>
                                                                               <tbody>
                                                                                               @foreach($uii as $result) 
                                                                                                                   <tr>
                                                                                                                           <td ><a href=del_pick_edit?id={{$result->id}}>{{$result->id}}</a></td>
                                                                                                                           <td>{{$result->address}}</td>
                                                                                                                           <td >{{$result->pickingtype}}  @if($result->vin!='') ✅ @endif    </td>
                                                                                                                           <td >@if($result->routingdate=='2000-01-01') Not set @else  {{$result->routingnbr}} at {{$result->routingdate}}@endif</td>
                                                                                                                           <td >{{$result->name}}</td>
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

                                   
                                   
                                   

                                                              
                                   
                                   
                                   
                                   
                                   
                                   
                                   
                                   
                                   