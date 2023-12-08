
  <table class="table table-striped">
    <thead>
    <tr>
        <th>Color</th>
        <th>Speed</th>
        <th>WH</th>
        <th>Cons</th>
        <th>WHLn</th>
        <th>POn</th>
        <th>Res</th>
        <th>Dem</th>
        <th>Exp</th>
        <th>Status</th>
        <th>Days to deliver</th>
      </tr>

    </thead>

@php
//dd($modelcount);
        //
////////////////*****************************WH stock is total whl + wh */
        foreach($modelcount as $result) 
        {
                  $nipponia_stock=$result["WHLn"]-$result["purchased_from_nipponia"];
                  $wh_stock= $result["WH"]+$nipponia_stock;
                  $nonwh_stock=$result["nonWH"];
                  $reserv= $result["reserv"];
                  $demands= $result["demands"];
                  $soon= $result["soon"];
                  $mol_stock=$result["WHL"]+$nipponia_stock;

                  $originr=substr($result['originr'], -1)==="," ? substr_replace($result['originr'] ,"", -1) : $result['originr'];
                  $origind=substr($result['origind'], -1)==="," ? substr_replace($result['origind'] ,"", -1) : $result['origind'];
                  $eta=substr($result['eta'], -1)==="," ? substr_replace($result['eta'] ,"", -1) : $result['eta'];




                  //$status='"badge badge-info">Expected'." ".$result["eta"];
                  if($mol_stock>0)
                          {
                            $days_for_del="3 days";
                          }
                  elseif($mol_stock<0 and $wh_stock-$mol_stock>1)
                                                                    {
                                                                      $days_for_del="5 days";
                                                                    }          
                  else
                                                                    {
                                                                      $days_for_del="10 days";
                                                                    }  




                 

                  $condition_quantity=$wh_stock+$nonwh_stock-$demands;
                  //print_r($condition_quantity);
                  if($condition_quantity>3 and $wh_stock>1)
                          {
                            $status='"badge badge-success">Available';
                          }
                  elseif(($condition_quantity < 4 and $condition_quantity>0) or ($condition_quantity>3 and $wh_stock<2) )
                                                                    {
                                                                      $status='"badge badge-warning">Limited';
                                                                    }                                                         
                  elseif($condition_quantity<=0 and $soon+$condition_quantity > 0)
                                                                    {
                                                                      $status='"badge badge-info">Expected'." ".substr_replace($result['eta'] ,"", -1);
                                                                      $days_for_del="";
                                                                    }    
                  else
                    {
                      $status='"badge badge-danger">Out of Stock';
                      $days_for_del="";
                    }  


                  echo 
                  '<tr> 
                  <td>'.$result["color"].'</td>
                  <td>'.$result["speed"].'</td>
                  <td  title='.$mol_stock.'   >'.$wh_stock.'</td>
                  <td>'.$result["nonWH"].'</td>
                  <td>'.$result["WHLn"].'</td>
                  <td>'.$result["purchased_from_nipponia"].'</td>
                  <td  title='.$originr.'   >'.$result["reserv"].'</td>
                  <td  title='.$origind.'   >'.$result["demands"].'('.$result["ncrdemands"].')</td>
                  <td  title='.$eta.'   >'.$result["soon"].'</td>
                  <td><span class='.$status.'</span></td><td><span>'.$days_for_del.'</span></td>
                  </tr>';

        }
        ////////////////*****************************WH stock is total whl + wh */                                          
@endphp

    </tbody>
  </table>