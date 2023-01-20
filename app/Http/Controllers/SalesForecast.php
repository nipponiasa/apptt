<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Ripcord\Ripcord;
use PhpXmlRpc\Client;
use Illuminate\Support\Facades\DB;
use App\Services\Odoocall;


class SalesForecast extends Controller
{
   


    public function sales_targets_show (){
        $model = 'product.model';
        $limitations=array('fields'=>array('id','name'));  // Array of wanted fields True, False  
        $call=new Odoocall();
        $model_list_raw=$call->Odooquery($model,null,$limitations );
  
        foreach($model_list_raw as $model){
          $model_list[ $model['id']]= $model['name'];
  
         
       }
  
  //dd( $model_list_raw);
  return view('sales_targets_input')->with('model_list',$model_list);
  }



  public function sales_targets_edit (Request $request){

    dd($request);
    $model = 'product.model';
    $limitations=array('fields'=>array('id','name'));  // Array of wanted fields True, False  
    $call=new Odoocall();
    $model_list_raw=$call->Odooquery($model,null,$limitations );

    foreach($model_list_raw as $model){
      $model_list[ $model['id']]= $model['name'];

     
   }

//dd( $model_list_raw);
return view('sales_targets_input')->with('model_list',$model_list);
}










}
