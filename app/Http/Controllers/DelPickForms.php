<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Ripcord\Ripcord;
use PhpXmlRpc\Client;
use Illuminate\Support\Facades\DB;
use App\Services\Odoocall;
use App\Http\Controllers\OdooController;
use PDF;
use App\User;
use Illuminate\Support\Facades\Storage;
use App\Mail\pickdelfinalize;
use Illuminate\Support\Facades\Mail;

class DelPickForms extends Controller
{
    




public function del_pick_show(){
    $uii=$this->fetch_dealer_list();
return view('pick_del_form')->with('uii',$uii);
}



public function del_pick_show_finished(){
    $uii=$this->fetch_pick_dels_finished();
return view('pick_del_form_finished_list')->with('uii',$uii);
}




public function del_pick_edit_show(Request $request){
    $del_pickid = intval($request->id);

//dd($del_pickid);

    $dealers=$this->fetch_dealer_list();
    $uii=DB::table('pick_dels')->where('id', '=', $del_pickid)->get()[0];
    //dd($uii->imagesignurl);
    // return json_encode($uii);
    $locations=$this->fetch_dealers_locations2($uii->dealer);
    //$signexists=file_exists($uii->id.".jpg");
    $signexists= !is_null($uii->imagesignurl);
    return view('pick_del_form_edit')->with('uii',$uii)->with('dealers',$dealers)->with('locations',$locations)->with('signexists',$signexists);

}



public function del_pick_list_show(){

    $uii=$this->fetch_pick_dels();
    //dd($t);


    return view('pick_del_form_list')->with('uii',$uii);

}






public function del_pick_create_pdf() {
    // retreive all records from db
    $data = [];
    // share data to view
    //view()->share('delpickpdf',$data);
    $pdf = PDF::loadView('delpickpdf', $data);
    // download PDF file with download method
    return $pdf->download('pdf_file.pdf');
  }






public function fetch_dealers_address(Request $request){
    $dealerid = intval($request->dealerid);
    $model = 'res.partner';
    $query_arguments=array(array('id','=',$dealerid ));
    $limitations=array('fields'=>array('street','city','zip','country_id','contact_address','phone','email'));
    $call=new Odoocall();
    $uii=$call->Odooquery($model,$query_arguments,$limitations);


//dd( $uii);




    return  response()->json(['dealers_add_return'=>$uii]);
}








public function fetch_dealers_locations(Request $request){
    $dealerid = intval($request->dealerid);
   
    $model = 'res.partner';
    $query_arguments=array('&',array('parent_id','=',$dealerid ),array('type','=','delivery'));
   
    $limitations=array('fields'=>array('street','city','zip','country_id','contact_address','phone','name','display_name'));
    $call=new Odoocall();
    $uii=$call->Odooquery($model,$query_arguments, $limitations);

  
//dd( $uii);





    return  response()->json(['dealers_loc_return'=>$uii]);
}









public function mail_finalize(Request $request){
 $del_pickid = intval($request->pickdelid);
 //dd( $del_pickid);
 $uii=DB::table('pick_dels')->where('id', '=', $del_pickid)->get()[0];

//mail
//dd( $uii);
//$uii=DB::table('pick_dels')->where('id', '=', $del_pickid)->get()[0];

$dealerid=$uii->dealer;
$dealeremail=$uii->maila;
$data=array("subjectcase"=>"");
$data['subject']= "Confirmation of delivery";
$data['dealername']= $this->fetch_dealer_name($dealerid);
//$data['attachments']= $attachments;
$data['vin']= $uii->vin;
$data['model']= $uii->model;
$data['licencenbr']= $uii->licencenbr;
$data['vehicleworks']= $uii->vehicleworks===1?"Yes":"No";
$data['keyspresent']= $uii->keyspresent===1?"Yes":"No";
$data['remotepresent']= $uii->remotepresent===1?"Yes":"No";
$data['toolkitpresent']= $uii->toolkitpresent===1?"Yes":"No";
$data['mirrorspresent']= $uii->mirrorspresent===1?"Yes":"No";
$data['casespresent']= $uii->casespresent===1?"Yes":"No";
$data['batterypresent']= $uii->batterypresent===1?"Yes":"No";
$data['chargerpresent']= $uii->chargerpresent===1?"Yes":"No";
$data['chargertested']= $uii->chargertested===1?"Yes":"No";
$data['damage']= $uii->damage===1?"Yes":"No";
$data['batterynbr']= $uii->batterynbr===1?"Yes":"No";
$data['batterytype']= $uii->batterytype===1?"Yes":"No";
$data['chargertested']= $uii->chargertested===1?"Yes":"No";
$data['chargernbr']= $uii->chargernbr;
$data['comments']= $uii->comments;
//dd($dealeremail);


$deliverydate=Carbon::now()->toDateTimeString();
$data['deliverydate']=$deliverydate;

$data['operationdescription']=$uii->pickingtype==="Delivery"?"Wij hebben zojuist een voertuig bij u geleverd ":"We hebben zojuist bij u een voertuig opgehaald ";



//$data['linkto']=url('technical_reports/toedit/');
//$data['to']='vtzimpl@yahoo.gr';
//$data['to']=$to;

//mail

   Mail::to($dealeremail)->cc(['info@trade-traffic.com'])->send(new pickdelfinalize($data));
   //Mail::to('tzimplakisv@nipponia.com')->send(new pickdelfinalize($data));
    
    DB::table('pick_dels')
    ->where('id', $del_pickid)
    ->update(['isfinalized' => 1]);

 

    return redirect('/del_pick_list');
  }











  public function pd_cancel(Request $request){
    $del_pickid = intval($request->pickdelid);

       
       DB::table('pick_dels')
       ->where('id', $del_pickid)
       ->update([
        'hide_reason' => "Canceled",
        'isfinalized' => 1
    ]);
   
    
   
       return redirect('/del_pick_list');
     }
   

     public function pd_refused(Request $request){
        $del_pickid = intval($request->pickdelid);
    
           
           DB::table('pick_dels')
           ->where('id', $del_pickid)
           ->update([
            'hide_reason' => "Refused",
            'isfinalized' => 1
        ]);
       
        
       
           return redirect('/del_pick_list');
         }



























  public function fetch_dealer_name($dealerid){
    
    $model = 'res.partner';
    $query_arguments=array(array('id','=',$dealerid ));
    $limitations=array('fields'=>array('street','city','zip','country_id','contact_address','phone','email','display_name'));
    $call=new Odoocall();
    $uii=$call->Odooquery($model,$query_arguments,$limitations);
   //dd( $uii);
    $dealername=$uii[0]['display_name'];






    return  $dealername;
}















public function fetch_details_vin(Request $request){
    $vin = $request->vin;
//dd(  $vin);
    $model = 'stock.lot';
    $query_arguments=array(array('name','=',$vin));
    $limitations=array('fields'=>array('product_id'));
    $call=new Odoocall();
    $uii=$call->Odooquery($model,$query_arguments,$limitations);
    

    return response()->json(['product_det_return'=>$uii]);
}









public function del_pick_create(Request $request){


//dd($request);


    $pickingtype=$request->pickingtype;
    $operationtype=$request->operationtype;
    $vin=$request->vin;
    $model=$request->model;
    $modeldet=$request->modeldet;
    $licencenbr=$request->licencenbr;
    $dealer=$request->dealer;
    $dealerloc=$request->dealerloc;
    $address=$request->address;
    $phone=$request->phone;
    $maila=$request->maila;
    $vehicleworks=$request->vehicleworks=='on'?1:0;
    $keyspresent=$request->keyspresent=='on'?1:0;
    $remotepresent=$request->remotepresent=='on'?1:0;
    $toolkitpresent=$request->toolkitpresent=='on'?1:0;
    $vinplatematch=$request->vinplatematch=='on'?1:0;
    $casespresent=$request->casespresent=='on'?1:0;
    $mirrorspresent=$request->mirrorspresent=='on'?1:0;
    $batterypresent=$request->batterypresent=='on'?1:0;
    $chargerpresent=$request->chargerpresent=='on'?1:0;
    $chargertested=$request->chargertested=='on'?1:0;
    $damage=$request->damage=='on'?1:0;
    $batterynbr=$request->batterynbr;
    $batterytype=$request->batterytype;
    $chargernbr=$request->chargernbr;
    $comments=$request->comments;
    $notesint=$request->notesint;
    $created_by=auth()->user()->id;
    $routingnbr=$request->routingnbr;
    $routingdate=isset($request->routingdate)?$request->routingdate:'2000-01-01';
//dd($damage);

    $insert_result=DB::insert('insert into pick_dels  
    (
     pickingtype,
     operationtype,
     vin,
     model,
     modeldet,
     licencenbr,
     dealer,
     dealerloc,
     address,
     phone,
     maila,
     vehicleworks,
     keyspresent,
     remotepresent,
     toolkitpresent,
     vinplatematch,
     casespresent,
     mirrorspresent,
     batterypresent,
     chargertested,
     damage,
     chargerpresent,
     batterynbr,
     batterytype,
     chargernbr,
     comments,
     notesint,
     created_by,
     routingnbr,
     routingdate

       ) values
    (?,?,?,?,?,
    ?,?,?,?,?,
    ?,?,?,?,?,
    ?,?,?,?,?,
    ?,?,?,?,?,?,
    ?,?,?,?
    )', 
    [''.
     $pickingtype
     .'', ''.
     $operationtype
     .'',''. 
     $vin
     .'', ''. 
     $model
     .'',''.
     $modeldet
     .'',''.
     $licencenbr
     .'',''.
     $dealer
     .'', ''.
     $dealerloc
     .'', ''.
     $address
     .'',''. 
     $phone
     .'', ''. 
     $maila
     .'', ''. 
     $vehicleworks
     .'',''.
     $keyspresent
     .'', ''.
     $remotepresent
     .'',''. 
     $toolkitpresent
     .'', ''. 
     $vinplatematch
     .'',''.
     $casespresent
     .'', ''.
     $mirrorspresent
     .'',''. 
     $batterypresent
     .'', ''. 
     $chargerpresent
     .'',''.
     $damage
     .'',''.
     $chargertested
     .'',''.
     $batterynbr
     .'',''. 
     $batterytype
     .'', ''. 
     $chargernbr
     .'', ''. 
     $comments
     .'',''.
     $notesint
     .'',''.
     $created_by
     .'', ''. 
     $routingnbr
     .'',''.
     $routingdate
    ]);
        




    $uii=$this->fetch_dealer_list();
      // dd($t);


    return view('pick_del_form')->with('uii',$uii);
}














public function del_pick_update(Request $request){


    //dd($request);

    $pickdelid=$request->pickdelid;
    $pickingtype=$request->pickingtype;
    $operationtype=$request->operationtype;
    $vin=$request->vin;
    $imagesignurl=$request->signaturesvg;
    $model=$request->model;
    $modeldet=$request->modeldet;
    $licencenbr=$request->licencenbr;
    $dealer=$request->dealer;
    $dealerloc=$request->dealerloc;
    $address=$request->address;
    $phone=$request->phone;
    $maila=$request->maila;
    $vehicleworks=$request->vehicleworks=='on'?1:0;
    $keyspresent=$request->keyspresent=='on'?1:0;
    $remotepresent=$request->remotepresent=='on'?1:0;
    $toolkitpresent=$request->toolkitpresent=='on'?1:0;
    $vinplatematch=$request->vinplatematch=='on'?1:0;
    $casespresent=$request->casespresent=='on'?1:0;
    $mirrorspresent=$request->mirrorspresent=='on'?1:0;
    $batterypresent=$request->batterypresent=='on'?1:0;
    $chargerpresent=$request->chargerpresent=='on'?1:0;
    $chargertested=$request->chargertested=='on'?1:0;
    $damage=$request->damage=='on'?1:0;
    $batterynbr=$request->batterynbr;
    $batterytype=$request->batterytype;
    $chargernbr=$request->chargernbr;
    $comments=$request->comments;
    $notesint=$request->notesint;
    $created_by=auth()->user()->id;
    $routingnbr=$request->routingnbr;
    $routingdate=$request->routingdate;
//dd($imagesignurl);
DB::table('pick_dels')
              ->where('id', $pickdelid)
              ->update([
                'pickingtype' => $pickingtype,
                'operationtype'=> $operationtype,
                'vin'=> $vin,
                'model'=> $model,
                'modeldet'=> $modeldet,
                'licencenbr'=> $licencenbr,
                'dealer'=> $dealer,
                'dealerloc'=> $dealerloc,
                'address'=> $address,
                'phone'=> $phone,
                'maila'=> $maila,
                'vehicleworks'=> $vehicleworks,
                'keyspresent'=> $keyspresent,
                'remotepresent'=> $remotepresent,
                'toolkitpresent'=> $toolkitpresent,
                'vinplatematch'=> $vinplatematch,
                'casespresent'=> $casespresent,
                'mirrorspresent'=> $mirrorspresent,
                'batterypresent'=> $batterypresent,
                'chargertested'=> $chargertested,
                'damage'=> $damage,
                'chargerpresent'=> $chargerpresent,
                'batterynbr'=> $batterynbr,
                'batterytype'=> $batterytype,
                'chargernbr'=> $chargernbr,
                'comments'=> $comments,
                'notesint'=> $notesint,
                'created_by'=> $created_by,
                'routingnbr'=> $routingnbr,
                'routingdate'=> $routingdate,
                'imagesignurl'=> $imagesignurl
            
            
            
            ]);

   
    
    
    
            $uii=$this->fetch_pick_dels();
            // dd($t);
      
      
          return view('pick_del_form_list')->with('uii',$uii);
    }
    
    
    
    
    






















public function fetch_pick_dels()  {
    $uii=DB::table('users') ->join('pick_dels', 'users.id', '=', 'pick_dels.created_by')->where('pick_dels.isfinalized', '=',NULL)->orwhere('pick_dels.isfinalized', '=',0)->get();
    //dd($uii);

    return $uii;
}


public function fetch_pick_dels_finished()  {
    $uii=DB::table('users') ->join('pick_dels', 'users.id', '=', 'pick_dels.created_by')->where('pick_dels.isfinalized', '=',1)->get();
    //dd($uii);

    return $uii;
}



public function fetch_dealers_locations2($dealerid){
   
    $dealerid = intval($dealerid);
   
    $model = 'res.partner';
    $query_arguments=array('&',array('parent_id','=',$dealerid ),array('type','=','delivery'));
   
    $limitations=array('fields'=>array('display_name'));
    $call=new Odoocall();
    $uii=$call->Odooquery($model,$query_arguments, $limitations);






return $uii;
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
        $limitations=array('fields'=>array( 'display_name','id'));  // Array of wanted fields True, False   
        $uii=$models->execute_kw($db, $uid, $password, 'res.partner', 'search_read', array($query_arguments),$limitations);//telos execute_kw
        // $uii= $this->sortBy('display_name', $uii, $sort_direction = 'asc');

//taxinomisi me vasi to onoma

       $dealer_name = array();
       foreach ($uii as $key => $row)
       {
           $dealer_name[$key] = $row['display_name'];
       }
       array_multisort($dealer_name, SORT_NATURAL|SORT_FLAG_CASE, $uii);
 
 //taxinomisi me vasi to onoma


        return $uii;

    }





    



    public function show_sign(){

        return view('signaturePad');

    }


    public function upload_sign(Request $request)
    {

        $data_uri=$request->signdata;  //'data:image/jpeg;base64,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yBgBKB5auXA2tNK5H3TQB+itABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAc8Ph38Px4lXxoPAvh7/hIEDBdW/syD7YATk4m27+SSTz3oA6GgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKAP/9k=';
        $pickdelid=$request->pickdelid; 
        $encoded_image = explode(",", $data_uri)[1];
        $decoded_image = base64_decode($encoded_image);

        $fg=file_put_contents(public_path()."/".$pickdelid.".jpg", $decoded_image);
        //Storage::disk('local')->put("signature.png", $decoded_image);


        
        //$folderPath = public_path();
        
        //$image_parts = explode(";base64,", $request->signed);

        return  response()->json(['filepath'=> $fg]);
    }






}
