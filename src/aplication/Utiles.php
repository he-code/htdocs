<?php 
namespace src\aplication;

use DateTime;

class Utiles{


    public static function  generateNumeroActa(string $string){
        date_default_timezone_set('America/Guayaquil');
        $separado = preg_split("/-/",$string);
        $date = new DateTime();
        $year = $date->format('Y');
        $num = intval($separado[1]) + 1;
        $codigoNum = '';
        $codigo ='';
        if($num <= 9){
            $codigoNum = '00'. $num;
        } else if($num <= 99) {
            $codigoNum = '0'. $num;
        }else{
            $codigoNum = $num;
        }

        $codigo = $separado[0] . '-' .$codigoNum . '-' .$year; 

        return $codigo;
    }

    public static function getFecha($fecha){
        $date = new DateTime($fecha);
        $separado = preg_split('/-/',$date->format('Y-m-d'));
        $year = $separado[0];
        $montsText = [
            'January' => 'Enero','February' => 'Febrero', 'March' => 'Marzo', 'April' => 'Abril',
            'May' => 'Mayo','June' => 'Junio',  'July' => 'Julio', 'August' => 'Agosto',
            'September'=>'Septiembre', 'October' => 'Octubre', 'November' => 'Noviembre',   'December' => 'Diciembre'
        ];
        $daytextA = [
            'Monday' => 'Lunes' , 'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles', 'Thursday' =>  'Jueves',
            'Friday' => 'viernes', 'Saturday' =>'Sábado','Sunday' => 'Domingo'
        ];
        $timesspan = strtotime($date->format('Y-m-d'));
        $text = strftime("%A, %d de ,%B, de %Y",$timesspan);
        $text_se = preg_split('/,/',$text);
        $mount = $montsText[trim($text_se[2])];
        $day = $separado[2];
        $dayText = $daytextA[trim($text_se[0])];
        return $dayText.' ' . $day . ' de '. $mount . ' del ' . $year;

    }



    public static function  generateNumeroActaSalida(string $string){
        date_default_timezone_set('America/Guayaquil');
        $separado = preg_split("/-/",$string);
        $date = new DateTime();
        $year = $date->format('Y');
        $num = intval($separado[3]) + 1;
        $codigoNum = '';
        $codigo ='';
        if($num <= 9){
            $codigoNum = '00'. $num;
        } else if($num <= 99) {
            $codigoNum = '0'. $num;
        }else{
            $codigoNum = $num;
        }

        $codigo = $separado[0] .'-'. $separado[1] . '-'. $separado[2] . '-' .$codigoNum . '-' .$year; 

        return $codigo;
    }
}