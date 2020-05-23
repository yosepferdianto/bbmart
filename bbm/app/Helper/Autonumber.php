<?php

namespace App\Helper;

use App\Pembelian;
/**
 * Class Reply
 * @package App\Classes
 */
class Autonumber
{
    public static function getNomerPO()
    {
        $awal = 'PO';
        $terakhir = Pembelian::max('id');
        $no = 1;
        if($terakhir){
            $autonumber = $awal.'-'.date('m-y').'-'.sprintf("%03s", abs($terakhir + 1));
        } else {
            $autonumber = $awal.'/'.date('Y-m').'/'.sprintf("%03s", $no);
        }
        return $autonumber;
    }

    function format_uang($angka){ 
        $hasil =  number_format($angka,0, ',' , '.'); 
        return $hasil; 
    }

}
