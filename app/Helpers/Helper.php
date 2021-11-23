<?php
namespace App\Helpers;

class Helper{
    
    public static function invoiceIDGenerator($model, $trow, $length = 4, $prefix){
        $data = $model::orderby('id','desc')->first();
        if(!$data){
            $og_length = $length;
            $last_number = '';
        }else{
            $code = substr($data->$trow, strlen($prefix)+1);
            $last_number = ($code/1)*1;
            $id_increment_last_num = $last_number + 1;
            $last_num_length = strlen($id_increment_last_num);
            $og_length = $length - $last_num_length;
            $last_number = $id_increment_last_num;
        }
        $zeros = "";
        for($i=0;$i<$og_length;$i++){
            $zeros.="0";
        }
        return $prefix.'-'.$zeros.$last_number;
    }
}