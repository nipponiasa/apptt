<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class StatCountr extends Model
{
    protected $table = 'statnls'; //ayto prepei na fygei

    //Methodos pou afora thn analogia 25 45
       public static function ratio45tototal($countrytable="statnls",$max45name="Bromfiets") {
                $query1=sprintf("select A.YearMonth, sum(A.total) as total from (SELECT CONCAT( year,'%s',IF(LENGTH(month)=2,month,CONCAT('%s',month))) AS YearMonth, motocategory , sum(unitssold) as total FROM %s group by motocategory , year ,month) as A group by A.YearMonth ORDER BY A.YearMonth ASC","/","0", $countrytable);
                $query2=sprintf("select A.YearMonth, A.motocategory, A.total from (SELECT CONCAT( year,'%s',IF(LENGTH(month)=2,month,CONCAT('%s',month))) AS YearMonth, motocategory , sum(unitssold) as total FROM  %s group by motocategory , year ,month) as A where A.motocategory='%s' ORDER BY A.YearMonth ASC","/","0",$countrytable, $max45name);
                $sum45and25s = DB::select( $query1);
                $max45 = DB::select($query2);
                $Max45ToTotal="";
                $LabelYearMonth="";
                foreach ($sum45and25s as $totalmonth) {
                       $LabelYearMonth=($LabelYearMonth==''?"'".$totalmonth->YearMonth."',":$LabelYearMonth."'".$totalmonth->YearMonth."',");
                            foreach ($max45 as $max45month) {
                                $Max45ToTotal=($max45month->YearMonth==$totalmonth->YearMonth ? $Max45ToTotal.round(100*$max45month->total/$totalmonth->total,2).",":$Max45ToTotal);
                                                    }
                }

               $result=array("label"=> $LabelYearMonth, "data"=>$Max45ToTotal);
         return  $result;
       }

      








 //Methodos pou afora thn pita me ta synola
       public static function registrtotal($countrytable="statnls",$etos="2020") {
        $query1=sprintf("SELECT sum(unitssold) as total FROM %s where year='%s'",$countrytable,$etos);
        $query2=sprintf("SELECT brand,sum(unitssold)as total FROM %s where year='%s' group by brand order by total DESC LIMIT 10",$countrytable,$etos);
        $totalregistrations = DB::select($query1);
        $totalregistrbrands= DB::select($query2);

        foreach ($totalregistrations as $totalregistration) {
            $totalreg=$totalregistration->total; 
                                }
                                $total10=0;
                                $totalregistrationperbrand="";
                                $Labelbrands="";
                                foreach ($totalregistrbrands as $totalregistrbrand) {
                                    $total10=$total10+$totalregistrbrand->total;
                                    $totalregistrationperbrand=( $totalregistrationperbrand==''?$totalregistrbrand->total.",": $totalregistrationperbrand.$totalregistrbrand->total.",");
                                    $Labelbrands=( $Labelbrands==''?"'".$totalregistrbrand->brand."',": $Labelbrands."'".$totalregistrbrand->brand."',");
                                                        }
                                $rest=$totalreg- $total10;
                                $Labelbrands=$Labelbrands."'"."Rest Brands"."',";
                                $totalregistrationperbrand=$totalregistrationperbrand.$rest.",";
        $result=array("label"=> $Labelbrands, "data"=>$totalregistrationperbrand);
     return  $result ;
   }




   public static function registrnippo($countrytable="statnls",$etos="2020") {
    $query=sprintf("SELECT brand,sum(unitssold)as total FROM %s where (brand='%s' or brand='%s' or brand='%s' or brand='%s' or brand='%s') and year='%s' group by brand order by total DESC LIMIT 10 ",$countrytable, "FD MOTORS","NIPPONIA","DOOHAN","LIFAN","YINGANG",$etos);
    $totalregistrbrands= DB::select($query);
                      
                            $totalregistrationperbrand="";
                            $Labelbrands="";
                            foreach ($totalregistrbrands as $totalregistrbrand) {
                                
                                $totalregistrationperbrand=( $totalregistrationperbrand==''?$totalregistrbrand->total.",": $totalregistrationperbrand.$totalregistrbrand->total.",");
                      
                                $Labelbrands=( $Labelbrands==''?"'".$totalregistrbrand->brand."',": $Labelbrands."'".$totalregistrbrand->brand."',");

                                                    }

                                                 

    $result=array("label"=> $Labelbrands, "data"=>$totalregistrationperbrand);
 return  $result ;
}











   



}
