<?php

namespace App\Services;
use Illuminate\Http\Request;
use Ripcord\Ripcord;
use PhpXmlRpc\Client;
use Illuminate\Support\Facades\DB;
class Odoocall
{



public function Odooquery(string $odoo_model,array $query_arguments=null ,array $limitations=null)//: array

{
    $url = Config('configva.odoo.production_url');//einai ston config folder
    $db = Config('configva.odoo.production_db');//einai ston config folder
    $username = Config('configva.odoo.user');//einai ston config folder
    $password = Config('configva.odoo.pass');//einai ston config folder
    $common = Ripcord::client("$url/xmlrpc/2/common");
    $uid = $common->authenticate($db, $username, $password, array());
    $models = Ripcord::client("$url/xmlrpc/2/object");
  $uii=$models->execute_kw($db, $uid, $password,$odoo_model, 'search_read', array($query_arguments), $limitations);//telos execute_kw
  // dd(!empty($limitations));

if (empty($query_arguments) and !empty($limitations))
{
    $uii=$models->execute_kw($db, $uid, $password, $odoo_model, 'search_read', array(),$limitations);//telos execute_kw
}
elseif (!empty($query_arguments) and !empty($limitations))

{
    $uii=$models->execute_kw($db, $uid, $password, $odoo_model, 'search_read', array($query_arguments),$limitations);//telos execute_kw

}
elseif (!empty($query_arguments) and empty($limitations))

{
    $uii=$models->execute_kw($db, $uid, $password, $odoo_model, 'search_read', array($query_arguments));//telos execute_kw

}
elseif (empty($query_arguments) and empty($limitations))

{

    $uii=$models->execute_kw($db, $uid, $password, $odoo_model, 'search_read', array());//telos execute_kw

}else{$uii=null;}


//dd($uii);

return $uii;





}


}

?>