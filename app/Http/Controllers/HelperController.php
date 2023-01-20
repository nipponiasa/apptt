<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Ripcord\Ripcord;
use PhpXmlRpc\Client;
use Illuminate\Support\Facades\DB;
use App\Services\Odoocall;

class HelperController extends Controller
{
    
    
    
    
    
    
    public function prepare_is_spare_part_for_show()   {

        $model = 'product.product';
        $query_arguments=array('&','&','&',array('tracking','=','serial'),
        array(['categ_id'][0],'!=',342),//samples
        array(['categ_id'][0],'!=',445),//unpublished
        array(['categ_id'][0],'!=',398)//used
    );
        $limitations=array('fields'=>array('categ_id'));
        $call=new Odoocall();
        $uii=$call->Odooquery($model,$query_arguments, $limitations);
        $full_path_categs = $this->unique_multidim_array($uii,'categ_id'); 

 //dd($full_path_categs);
        
        foreach($full_path_categs as $full_path_categ)
        {
            $temp=explode(' / ', $full_path_categ[1]);
            $categ_name=end($temp);
            $categ_id= $full_path_categ[0];
            $models[$categ_id]=$categ_name;

        }
        $exports=0;
   //dd($full_path_categs);
   return view('prepare_is_spare_part_for')->with('models',$models)->with('exports',$exports);

}










    
public function prepare_is_spare_part_for_export(Request $request)


{



    $validated = $request->validate([
        'spare_part' => 'required'
    ]);
//dd($validated);

$catid = intval($request->model_select);
$sp = $request->spare_part;
//$catid = $request->model_select;

$model = 'product.product';
$query_arguments=array('&','&','&',array('tracking','=','serial'),
array(['categ_id'][0],'!=',342),//samples
array(['categ_id'][0],'!=',445),//unpublished
array(['categ_id'][0],'!=',398)//used
);
$limitations=array('fields'=>array('categ_id'));
$call=new Odoocall();
$uii=$call->Odooquery($model,$query_arguments, $limitations);
$full_path_categs = $this->unique_multidim_array($uii,'categ_id'); 

//dd($full_path_categs);



foreach($full_path_categs as $full_path_categ)
{
    $temp=explode(' / ', $full_path_categ[1]);
    $categ_name=end($temp);
    $categ_id= $full_path_categ[0];
    $models[$categ_id]=$categ_name;

}




$query_arguments=array(
array(['categ_id'][0],'=',$catid)//samples
//used
);
$limitations=array('fields'=>array('categ_id','name','code'));
//$limitations=array('fields'=>array('categ_id'));
$call=new Odoocall();
$exports=$call->Odooquery($model,$query_arguments,$limitations);





//dd($full_path_categs);
return view('prepare_is_spare_part_for')->with('models',$models)->with('exports',$exports)->with('sp',$sp);

}










    //https://www.php.net/manual/en/function.array-unique.php
function unique_multidim_array($array, $key) {
    $temp_array = array();
    $i = 0;
   
   
    foreach($array as $val) {
        if (!in_array($val[$key],$temp_array)) {
            $temp_array[$i] = $val[$key];
        }
        $i++;
    }
    return $temp_array;
}   
    
    
    
    
    
    
    //
}
