<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Ripcord\Ripcord;
use PhpXmlRpc\Client;
use Illuminate\Support\Facades\DB;
use App\Services\Odoocall;

class OdooSparePartsController extends Controller
{
   


    public function avail_per_catalog_show(){
      $model = 'product.model';
      $limitations=array('fields'=>array('id','name'));  // Array of wanted fields True, False  
      $call=new Odoocall();
      $model_list_raw=$call->Odooquery($model,null,$limitations );

      foreach($model_list_raw as $model){
        $model_list[ $model['id']]= $model['name'];

       
     }


return view('availability_per_catalog')->with('model_list',$model_list);
}



public function avail_per_catalog(Request $request)
{
           
//model_list
  $model = 'product.model';
  $limitations=array('fields'=>array('id','name'));  // Array of wanted fields True, False  
  $call=new Odoocall();
  $model_list_raw=$call->Odooquery($model,null,$limitations );


  $soldsp=$this->fetch_sold_ytd();


  foreach($model_list_raw as $model){
    $model_list[ $model['id']]= $model['name'];
 }



 //model_list
//sp_for_model
        $model_moto=intval($request->model);
        //dd( $model_moto);
        $selected_model=$model_list[$model_moto];
        $model = 'product.product.relation';
        //$limitations=array('limit'=>2);
        $limitations=array('fields'=>array('right_product_id','x_right_product_qty_available','x_right_product_virtual_available'));  // Array of wanted fields True, False  
        $query_arguments=array('&',array(['x_left_product_model_id'][0],'=', $model_moto),array(['type_id'][0], '=', 1)); 
        $call=new Odoocall();
        $uii=$call->Odooquery($model,$query_arguments,$limitations);
        $sp_for_model=array();
        foreach($uii as $result)
              {

                  $product=$result['right_product_id'][1];
                  if(str_contains($product, ']'))
                  {
                                    $sp_for_model[$result['right_product_id'][0]]['product_nbr']=ltrim(explode(']',$product)[0],'[');
                                    $sp_for_model[$result['right_product_id'][0]]['product_name']=explode(']',$product)[1];
                  } 
                  else
                  {
                    $sp_for_model[$result['right_product_id'][0]]['product_nbr']= $product;
                    $sp_for_model[$result['right_product_id'][0]]['product_name']= $product;

                  }


                                    $sp_for_model[$result['right_product_id'][0]]['qty_avail']=$result['x_right_product_qty_available'];
                                    $sp_for_model[$result['right_product_id'][0]]['virtual_avail']=$result['x_right_product_virtual_available'];
                

              }
//dd($sp_for_model);
      return view('availability_per_catalog')->with('model_list',$model_list)->with('sp_for_model',$sp_for_model)->with('selected_model',$selected_model)->with('soldsp',$soldsp);


}






public function fetch_sold_ytd(){
  $model = 'sale.report';
  $invstart=date("Y").'-01-01 00:00:52';
  $query_arguments=array(array('date','>',$invstart));
  
  $limitations=array('fields'=>array('product_id','qty_invoiced'));
  $call=new Odoocall();
  $uii=$call->Odooquery($model,$query_arguments,$limitations);
  
  $modelcount=array();
  foreach($uii as $result)
                {

                  if (array_key_exists($result['product_id'][0],$modelcount))
                  {
                    $modelcount[$result['product_id'][0]]+=$result['qty_invoiced'];

                  }

                else
                {
                 $modelcount[$result['product_id'][0]]=$result['qty_invoiced'];
                }
                }
                //dd($modelcount);
  return $modelcount;

}


















}
