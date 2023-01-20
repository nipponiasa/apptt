
  <table class="table table-striped">
    <thead>
    <tr>
        <th>Color</th>
        <th>Status</th>
        <th>Days to deliver</th>
        <th>Action</th>
      </tr>

    </thead>

@php
        foreach($modelcount as $result) 
        {
                  $nipponia_stock=$result["WHLn"]-$result["purchased_from_nipponia"];
                  $wh_stock= $result["WH"]+$nipponia_stock;
                  $nonwh_stock=$result["nonWH"];
                  $reserv= $result["reserv"];
                  $demands= $result["demands"];
                  $soon= $result["soon"];
                  $mol_stock=$result["WHL"]+$nipponia_stock;

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
                  //dd("");
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
                  <td><span class='.$status.'</span></td>
                  <td><span>'.$days_for_del.'</span></td>
                  <td ><a class="btn btn-primary text-nowrap" href="mailto:info@trade-traffic.com?subject=Web Order for '.$result["category_name"].' '.$result["color"].'&body=Hallo team van Trade and Traffic,%0A%0AWij willen graag een order plaatsen.%0A%0AVoertuig (merk en model):'.$result["category_name"].'%0A%0AKleur:'.$result["color"].'   %0A%0ASnelheid:.....  %0A%0AMet vriendelijke groet / Best regards / Mit freundlichen Grüßen,">Mail us</a></td>
                  </tr>';

        }
                                           
@endphp

    </tbody>
  </table>