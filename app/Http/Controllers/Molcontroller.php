<?php

namespace App\Http\Controllers;
use App\Mol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
//Odoo
use Ripcord\Ripcord;
use PhpXmlRpc\Client;
//Odoo


class Molcontroller extends Controller
{
   
    public function list_all()
    {
            $listalltranfers=DB::select(DB::raw('SELECT * FROM `moltransfers` WHERE 1=1;'));
            $v=Molcontroller::internal_transfer_status("WH/INT/01797");
            //dd($v);
            return view('tracking_all')->with('listalltranfers',$listalltranfers);

    }

    public function to_inv_val()
    {
      
            
            $listalltranfers=DB::select(DB::raw('SELECT * FROM `moltransfers` WHERE`Status`="Delivered";'));
            return view('tracking_all')->with('listalltranfers',$listalltranfers);

    }


    public function make_raw_db_result_array($result_raw)
    {
    
        $result_array=array();
        foreach ($result_raw as $object_change)
         {
            $object_array=(array) $object_change;
            array_push($result_array,$object_array);
    
        }
         return  $final_array;
        
    }
    



    public function update_transfer(Request $request)
    {
       
 
        $userid =intval($request->input('modified_by'));
        $tranferid = $request->input('transfer_id');
        $note_user = $request->input('note');
        $cleantransfernbr = $request->input('cleantransfernbr');
        $status = $request->input('status');
        $Tranfernbr_cleaned_before = $request->input('Tranfernbr_cleaned_before');
        $status_before = $request->input('status_before');
        $note_system ="";
       
        if($status_before!=$status or $cleantransfernbr!=$Tranfernbr_cleaned_before or  $note_user!="")
        {
       
                        if($status_before!=$status) 
                        {
                            $note_system .="<li>Status changed from <b>".$status_before."</b> to <b>".$status."</b></li>";
                        }
                    
                        if($cleantransfernbr!=$Tranfernbr_cleaned_before)
                        {
                            $note_system .="<li>Transfer number changed from <b>".$Tranfernbr_cleaned_before."</b> to <b>".$cleantransfernbr."</b></li>";
                        }
   





                    $updated_result = DB::table('moltransfers')->where('id', $tranferid)->update(['Tranfernbr_cleaned' =>  $cleantransfernbr,'Status' => $status]);
                   // dd( $updated_result);
                    print( $status);
                    print( $Tranfernbr_cleaned_before);

                    $insert_result=DB::insert('insert into mol_edits  (user_id, user_explain,system_explain, mol_tranfer_id, created_at) values (?,?,?,?,?)', [''. $userid.'', ''. $note_user.'',''. $note_system.'', ''. $tranferid.'',''.now()]);
        }


        //dd($status);
        // dd( $userid);

        //$updated_result = DB::table('moltransfers')->where('id', $tranferid)->update(['Tranfernbr_cleaned' =>  $cleantransfernbr,'Status' => $status]);
        //$insert_result=DB::insert('insert into mol_edits  (user_id, user_explain,system_explain, mol_tranfer_id, created_at) values (?,?,?,?,?)', [''. $userid.'', ''. $note_user.'',''. $note_system.'', ''. $tranferid.'',''.now()]);

        return Redirect::to('/transfer_edit_form?transferid='.$tranferid);


    }























//kanei update ta invoiced

public function update_moltranfers()
{
    Molcontroller::check_for_int_trans();
    Molcontroller::check_for_so();
return Redirect::to('/tracking_all');

}

public function update_moltranfers2()
{
    Molcontroller::check_for_int_trans();
    Molcontroller::check_for_so();
return Redirect::to('/to_inv_val');

}

public function fetch_transfer_info(Request $request)
{
    $transferid = intval($request->input('transferid'));
    $transfer_current = DB::table('moltransfers')->where('id', $transferid)->first();
   // $transfer_current_edits = DB::table('mol_edits')->where('mol_tranfer_id', $transferid)->latest()->get();

    $transfer_current_edits = DB::table('mol_edits')
    ->join('users', 'mol_edits.user_id', '=', 'users.id')
    ->select('users.*', 'mol_edits.*')
    ->where('mol_tranfer_id', $transferid)->latest('mol_edits.created_at')->get();
    



//dd( $transfer_current_edits);
    return view('transfer_edit_form')->with('transfer_current',$transfer_current)->with('transfer_current_edits',$transfer_current_edits);
}


//sale orders
public function sale_order_status($saleorder)
{
    $url = Config('configva.odoo.production_url');//einai ston config folder
    $db = Config('configva.odoo.production_db');//einai ston config folder
    $username = Config('configva.odoo.user');//einai ston config folder
    $password = Config('configva.odoo.pass');//einai ston config folder
    
    $common = Ripcord::client("$url/xmlrpc/2/common");
    $uid = $common->authenticate($db, $username, $password, array());
    $models = Ripcord::client("$url/xmlrpc/2/object");
   
   $query_arguments=array(array('name','=',$saleorder));
   $limitations=array('fields'=>array('invoice_status'));  // Array of wanted fields True, False
   $uii=$models->execute_kw($db, $uid, $password,'sale.order', 'search_read',array($query_arguments), $limitations);
   $return_value = empty($uii) ? null: $uii[0]['invoice_status'];
   return $return_value;
    
}


//internal tranfers
public function internal_transfer_status($inttransf){

    $url = Config('configva.odoo.production_url');//einai ston config folder
    $db = Config('configva.odoo.production_db');//einai ston config folder
    $username = Config('configva.odoo.user');//einai ston config folder
    $password = Config('configva.odoo.pass');//einai ston config folder

    $common = Ripcord::client("$url/xmlrpc/2/common");
    $uid = $common->authenticate($db, $username, $password, array());
    $models = Ripcord::client("$url/xmlrpc/2/object");

    $query_arguments=array(array('name','=',$inttransf));
    $limitations=array('fields'=>array('state'));  // Array of wanted fields True, False
    $uii=$models->execute_kw($db, $uid, $password,'stock.picking', 'search_read',array($query_arguments), $limitations);
    $return_value = empty($uii) ? null: $uii[0]['state'];
    return $return_value;
}








function check_for_int_trans() {
             $sql_command="SELECT `Tranfernbr_cleaned` FROM `moltransfers` WHERE (CHAR_LENGTH(`Tranfernbr_cleaned`)=13 OR CHAR_LENGTH(`Tranfernbr_cleaned`)=12) AND `Status`='Delivered'";
             $inttransfers=DB::select(DB::raw( $sql_command));    
    foreach ($inttransfers as $inttransfer) {
           if(!empty($inttransfer->Tranfernbr_cleaned))
           {
                               $v=Molcontroller::internal_transfer_status($inttransfer->Tranfernbr_cleaned);

                               if($v=='done') {
                                       $sql_command="UPDATE `moltransfers` SET `Status` = 'Validated' WHERE `Status` = 'Delivered' and `Tranfernbr_cleaned`='".$inttransfer->Tranfernbr_cleaned."'";
                                       $query_result=DB::select(DB::raw( $sql_command)); 

                                                   }
                               elseif($v==NULL)
                                                   {
                                                       //echo "debug ".$inttransfer->Tranfernbr_cleaned;
                                                   }
           }
       

       }

}





function check_for_so() {
	$sql_command="SELECT `Tranfernbr_cleaned` FROM `moltransfers` WHERE CHAR_LENGTH(`Tranfernbr_cleaned`)=6 AND `Status`='Delivered'";
	$orders=DB::select(DB::raw( $sql_command)); 

	foreach ($orders as $order) {
		if(!empty($order->Tranfernbr_cleaned))
		{
							$v=Molcontroller::sale_order_status($order->Tranfernbr_cleaned);

							if($v=='invoiced') {
									$sql_command=	"UPDATE `moltransfers` SET `Status` = 'Invoiced' WHERE `Status` = 'Delivered' and `Tranfernbr_cleaned`='".$order->Tranfernbr_cleaned."'";
                                    $query_result=DB::select(DB::raw( $sql_command)); 
												}
							elseif($v==NULL)
												{
													//echo "debug ".$order->Tranfernbr_cleaned;
												}
		}
	

	}
}













//kanei update ta invoiced














}
