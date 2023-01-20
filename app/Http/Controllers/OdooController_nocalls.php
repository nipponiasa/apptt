<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Ripcord\Ripcord;
use PhpXmlRpc\Client;
use Illuminate\Support\Facades\DB;
class OdooController_nocalls extends Controller
{
 //production
   //const URL ='https://alpiek-oisterwijk-traden-and-traffic-modules.odoo.com';
 //  const DB ='alpiek-oisterwijk-traden-and-traffic-modules-13-0-874478';
//production





    //test
    //const URL ="https://testodoo.trade-traffic.com"; 
    //const DB = "alpiek-oisterwijk-traden-and-traffic-modules-13-0-te-1303822";
    //test


    
    //functions used in this controler
   //..........................................................................
   function searchmodelname($ftable, $modelname) {
    $size = count($ftable);
    $thesi = -1;
    for($i = 0; $i < $size; $i++)
            {
                if ($ftable[$i]["name"]==$modelname) :
                    $thesi = $i;
                    break;
                endif;
            }
    return $thesi;
    }
    //..........................................................................




    public function fetch_current_stock()
        {
            $url = Config('configva.odoo.production_url');//einai ston config folder
            $db = Config('configva.odoo.production_db');//einai ston config folder
            $username = Config('configva.odoo.user');//einai ston config folder
            $password = Config('configva.odoo.pass');//einai ston config folder
         
            $common = Ripcord::client("$url/xmlrpc/2/common");
            $uid = $common->authenticate($db, $username, $password, array());
            $models = Ripcord::client("$url/xmlrpc/2/object");
            $query_arguments=array('&','&','&','&','&','&','&',array('tracking', '=', 'serial'),array(['location_id'][0],'!=',15),array(['location_id'][0],'!=',762),array(['location_id'][0],'!=',13),array(['location_id'][0],'!=',16),array(['location_id'][0],'!=',2013),array(['location_id'][0],'!=',5),array(['location_id'][0],'!=',4),array(['location_id'][0],'!=',14)); // Check polish notation in Odoo ( A or B ) AND ( C or D or E )  ginetai [ '&', '|', (A), (B), '|', (C), '|', (D), (E) ] 
            // $query_arguments=array(array('tracking', '!=', 'none'));// Check polish notation in Odoo ( A or B ) AND ( C or D or E )  ginetai [ '&', '|', (A), (B), '|', (C), '|', (D), (E) ] 
           // $limitations=array('fields'=>array('in_date','lot_id','location_id','tracking','inventory_quantity','quantity','reserved_quantity','product_id','product_uom_id','display_name','create_uid','product_tmpl_id')) ;// Array of wanted fields True, False
           $limitations=array('fields'=>array('location_id','product_id','inventory_quantity','quantity','reserved_quantity','product_tmpl_id')) ;
           
           $uii=$models->execute_kw($db, $uid, $password,'stock.quant', 'search_read', array($query_arguments), $limitations);//telos execute_kw
            // var_dump($uii);
            $modelcount = array();
            //15->Production
             //2075 -> Mol
              //2076 ->Mol Input (sthn ousia einai pali Partner Locations/Customers/Input)
              //1975->WH/Trade & Traffic Plus BV/Heerde
             //8-> WH/Trade & Traffic Plus BV
            // 9-> Partner Locations/Customers/Input
           // 4-> "Partner Locations/Vendors" 
           //5->Partner Locations/Customers poulimeno
           //13->"Physical Locations/Trade & Traffic Plus BV: Transit Location"
           //14->"Virtual Locations/Trade & Traffic Plus BV: Inventory adjustment"
           //762->Virtual Locations/Trade and Traffic Plus BV: Missing
            //2013->Virtual Locations/Trade and Traffic Plus BV: Disassembled
//16->Virtual Locations/Trade & Traffic Plus BV: Scrap

           foreach($uii as $result)


           {
               $modelochk=$result['product_tmpl_id'][1];
               $chkthesi=$this->searchmodelname($modelcount,$modelochk); //allivs tha epsaxne na brei mia global synarthsh
               $currentlocation=$result['location_id'][0];
               $reserved_v=$result['reserved_quantity'];
               $id=$result['product_tmpl_id'][0];//$result['product_id'][0];
           if ($reserved_v==0):
                   if ($chkthesi==-1):
                           if($currentlocation==8 or $currentlocation==2075 or $currentlocation==1975):
                               $pushtobe=['name'=>$modelochk, 'WH'=> 1,'soon'=> 0, 'nonWH'=> 0, 'reserv'=> 0, 'id'=>$id];
                               array_push($modelcount, $pushtobe);
                           elseif($currentlocation==9):
                               $pushtobe=['name'=>$modelochk, 'WH'=> 0, 'soon'=> 1, 'nonWH'=> 0, 'reserv'=> 0, 'id'=>$id];	
                               array_push($modelcount, $pushtobe);
                           elseif($currentlocation!=4 and $currentlocation!=5 and $currentlocation!=14 and $currentlocation!=762 and $currentlocation!=13):
                               $pushtobe=['name'=>$modelochk, 'WH'=> 0,'soon'=> 0, 'nonWH'=> 1, 'reserv'=> 0, 'id'=>$id];
                               array_push($modelcount, $pushtobe);
                           endif;
                           
                   else:
                           if($currentlocation==8 or $currentlocation==2075 or $currentlocation==1975):
                               $modelcount[$chkthesi]["WH"]++;
                       elseif($currentlocation==9 or $currentlocation==2076):
                               $modelcount[$chkthesi]["soon"]++;
                           elseif($currentlocation!=4 and $currentlocation!=5 and $currentlocation!=14 and $currentlocation!=762 and $currentlocation!=13):
                               $modelcount[$chkthesi]["nonWH"]++;
                           endif;
                   endif;
           endif;
       
           
           if ($reserved_v!=0):
                   if ($chkthesi==-1):
                           if($currentlocation==8 ):
                               $pushtobe=['name'=>$modelochk, 'WH'=> 0,'soon'=> 0, 'nonWH'=> 0, 'reserv'=> 1, 'id'=>$id];
                               array_push($modelcount, $pushtobe);
                           elseif($currentlocation==9 or $currentlocation==2076):
                               $pushtobe=['name'=>$modelochk, 'WH'=> 0, 'soon'=> 1, 'nonWH'=> 0, 'reserv'=> 0, 'id'=>$id];	
                               array_push($modelcount, $pushtobe);
                           elseif($currentlocation!=4 and $currentlocation!=5 and $currentlocation!=14 and $currentlocation!=762 and $currentlocation!=13):
                               $pushtobe=['name'=>$modelochk, 'WH'=> 0,'soon'=> 0, 'nonWH'=> 0, 'reserv'=> 1, 'id'=>$id];
                               array_push($modelcount, $pushtobe);
                           endif;
                           
                   else:
           
                               
           
                       if($currentlocation==9 or $currentlocation==2076):
                               $modelcount[$chkthesi]["soon"]++;
                           else:
                               //$modelcount[$chkthesi]["reserv"]++;
                           endif;
           
           
           
           
                   endif;
           endif;
           
               
           }
           
      
            
       
            //return view('current_stock')->with('current_stock', $modelcount); 
        return view('current_stock')->with('modelcount',$modelcount)->with('uii', $uii);
        }
    

        public function fetch_current_stock_model(Request $request){
           
            $modelid = intval($request->modelid);

            $url = self::URL; 
            $db = self::DB;
            $username = Config('configva.odoo.user');//einai ston config folder
            $password = Config('configva.odoo.pass');//einai ston config folder
         
            $common = Ripcord::client("$url/xmlrpc/2/common");
            $uid = $common->authenticate($db, $username, $password, array());
            $models = Ripcord::client("$url/xmlrpc/2/object");
         //  $query_arguments=array('&','&','&','&','&','&','&','&',array('location_id.usage','=','internal'),array('create_date','>=',$datemin),array('create_date','<=',$datemax),array(['location_id'][0],'!=',2075),array(['location_id'][0],'!=',2076),array(['location_id'][0],'!=',1975),array(['location_id'][0],'!=',8),array(['location_id'][0],'!=',9),array(['product_tmpl_id'][0],'=',$modelid),array('lot_id','!=',False));            
         $limitations=array('fields'=>array('product_tmpl_id','display_name','lot_id','location_id','create_date'));  // Array of wanted fields True, False   
         // $query_arguments=array('&','&','&',array(['product_tmpl_id'][0],'=',$modelid),array('tracking', '=', 'serial'),array(['location_id'][0],'!=',5),array(['location_id'][0],'!=',4),array(['location_id'][0],'!=',14)); // Check polish notation in Odoo ( A or B ) AND ( C or D or E )  ginetai [ '&', '|', (A), (B), '|', (C), '|', (D), (E) ] 
         $query_arguments=array('&','&','&','&','&','&','&','&',array(['product_tmpl_id'][0],'=',$modelid),array(['location_id'][0],'!=',15),array('tracking', '=', 'serial'),array(['location_id'][0],'!=',13),array(['location_id'][0],'!=',762),array(['location_id'][0],'!=',16),array(['location_id'][0],'!=',2013),array(['location_id'][0],'!=',5),array(['location_id'][0],'!=',4),array(['location_id'][0],'!=',14)); // Check polish notation in Odoo ( A or B ) AND ( C or D or E )  ginetai [ '&', '|', (A), (B), '|', (C), '|', (D), (E) ]    
         $uii=$models->execute_kw($db, $uid, $password,'stock.quant', 'search_read',array($query_arguments),$limitations);
//var_dump($uii);


            return view('current_stock_model')->with('model_list',$uii);


    }







        public function fetch_delivery_ready(){
            //connection strings
            $url = Config('configva.odoo.production_url');//einai ston config folder
            $db = Config('configva.odoo.production_db');//einai ston config folder
            $username = Config('configva.odoo.user');//einai ston config folder
            $password = Config('configva.odoo.pass');//einai ston config folder
            //connection strings
            $common = Ripcord::client("$url/xmlrpc/2/common");
            $uid = $common->authenticate($db, $username, $password, array());
            $models = Ripcord::client("$url/xmlrpc/2/object");
            $query_arguments=array(array('invoice_status', '=', 'to invoice'));// Check polish notation in Odoo ( A or B ) AND ( C or D or E )  ginetai [ '&', '|', (A), (B), '|', (C), '|', (D), (E) ] 
            //$limitations=array('fields'=>array('in_date','lot_id','location_id','tracking','inventory_quantity','quantity','reserved_quantity','product_id','product_uom_id','display_name','create_uid','product_tmpl_id')) ;
            $uii=$models->execute_kw($db, $uid, $password, 'sale.order', 'search_read', array($query_arguments));//telos execute_kw
            return view('delivery_ready')->with('uii',$uii);

        }

        public function fetch_dealer_list(){

            $url = Config('configva.odoo.production_url');//einai ston config folder
            $db = Config('configva.odoo.production_db');//einai ston config folder
            $username = Config('configva.odoo.user');//einai ston config folder
            $password = Config('configva.odoo.pass');//einai ston config folder
            //connection strings
            $common = Ripcord::client("$url/xmlrpc/2/common");
            $uid = $common->authenticate($db, $username, $password, array());
            $models = Ripcord::client("$url/xmlrpc/2/object");
            $query_arguments=array('&', array('customer_rank', '>', 0), array('is_company', '=', True));// Check polish notation in Odoo ( A or B ) AND ( C or D or E )  ginetai [ '&', '|', (A), (B), '|', (C), '|', (D), (E) ] 
            //$limitations=array('fields'=>array('in_date','lot_id','location_id','tracking','inventory_quantity','quantity','reserved_quantity','product_id','product_uom_id','display_name','create_uid','product_tmpl_id')) ;
            $limitations=array('fields'=>array( 'display_name','id','total_due','total_invoiced','sale_order_count','purchase_order_count'));  // Array of wanted fields True, False   
            $uii=$models->execute_kw($db, $uid, $password, 'res.partner', 'search_read', array($query_arguments),$limitations);//telos execute_kw
            $totalvaluesnl=DB::select(DB::raw('select dealerid,sum(invoicevalue) as invoicevalue_total from snelstart_inv_clients group by dealerid;'));//DB::table('snelstart_inv_clients')->groupBy('dealerid');
           //dd($totalvaluesnl);//->where('dealerid','=',$dealerid)->sum('invoicevalue');

            $totalvaluesnl=$this->make_raw_db_result_array($totalvaluesnl);
            //dd($totalvaluesnl);
            return view('dealer_list')->with('uii',$uii)->with('totalvaluesnl',$totalvaluesnl);

        }






        public function fetch_bulk_dealer_mail_list(){

            $url = Config('configva.odoo.production_url');//einai ston config folder
            $db = Config('configva.odoo.production_db');//einai ston config folder
            $username = Config('configva.odoo.user');//einai ston config folder
            $password = Config('configva.odoo.pass');//einai ston config folder
            //connection strings
            $common = Ripcord::client("$url/xmlrpc/2/common");
            $uid = $common->authenticate($db, $username, $password, array());
            $models = Ripcord::client("$url/xmlrpc/2/object");
            //$query_arguments=array(array('name', '!=', ''));// Check polish notation in Odoo ( A or B ) AND ( C or D or E )  ginetai [ '&', '|', (A), (B), '|', (C), '|', (D), (E) ] 
            //$limitations=array('fields'=>array('in_date','lot_id','location_id','tracking','inventory_quantity','quantity','reserved_quantity','product_id','product_uom_id','display_name','create_uid','product_tmpl_id')) ;
            $limitations=array('fields'=>array( 'lot_stock_id','x_mail'));  // Array of wanted fields True, False   
            //$uii=$models->execute_kw($db, $uid, $password, 'stock.warehouse', 'search_read', array($query_arguments),$limitations);//telos execute_kw
            $uii=$models->execute_kw($db, $uid, $password, 'stock.warehouse', 'search_read', array(),$limitations);//telos execute_kw
            $txt_to_copy="";

           $locations_with_consignements=$this->consignments();

           //dd($locations_with_consignements);
            foreach ($uii as $result) {
                if(array_search($result['lot_stock_id'][1], $locations_with_consignements)){
                if (str_contains($result['x_mail'], "@") & !str_contains($result['x_mail'], "molcargo") & !str_contains($result['x_mail'], "trade-traffic")) {
                    $txt_to_copy.=$result['x_mail'].';';
                }
            }
            }

            $txt_to_copy=str_replace(" ","",$txt_to_copy);

//dd( $txt_to_copy);



            

























            //dd($txt_to_copy);

            return view('bulk_contact')->with('txt_to_copy',$txt_to_copy);

        }












public function consignments()//epistrefei mia lista me ta locations poy yparxoyn consignements
{

    $url = Config('configva.odoo.production_url');//einai ston config folder
    $db = Config('configva.odoo.production_db');//einai ston config folder
    $username = Config('configva.odoo.user');//einai ston config folder
    $password = Config('configva.odoo.pass');//einai ston config folder
    //connection strings
    $common = Ripcord::client("$url/xmlrpc/2/common");
    $uid = $common->authenticate($db, $username, $password, array());
    $models = Ripcord::client("$url/xmlrpc/2/object");
           //consignments
           $query_arguments=array('&',array('lot_id','!=',False),array('location_id.usage','=','internal'));  
           $limitations=array('fields'=>array('product_tmpl_id','display_name','lot_id','location_id','create_date'));  // Array of wanted fields True, False
           $consignment_list=$models->execute_kw($db, $uid, $password,'stock.quant', 'search_read',array($query_arguments),$limitations);
           //consignments

           $consignment_locations=array();
$i=0;

           foreach ($consignment_list as $result) {
            $consignment_locations[$i]=$result['location_id'][1];
            $i=$i+1;
        }


return  array_unique($consignment_locations);
    
}




















        public function revenue_target(Request $request){
            $year=intval($request->year);
            //$year='2021';
            $initdate = Carbon::createFromFormat('Y-m-d', $year.'-01-01');
      
            $url = Config('configva.odoo.production_url');//einai ston config folder
            $db = Config('configva.odoo.production_db');//einai ston config folder
            $username = Config('configva.odoo.user');//einai ston config folder
            $password = Config('configva.odoo.pass');//einai ston config folder
            //connection strings
            $common = Ripcord::client("$url/xmlrpc/2/common");
            $uid = $common->authenticate($db, $username, $password, array());
            $models = Ripcord::client("$url/xmlrpc/2/object");
           

            $datefrom =  $initdate->format('Y-m-d');
            $dateto =  $initdate->addYear(1)->format('Y-m-d');


            
            $query_arguments=array('&', '&', '|',array('type', '=', 'out_invoice'),array('type', '=', 'out_refund'), array('invoice_date','>=',$datefrom), array('invoice_date','<',$dateto));// Check polish notation in Odoo ( A or B ) AND ( C or D or E )  ginetai [ '&', '|', (A), (B), '|', (C), '|', (D), (E) ] 
            $limitations=array('fields'=>array( 'amount_untaxed_signed','invoice_date'));  // Array of wanted fields True, False   
            $uii=$models->execute_kw($db, $uid, $password, 'account.move', 'search_read', array($query_arguments),$limitations);//telos execute_kw
      
            $total=0;
            $totalpermonth[1]=0;
            $totalpermonth[2]=0;
            $totalpermonth[3]=0;
            $totalpermonth[4]=0;
            $totalpermonth[5]=0;
            $totalpermonth[6]=0;
            $totalpermonth[7]=0;
            $totalpermonth[8]=0;
            $totalpermonth[9]=0;
            $totalpermonth[10]=0;
            $totalpermonth[11]=0;
            $totalpermonth[12]=0;



            $totalrevenueall=0;


                foreach ($uii as $ammount) {
$invoicedmonth=Carbon::createFromFormat('Y-m-d', $ammount['invoice_date'])->month;
$total=$ammount['amount_untaxed_signed'];
$totalrevenueall+=$total;


                    switch ($invoicedmonth) {
                        case 1:
                            $totalpermonth[1]+=$total; 
                         break;
                         case 2:
                            $totalpermonth[2]+=$total; 
                         break;
                         case 3:
                             $totalpermonth[3]+=$total; 
                         break;
                         case 4:
                            $totalpermonth[4]+=$total; 
                         break;
                         case 5:
                            $totalpermonth[5]+=$total; 
                         break;
                         case 6:
                             $totalpermonth[6]+=$total; 
                         break;                   
                         case 7:
                            $totalpermonth[7]+=$total; 
                         break;
                         case 8:
                            $totalpermonth[8]+=$total; 
                         break;
                         case 9:
                             $totalpermonth[9]+=$total; 
                         break;
                         case 10:
                            $totalpermonth[10]+=$total; 
                         break;
                         case 11:
                            $totalpermonth[11]+=$total; 
                         break;
                         case 12:
                             $totalpermonth[12]+=$total; 
                         break;                      
                            }
                }
  

$revenue= $totalpermonth;







$totaltarget=DB::table('sale_target')->where('year','=',$year)->get()->toArray();

$total=0;
$totalpermonthtarget[1]=0;
$totalpermonthtarget[2]=0;
$totalpermonthtarget[3]=0;
$totalpermonthtarget[4]=0;
$totalpermonthtarget[5]=0;
$totalpermonthtarget[6]=0;
$totalpermonthtarget[7]=0;
$totalpermonthtarget[8]=0;
$totalpermonthtarget[9]=0;
$totalpermonthtarget[10]=0;
$totalpermonthtarget[11]=0;
$totalpermonthtarget[12]=0;

$totaltargetall=0;
foreach ($totaltarget as $targetammount) {
    $total=$targetammount->sale_euro;
    $totaltargetall+=$total;
 
    
                        switch ( intval($targetammount->month)) {
                            case 1:
                                $totalpermonthtarget[1]+=$total; 
                             break;
                             case 2:
                                $totalpermonthtarget[2]+=$total; 
                             break;
                             case 3:
                                 $totalpermonthtarget[3]+=$total; 
                             break;
                             case 4:
                                $totalpermonthtarget[4]+=$total; 
                             break;
                             case 5:
                                $totalpermonthtarget[5]+=$total; 
                             break;
                             case 6:
                                 $totalpermonthtarget[6]+=$total; 
                             break;                   
                             case 7:
                                $totalpermonthtarget[7]+=$total; 
                             break;
                             case 8:
                                $totalpermonthtarget[8]+=$total; 
                             break;
                             case 9:
                                 $totalpermonthtarget[9]+=$total; 
                             break;
                             case 10:
                                $totalpermonthtarget[10]+=$total; 
                             break;
                             case 11:
                                $totalpermonthtarget[11]+=$total; 
                             break;
                             case 12:
                                 $totalpermonthtarget[12]+=$total; 
                             break;                      
                                }
                    }

                    
                   
                 
for ($i = 1; $i <= 12; $i++){

    if(count($totalpermonthtarget)>=$i and count($totalpermonth)>=$i and $totalpermonthtarget[$i]==0){
    $percentage[$i]= 0;
    }else
    {
        $percentage[$i]= 100*($totalpermonth[$i]-$totalpermonthtarget[$i])/$totalpermonthtarget[$i];

    }
}

            return view('revenue_target')->with('revenue', $revenue)->with('totaltargetall', $totaltargetall)->with('totalrevenueall', $totalrevenueall)->with('selected_year', $year)->with('totalpermonthtarget', $totalpermonthtarget)->with('percentage', $percentage);
            
        }




        public function units_target(Request $request){
            $year=intval($request->year);
            $month=intval($request->month);
            //$year='2021';
            $initdate = Carbon::createFromFormat('Y-m-d', $year.'-'.$month.'-01');
      
            $url = Config('configva.odoo.production_url');//einai ston config folder
            $db = Config('configva.odoo.production_db');//einai ston config folder
            $username = Config('configva.odoo.user');//einai ston config folder
            $password = Config('configva.odoo.pass');//einai ston config folder
            //connection strings
            $common = Ripcord::client("$url/xmlrpc/2/common");
            $uid = $common->authenticate($db, $username, $password, array());
            $models = Ripcord::client("$url/xmlrpc/2/object");
           

            $datefrom =  $initdate->format('Y-m-d');
            $dateto =  $initdate->addMonth(1)->format('Y-m-d');
            //dd($dateto);
          
            $query_arguments=array( '&','&','&',array('invoice_status', '!=', 'no'),array('categ_id', 'ilike', 'Motorcycles'),array('date', '>=', $datefrom),array('date', '<', $dateto));// Check polish notation in Odoo ( A or B ) AND ( C or D or E )  ginetai [ '&', '|', (A), (B), '|', (C), '|', (D), (E) ] 
            //$query_arguments=array( '&',array('categ_id', 'ilike', 'Motorcycles'),array(['product_tmpl_id'][0], '=', 99));// Check polish notation in Odoo ( A or B ) AND ( C or D or E )  ginetai [ '&', '|', (A), (B), '|', (C), '|', (D), (E) ] 
     
            $limitations=array('fields'=>array( 'product_tmpl_id','invoice_status','name','product_uom_qty','qty_invoiced','qty_delivered','name','categ_id','date','untaxed_amount_invoiced'));  // Array of wanted fields True, False   
            $uii=$models->execute_kw($db, $uid, $password, 'sale.report', 'search_read', array($query_arguments),$limitations);//telos execute_kw
    





/*   ******Gia na emfanisei pinaka me categories kai id******

377 => "F3"
373 => "e-Legance"
395 => "iLark"
374 => "Cit-e"
397 => "iTank"
372 => "e-Rex"
352 => "Volty"
399 => "Tremor"
392 => "2Fast"
375 => "Drag-e"
388 => "E3"
396 => "iTango"
393 => "Pride"
378 => "F7"
376 => "e-Viball"
394 => "Trimo"






     $model_table=array();
     foreach($uii as $result){
        $category_full_name=$result['categ_id'][1];
        $category_id=$result['categ_id'][0];
        $category_name_potition=strrpos($category_full_name," / ")+3;
        $category_name=substr($category_full_name,$category_name_potition);
        $model_table[$category_id]=$category_name;

   
     }

    dd(array_unique($model_table));
           
*/


         


            $target_sales = DB::table('sales_unit_target') //pinakas me antistoixisi bi me odoo id edo den ginetai na ginei merge me ta targets
            ->where('month', '=', $month )
            ->where('year', '=', $year )
            ->get()->toArray();


            $sales_odoo_models_id=array();



//dd($target_sales);

 
//print_r($uii);
 

foreach($uii as $result){
    $category_full_name=$result['categ_id'][1];
    $category_id=$result['categ_id'][0];
    $category_name_potition=strrpos($category_full_name," / ")+3;
    $category_name=substr($category_full_name,$category_name_potition);

    //$modeltmplid= $result['product_tmpl_id'][0];
   // $modeltmplname= $result['product_tmpl_id'][1];
//if($modeltmplid==""){echo 'keno';}
    //dd($this->search_object($bi_odoo_prod_binds, 'odoo_id', $modeltmplid));
   
    $categ_id1=$this->search_multidim($sales_odoo_models_id,'categ_id', $category_id);
//echo  $categ_id1.'<br>';
    if ($categ_id1!=false or $categ_id1===0)  //($categ_id1) ena apo ta pio epimona troubleshooting, edo otan epestrefe 0 to theoroyse os 0 kai eftiaxne kainourgia grammi
    {
        
       $position= $categ_id1;//array_search($modelbiid,$sales_odoo_models_id);
        $sales_odoo_models_id[$position]['real_invoiced']=$sales_odoo_models_id[$position]['real_invoiced']+$result['qty_invoiced'];
        $sales_odoo_models_id[$position]['delivered']=$sales_odoo_models_id[$position]['delivered']+$result['qty_delivered'];
        $sales_odoo_models_id[$position]['in_so']=$sales_odoo_models_id[$position]['in_so']+$result['product_uom_qty'];
        $sales_odoo_models_id[$position]['untaxed_amount_invoiced']=$sales_odoo_models_id[$position]['untaxed_amount_invoiced']+$result['untaxed_amount_invoiced'];
        $sales_odoo_models_id[$position]['so_name'] = ($result['product_uom_qty'] > 0 and !str_contains($sales_odoo_models_id[$position]['so_name'],$result['name']))? $sales_odoo_models_id[$position]['so_name'].$result['name']."," : $sales_odoo_models_id[$position]['so_name'];
       
  }
    else
    {
        $manual_input_obj= $this->search_object($target_sales, 'categ_id', $category_id);
        if($manual_input_obj===false) {
       $target_units= 0;
       $wholesale_price= 0;
        }else

        {
            
            $target_units= $manual_input_obj->total_units_month;
            $wholesale_price= $manual_input_obj->wholesale_price;

        }

        $so_name= $result['product_uom_qty'] > 0 ? $result['name']."," : "";

        array_push($sales_odoo_models_id,
        array(   
            'categ_id' => $category_id,
            'bi_name' => $category_name,
            'target'=> $target_units,
            'wholesale_price'=>  $wholesale_price,
            'in_so'=>$result['product_uom_qty'],
            'delivered'=>$result['qty_delivered'],
            'real_invoiced'=>$result['qty_invoiced'],
            'untaxed_amount_invoiced'=>$result['untaxed_amount_invoiced'],
            'so_name'=> $so_name,//$result['name'].",",
            'percentage'=>0
        ));   
          
           
    }

 //print_r($sales_odoo_models_id);

}
//dd($sales_odoo_models_id);
$month_name= date('F', mktime(0, 0, 0, $month, 10)); 
return  view('units_target')->with('sales_odoo_models_id', $sales_odoo_models_id)->with('selected_year', $year)->with('selected_month', $month)->with('selected_month_name', $month_name);
    
}

public function search_multidim($pinakas, $field, $value)
{
    if (empty($pinakas)) {
        return false;
    }
   foreach($pinakas as $key => $row)
   {
      if ( $row[$field] === $value )
         return $key;
   }
   return false;
}




public function search_object($obj, $field, $value)
{
    if (empty($obj)) {
        return false;
    }
    foreach($obj as $item) 
    {
       if ($value===$item->$field)
       {
        return $item;
                 
       }
      
    }
   return false;
}







public function make_raw_db_result_array($result_raw)
{

    $result_array=array();
   
    foreach ($result_raw as $object_change) {
        $object_array=(array) $object_change;
        array_push($result_array,$object_array);

    }

    foreach ($result_array as $result) {
        $final_array[$result['dealerid']]=$result['invoicevalue_total'];

    }






return  $final_array;
    
}













        public function fetch_current_dealer(Request $request){
           
            $dealerid = intval($request->id);
            $url = Config('configva.odoo.production_url');//einai ston config folder
            $db = Config('configva.odoo.production_db');//einai ston config folder
            $username = Config('configva.odoo.user');//einai ston config folder
            $password = Config('configva.odoo.pass');//einai ston config folder
            $common = Ripcord::client("$url/xmlrpc/2/common");
            $uid = $common->authenticate($db, $username, $password, array());
            $models = Ripcord::client("$url/xmlrpc/2/object");
            $query_arguments=array(array('id', '=', $dealerid));
            $uii=$models->execute_kw($db, $uid, $password,'res.partner', 'search_read',array($query_arguments));
           
            foreach($uii as $result){
                $dealer_name=$result['display_name'];

            }
          
           //consignments
           $query_arguments=array('&','&',array(['location_id'][0],'like','%'. $dealer_name.'%'),array('lot_id','!=',False),array('location_id.usage','=','internal'));  
           $limitations=array('fields'=>array('product_tmpl_id','display_name','lot_id','location_id','create_date'));  // Array of wanted fields True, False
           $consignment_list=$models->execute_kw($db, $uid, $password,'stock.quant', 'search_read',array($query_arguments),$limitations);
           //consignments
           
        
            //invoices INV
            $query_arguments=array('&','&',array('partner_id','=',$dealerid),array('invoice_date','!=',False),array('state', '=', 'posted'));  
           $limitations=array('fields'=>array('name','amount_untaxed_signed','invoice_date'));  // Array of wanted fields True, False
            $invoices_list=$models->execute_kw($db, $uid, $password,'account.move', 'search_read',array($query_arguments),$limitations);
           
       $total_inv=0;
      $total_rinv=0;
      $total_bill=0;
      foreach($invoices_list as $invoice){
            if (str_contains($invoice['name'], 'INV')){
                $total_inv+=$invoice['amount_untaxed_signed'];
                    }
            if (str_contains($invoice['name'], 'RINV')){
            $total_rinv+=$invoice['amount_untaxed_signed'];
                    }
             if (str_contains($invoice['name'], 'BIL')){
             $total_bill+=$invoice['amount_untaxed_signed'];
                    }
    }
           
           
   //invoices INV        
           
       
            //Sale Report
            $query_arguments=array('&',array('partner_id','=',$dealerid),array('product_tmpl_id.tracking','=','serial'));  
          $limitations=array('fields'=>array('product_tmpl_id','name','display_name'));  // Array of wanted fields True, False
            $sales_list=$models->execute_kw($db, $uid, $password,'sale.report', 'search_read',array($query_arguments), $limitations);
          

       
           $per_model_sold_qty_ass=array();
           foreach($sales_list as $moto_sold){
               if (array_key_exists($moto_sold['product_tmpl_id'][1], $per_model_sold_qty_ass)){
            $per_model_sold_qty_ass[$moto_sold['product_tmpl_id'][1]]+=1;
                }
                else {
                    $per_model_sold_qty_ass[$moto_sold['product_tmpl_id'][1]]=1;
                }
               
           }
           arsort($per_model_sold_qty_ass);
          
           $per_model_sold_qty=array();

           $i=0;
           foreach($per_model_sold_qty_ass as $x => $x_value) {
            $per_model_sold_qty[$i]['name']= $x;
            $per_model_sold_qty[$i]['qty']=$x_value;
            $i+=1;
          }

 //Sale Report


//Back orders
 
$query_arguments=array('&' , array('state', '=', 'confirmed'),array('product_tmpl_id.tracking','=','serial'),array('partner_id','=',$dealerid ));// Check polish notation in Odoo ( A or B ) AND ( C or D or E )  ginetai [ '&', '|', (A), (B), '|', (C), '|', (D), (E) ] 
//$limitations=array('fields'=>array('in_date','lot_id','location_id','tracking','inventory_quantity','quantity','reserved_quantity','product_id','product_uom_id','display_name','create_uid','product_tmpl_id')) ;
$bo_list=$models->execute_kw($db, $uid, $password, 'stock.move', 'search_read', array($query_arguments));



//Back orders








 $totalvaluesnl=DB::table('snelstart_inv_clients')->where('dealerid','=',$dealerid)->sum('invoicevalue');


 
            return view('current_dealer')->with('bo_list',$bo_list)->with('currentdealerid',$dealerid)->with('totalvaluesnl',$totalvaluesnl)->with('dealerid',$dealerid)->with('dealer_data',$uii)->with('consignment_list',$consignment_list)->with('invoices_list',$invoices_list)->with('sales_list',$sales_list)->with('per_model_sold_qty',$per_model_sold_qty)->with('total_inv',$total_inv)->with('total_bill',$total_bill)->with('total_inv',$total_inv)->with('total_rinv',$total_rinv)->with('total_bill',$total_bill);


    }


















    public function fetch_current_dealer_refresh(Request $request){
           
        $dealerid = intval($request->input('dealerid'));
        $invstart = $request->input('start');
        $invend = $request->input('end');


        $url = Config('configva.odoo.production_url');//einai ston config folder
        $db = Config('configva.odoo.production_db');//einai ston config folder
        $username = Config('configva.odoo.user');//einai ston config folder
        $password = Config('configva.odoo.pass');//einai ston config folder
        $common = Ripcord::client("$url/xmlrpc/2/common");
        $uid = $common->authenticate($db, $username, $password, array());
        $models = Ripcord::client("$url/xmlrpc/2/object");
        $query_arguments=array(array('id', '=', $dealerid));
        $uii=$models->execute_kw($db, $uid, $password,'res.partner', 'search_read',array($query_arguments));
       
        foreach($uii as $result){
            $dealer_name=$result['display_name'];

        }
      
       //consignments
       $query_arguments=array('&','&',array(['location_id'][0],'like','%'. $dealer_name.'%'),array('lot_id','!=',False),array('location_id.usage','=','internal'));  
       $limitations=array('fields'=>array('product_tmpl_id','display_name','lot_id','location_id','create_date'));  // Array of wanted fields True, False
       $consignment_list=$models->execute_kw($db, $uid, $password,'stock.quant', 'search_read',array($query_arguments),$limitations);
       //consignments
       
    
        //invoices INV
        $query_arguments=array('&','&',array('partner_id','=',$dealerid),array('invoice_date','!=',False),array('invoice_date','<',$invend),array('invoice_date','>',$invstart),array('state', '=', 'posted'));  
       $limitations=array('fields'=>array('name','amount_untaxed_signed','invoice_date'));  // Array of wanted fields True, False
        $invoices_list=$models->execute_kw($db, $uid, $password,'account.move', 'search_read',array($query_arguments),$limitations);
        //dd($invoices_list);  
   $total_inv=0;
  $total_rinv=0;
  $total_bill=0;
  foreach($invoices_list as $invoice){
        if (str_contains($invoice['name'], 'INV')){
            $total_inv+=$invoice['amount_untaxed_signed'];
                }
        if (str_contains($invoice['name'], 'RINV')){
        $total_rinv+=$invoice['amount_untaxed_signed'];
                }
         if (str_contains($invoice['name'], 'BIL')){
         $total_bill+=$invoice['amount_untaxed_signed'];
                }
}


//invoices INV        
       
   
        //Sale Report
        $query_arguments=array('&',array('partner_id','=',$dealerid),array('product_tmpl_id.tracking','=','serial'),array('date','<',$invend),array('date','>',$invstart));  
      $limitations=array('fields'=>array('product_tmpl_id','name','display_name'));  // Array of wanted fields True, False
        $sales_list=$models->execute_kw($db, $uid, $password,'sale.report', 'search_read',array($query_arguments), $limitations);
      

   
       $per_model_sold_qty_ass=array();
       foreach($sales_list as $moto_sold){
           if (array_key_exists($moto_sold['product_tmpl_id'][1], $per_model_sold_qty_ass)){
        $per_model_sold_qty_ass[$moto_sold['product_tmpl_id'][1]]+=1;
            }
            else {
                $per_model_sold_qty_ass[$moto_sold['product_tmpl_id'][1]]=1;
            }
           
       }

       arsort($per_model_sold_qty_ass);
       $per_model_sold_qty=array();

       $i=0;
       foreach($per_model_sold_qty_ass as $x => $x_value) {
        $per_model_sold_qty[$i]['name']= $x;
        $per_model_sold_qty[$i]['qty']=$x_value;
        $i+=1;
      }

//Sale Report






//Back orders
 
 $query_arguments=array('&' , array('state', '=', 'confirmed'),array('product_tmpl_id.tracking','=','serial'),array('partner_id','=',$dealerid ));// Check polish notation in Odoo ( A or B ) AND ( C or D or E )  ginetai [ '&', '|', (A), (B), '|', (C), '|', (D), (E) ] 
 //$limitations=array('fields'=>array('in_date','lot_id','location_id','tracking','inventory_quantity','quantity','reserved_quantity','product_id','product_uom_id','display_name','create_uid','product_tmpl_id')) ;
 $bo_list=$models->execute_kw($db, $uid, $password, 'stock.move', 'search_read', array($query_arguments));



//Back orders







$totalvaluesnl=DB::table('snelstart_inv_clients')->where('dealerid','=',$dealerid)->sum('invoicevalue');


 











       
        return view('current_dealer')->with('bo_list',$bo_list)->with('currentdealerid',$dealerid)->with('dealerid',$dealerid)->with('totalvaluesnl',$totalvaluesnl)->with('dealer_data',$uii)->with('consignment_list',$consignment_list)->with('invoices_list',$invoices_list)->with('sales_list',$sales_list)->with('per_model_sold_qty',$per_model_sold_qty)->with('total_inv',$total_inv)->with('total_bill',$total_bill)->with('total_inv',$total_inv)->with('total_rinv',$total_rinv)->with('total_bill',$total_bill);


}

public function fetch_current_dealer_snelstart(Request $request){

$dealerid = intval($request->input('id'));
    $old_inv=DB::table('snelstart_inv_clients')->where('dealerid','=',$dealerid)->get();//->where('dealerid','=',$dealerid)->sum('invoicevalue');


    return view('snelstart_old_invoices')->with('old_inv',$old_inv);



}















        
        public function fetch_quotations_pending(){
            //connection strings
            $url = Config('configva.odoo.production_url');//einai ston config folder
            $db = Config('configva.odoo.production_db');//einai ston config folder
            $username = Config('configva.odoo.user');//einai ston config folder
            $password = Config('configva.odoo.pass');//einai ston config folder
            //test
        
            //connection strings
            $common = Ripcord::client("$url/xmlrpc/2/common");
            $uid = $common->authenticate($db, $username, $password, array());
            $models = Ripcord::client("$url/xmlrpc/2/object");
            $query_arguments=array(array('state', '=', 'draft'));// Check polish notation in Odoo ( A or B ) AND ( C or D or E )  ginetai [ '&', '|', (A), (B), '|', (C), '|', (D), (E) ] 
            //$limitations=array('fields'=>array('in_date','lot_id','location_id','tracking','inventory_quantity','quantity','reserved_quantity','product_id','product_uom_id','display_name','create_uid','product_tmpl_id')) ;
            $uii=$models->execute_kw($db, $uid, $password, 'sale.order', 'search_read', array($query_arguments));//telos execute_kw
            return view('quotations_pending')->with('uii',$uii);

        }




        public function fetch_speedversion_change(){
            //connection strings
            $url = Config('configva.odoo.production_url');//einai ston config folder
            $db = Config('configva.odoo.production_db');//einai ston config folder
            $username = Config('configva.odoo.user');//einai ston config folder
            $password = Config('configva.odoo.pass');//einai ston config folder
            //connection strings
            $common = Ripcord::client("$url/xmlrpc/2/common");
            $uid = $common->authenticate($db, $username, $password, array());
            $models = Ripcord::client("$url/xmlrpc/2/object");
            $query_arguments=array('&',array('serial_no','=',False),array('state', '=', 'sale'));// Check polish notation in Odoo ( A or B ) AND ( C or D or E )  ginetai [ '&', '|', (A), (B), '|', (C), '|', (D), (E) ] 
            //$limitations=array('fields'=>array('in_date','lot_id','location_id','tracking','inventory_quantity','quantity','reserved_quantity','product_id','product_uom_id','display_name','create_uid','product_tmpl_id')) ;
            $uii=$models->execute_kw($db, $uid, $password, 'sale.order.line', 'search_read', array($query_arguments));//telos execute_kw
            return view('speedversion_change')->with('uii',$uii);

        }


        public function fetch_simple_preparation(){
            //connection strings
            $url = Config('configva.odoo.production_url');//einai ston config folder
            $db = Config('configva.odoo.production_db');//einai ston config folder
            $username = Config('configva.odoo.user');//einai ston config folder
            $password = Config('configva.odoo.pass');//einai ston config folder
            //connection strings
            $common = Ripcord::client("$url/xmlrpc/2/common");
            $uid = $common->authenticate($db, $username, $password, array());
            $models = Ripcord::client("$url/xmlrpc/2/object");
            $query_arguments=array('&',array('serial_no','!=',False),array('state', '=', 'sale'));// Check polish notation in Odoo ( A or B ) AND ( C or D or E )  ginetai [ '&', '|', (A), (B), '|', (C), '|', (D), (E) ] 
            //$limitations=array('fields'=>array('in_date','lot_id','location_id','tracking','inventory_quantity','quantity','reserved_quantity','product_id','product_uom_id','display_name','create_uid','product_tmpl_id')) ;
            $uii=$models->execute_kw($db, $uid, $password, 'sale.order.line', 'search_read', array($query_arguments));//telos execute_kw
            return view('simple_preparation')->with('uii',$uii);

        }




        public function fetch_sold(){
            //connection strings
            $url = Config('configva.odoo.production_url');//einai ston config folder
            $db = Config('configva.odoo.production_db');//einai ston config folder
            $username = Config('configva.odoo.user');//einai ston config folder
            $password = Config('configva.odoo.pass');//einai ston config folder
            //connection strings
            $common = Ripcord::client("$url/xmlrpc/2/common");
            $uid = $common->authenticate($db, $username, $password, array());
            $models = Ripcord::client("$url/xmlrpc/2/object");
            $query_arguments=array(array(['location_id'][0],'=',5));// Check polish notation in Odoo ( A or B ) AND ( C or D or E )  ginetai [ '&', '|', (A), (B), '|', (C), '|', (D), (E) ] 
            //$limitations=array('fields'=>array('in_date','lot_id','location_id','tracking','inventory_quantity','quantity','reserved_quantity','product_id','product_uom_id','display_name','create_uid','product_tmpl_id')) ;
            $uii=$models->execute_kw($db, $uid, $password, 'stock.quant', 'search_read', array($query_arguments));//telos execute_kw
            $modelcount=array();
            foreach($uii as $result)
            {
                $modelochk=$result['product_tmpl_id'][1];
                $chkthesi=$this->searchmodelname($modelcount,$modelochk);
                $serialne=$result['lot_id'][1];

                if ($serialne!=''):
                    if ($chkthesi==-1):
                                $pushtobe=['name'=>$modelochk, 'sold'=> 1];
                                array_push($modelcount, $pushtobe);
                            
                            
                    else:
                            
                                $modelcount[$chkthesi]["sold"]++;
                            
                    endif;
                endif;

            }

                      
            
            return view('sold')->with('modelcount',$modelcount);

        }



        public function fetch_who_reserved_what(){
            //connection strings
            $url = Config('configva.odoo.production_url');//einai ston config folder
            $db = Config('configva.odoo.production_db');//einai ston config folder
            $username = Config('configva.odoo.user');//einai ston config folder
            $password = Config('configva.odoo.pass');//einai ston config folder
            //connection strings
            $common = Ripcord::client("$url/xmlrpc/2/common");
            $uid = $common->authenticate($db, $username, $password, array());
            $models = Ripcord::client("$url/xmlrpc/2/object");
            //$query_arguments=array('&' , array('state', '=', 'confirmed'),array('product_tmpl_id.tracking','=','serial'));// Check polish notation in Odoo ( A or B ) AND ( C or D or E )  ginetai [ '&', '|', (A), (B), '|', (C), '|', (D), (E) ] 
           $query_arguments=array('&' ,'&' ,array('picking_code','=','outgoing'), array('state','in',array('assigned','partially_available')),array('product_tmpl_id.tracking','=','serial'));// Check polish notation in Odoo ( A or B ) AND ( C or D or E )  ginetai [ '&', '|', (A), (B), '|', (C), '|', (D), (E) ] 
           //'&' ,array('picking_code','=','outgoing'),
           // $query_arguments=array('&',array('picking_type_code','=','outgoing'),array('state','in',array('assigned','partially_available')));
           //$query_arguments=array('picking_code','=','outgoing');
           
           //picking_code
           
           //$limitations=array('fields'=>array('in_date','lot_id','location_id','tracking','inventory_quantity','quantity','reserved_quantity','product_id','product_uom_id','display_name','create_uid','product_tmpl_id')) ;
            $uii=$models->execute_kw($db, $uid, $password, 'stock.move', 'search_read', array($query_arguments));
           //var_dump($uii);


            return view('who_reserved_what')->with('uii',$uii);
            
        }


        public function fetch_who_demands_what(){
            //connection strings
            $url = Config('configva.odoo.production_url');//einai ston config folder
            $db = Config('configva.odoo.production_db');//einai ston config folder
            $username = Config('configva.odoo.user');//einai ston config folder
            $password = Config('configva.odoo.pass');//einai ston config folder
            //connection strings
            $common = Ripcord::client("$url/xmlrpc/2/common");
            $uid = $common->authenticate($db, $username, $password, array());
            $models = Ripcord::client("$url/xmlrpc/2/object");
            $query_arguments=array('&' , array('state', '=', 'confirmed'),array('product_tmpl_id.tracking','=','serial'));// Check polish notation in Odoo ( A or B ) AND ( C or D or E )  ginetai [ '&', '|', (A), (B), '|', (C), '|', (D), (E) ] 
           //$query_arguments=array('&' ,'&' ,array('picking_code','=','outgoing'), array('state','in',array('assigned','partially_available')),array('product_tmpl_id.tracking','=','serial'));// Check polish notation in Odoo ( A or B ) AND ( C or D or E )  ginetai [ '&', '|', (A), (B), '|', (C), '|', (D), (E) ] 
           //'&' ,array('picking_code','=','outgoing'),
           // $query_arguments=array('&',array('picking_type_code','=','outgoing'),array('state','in',array('assigned','partially_available')));
           //$query_arguments=array('picking_code','=','outgoing');
           
           //picking_code
           
           //$limitations=array('fields'=>array('in_date','lot_id','location_id','tracking','inventory_quantity','quantity','reserved_quantity','product_id','product_uom_id','display_name','create_uid','product_tmpl_id')) ;
            $uii=$models->execute_kw($db, $uid, $password, 'stock.move', 'search_read', array($query_arguments));
           //var_dump($uii);


            return view('who_demands_what')->with('uii',$uii);
            
        }


















        public function fetch_aged_consignments_model(){
           
            $url = Config('configva.odoo.production_url');//einai ston config folder
            $db = Config('configva.odoo.production_db');//einai ston config folder
            $username = Config('configva.odoo.user');//einai ston config folder
            $password = Config('configva.odoo.pass');//einai ston config folder
             
                $common = Ripcord::client("$url/xmlrpc/2/common");
                $uid = $common->authenticate($db, $username, $password, array());
                $models = Ripcord::client("$url/xmlrpc/2/object");
                $query_arguments=array('&','&','&','&',array('location_id.usage','=','internal'),array(['location_id'][0],'!=',2075),array(['location_id'][0],'!=',2076),array(['location_id'][0],'!=',1975),array(['location_id'][0],'!=',8),array(['location_id'][0],'!=',9),array('lot_id','!=',False));
                $limitations=array('fields'=>array('product_tmpl_id','lot_id','location_id','create_date'));  // Array of wanted fields True, False
                $uii=$models->execute_kw($db, $uid, $password,'stock.quant', 'search_read',array($query_arguments),$limitations);

                $modelcount = array();
             
                
                foreach($uii as $result)
                {

                    $modeloidchk=$result['product_tmpl_id'][0];
                    $modelochk=$result['product_tmpl_id'][1];
                    $chkthesi=$this->searchmodelname($modelcount,$modelochk); //allivs tha epsaxne na brei mia global synarthsh
                    $now = time();
                    $datediff = $now - strtotime($result['create_date']);
                    $days_in_consignment =round($datediff / (86400));  //    60*60*24=86400

               
                    if ($chkthesi==-1):
                                if($days_in_consignment<=30):
                                        $pushtobe=['referenceid'=>$modeloidchk,'name'=>$modelochk, 'd1_30'=> 1,'d31_60'=> 0, 'd61_90'=> 0, 'd91_120'=> 0, 'older'=>0, 'total'=>1];
                                        array_push($modelcount, $pushtobe);
                                    elseif($days_in_consignment>30 and $days_in_consignment<=60):
                                        $pushtobe=['referenceid'=>$modeloidchk,'name'=>$modelochk, 'd1_30'=> 0,'d31_60'=> 1, 'd61_90'=> 0, 'd91_120'=> 0, 'older'=>0, 'total'=>1];
                                        array_push($modelcount, $pushtobe);
                                    elseif($days_in_consignment>60 and $days_in_consignment<=90):
                                        $pushtobe=['referenceid'=>$modeloidchk,'name'=>$modelochk, 'd1_30'=> 0,'d31_60'=> 0, 'd61_90'=> 1, 'd91_120'=> 0, 'older'=>0, 'total'=>1];
                                        array_push($modelcount, $pushtobe);
                                    elseif($days_in_consignment>90 and $days_in_consignment<=120):
                                        $pushtobe=['referenceid'=>$modeloidchk,'name'=>$modelochk, 'd1_30'=> 0,'d31_60'=> 0, 'd61_90'=> 0, 'd91_120'=> 1, 'older'=>0, 'total'=>1];
                                        array_push($modelcount, $pushtobe);
                                    elseif($days_in_consignment>120):
                                        $pushtobe=['referenceid'=>$modeloidchk,'name'=>$modelochk, 'd1_30'=> 0,'d31_60'=> 0, 'd61_90'=> 0, 'd91_120'=> 0, 'older'=>1, 'total'=>1];
                                        array_push($modelcount, $pushtobe);
                                endif;                                
                        else:
                                  if($days_in_consignment<=30):
                                    $modelcount[$chkthesi]["d1_30"]++;
                                    $modelcount[$chkthesi]["total"]++;
                                  elseif($days_in_consignment>30 and $days_in_consignment<=60):
                                    $modelcount[$chkthesi]["d31_60"]++;
                                    $modelcount[$chkthesi]["total"]++;
                                  elseif($days_in_consignment>60 and $days_in_consignment<=90):
                                    $modelcount[$chkthesi]["d61_90"]++;
                                    $modelcount[$chkthesi]["total"]++;
                                  elseif($days_in_consignment>90 and $days_in_consignment<=120):
                                    $modelcount[$chkthesi]["d91_120"]++;
                                    $modelcount[$chkthesi]["total"]++;
                                  elseif($days_in_consignment>120):
                                    $modelcount[$chkthesi]["older"]++;
                                    $modelcount[$chkthesi]["total"]++;
                                  endif;
                        endif;
             
            
                
                
                
                    
                }
                
           
                //return view('current_stock')->with('current_stock', $modelcount); 
            return view('aged_consignement_models')->with('modelcount',$modelcount);

        }













 public function fetch_aged_consign_model_cust(Request $request){
           
            $modelid = intval($request->modelid);
            $periodclass = intval($request->periodclass);
            $now = date('y:m:d');

            switch ($periodclass) {
                case 1:
                    $datemin = date('Y-m-d', strtotime($now. ' - 30 days'));
                    $datemax = date('Y-m-d', strtotime($now. ' - 0 days'));
                  break;
                case "31":
                    $datemin = date('Y-m-d', strtotime($now. ' - 60 days'));
                    $datemax = date('Y-m-d', strtotime($now. ' - 31 days'));
                  break;
                case "61":
                    $datemin = date('Y-m-d', strtotime($now. ' - 90 days'));
                    $datemax = date('Y-m-d', strtotime($now. ' - 61 days'));
                  break;
                  case "91":
                    $datemin = date('Y-m-d', strtotime($now. ' - 120 days'));
                    $datemax = date('Y-m-d', strtotime($now. ' - 91 days'));
                    break;
                    case "121":
                        $datemin = date('Y-m-d', strtotime($now. ' - 8000 days'));
                        $datemax = date('Y-m-d', strtotime($now. ' - 121 days'));
                    break;
                default:
                         $datemin = date('Y-m-d', strtotime($now. ' - 8000 days'));
                         $datemax = date('Y-m-d', strtotime($now. ' - 0 days'));
              }
















            
              $url = Config('configva.odoo.production_url');//einai ston config folder
              $db = Config('configva.odoo.production_db');//einai ston config folder
              $username = Config('configva.odoo.user');//einai ston config folder
              $password = Config('configva.odoo.pass');//einai ston config folder
         
            $common = Ripcord::client("$url/xmlrpc/2/common");
            $uid = $common->authenticate($db, $username, $password, array());
            $models = Ripcord::client("$url/xmlrpc/2/object");
           $query_arguments=array('&','&','&','&','&','&','&','&',array('location_id.usage','=','internal'),array('create_date','>=',$datemin),array('create_date','<=',$datemax),array(['location_id'][0],'!=',2075),array(['location_id'][0],'!=',2076),array(['location_id'][0],'!=',1975),array(['location_id'][0],'!=',8),array(['location_id'][0],'!=',9),array(['product_tmpl_id'][0],'=',$modelid),array('lot_id','!=',False));            $limitations=array('fields'=>array('product_tmpl_id','display_name','lot_id','location_id','create_date'));  // Array of wanted fields True, False
            $uii=$models->execute_kw($db, $uid, $password,'stock.quant', 'search_read',array($query_arguments),$limitations);



            return view('aged_consign_models_cust')->with('customers_list',$uii);


    }


































    }
