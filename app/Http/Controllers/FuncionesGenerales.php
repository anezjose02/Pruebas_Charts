<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuncionesGenerales extends Controller
{
    //
    public static function secuenciales($secuencial,$incremento=0)
    {
        # code...
        $s = (int) $secuencial;

        $s+=(int)$incremento;

        $ss = $s.'';

        $ss_l = strlen($ss);

        for ($i=0; $i < 9 - $ss_l; $i++) { 
            # code...
            $ss = '0' . $ss;
        }

        return $ss;
    }

    public static function estandarizar($obj)
    {
        # code...
        if ((!is_array($obj) && !is_object($obj)) || $obj == null) {
            # code...
            return $obj;
        }
    
        foreach ($obj as $key => $value) {
            # code...
            if (is_array($value) || is_object($obj)) {
                # code...
                if (!@$value[0]) {
                    # code...
                    $value = self::estandarizar($value);
                    $obj[$key] =  array($value);
                }
            }
        }
    
        return $obj;
    }

    public static function claveAcceso($fecha,$tipoComprobante,$ruc,$ambiente,$estab,$pro_emi,$secuencial,$tipoEmision=1)
    {
        # code...
        $f = explode("-",$fecha);

        $codigoNumerico = substr("".time(),0,8);

        $s = $secuencial;

        if (strlen($ruc) != 13) {
            # code...
            if (strlen($ruc)==10) {
                # code...
                $ruc .= '001';
            }else{
                $ruc = "9999999999999";
            }
        }

        return $f[2].$f[1].$f[0].$tipoComprobante.$ruc.$ambiente.$estab.$pro_emi.$s.$codigoNumerico.$tipoEmision.self::modulo11($f[2].$f[1].$f[0].$tipoComprobante.$ruc.$ambiente.$estab.$pro_emi.$s.$codigoNumerico.$tipoEmision);
    }

    public static function modulo11($numero)
    {
        # code...
        $x = str_split($numero."");

        $r = 0;
        $dig = 2;
        for ($i=count($x)-1; $i >= 0; $i--) { 
            # code...
            if ($dig == 8) {
                # code...
                $dig = 2;
            }
            $l = $x[$i];


            $rs = $dig * $l;

            $r+= $rs;

            $dig++;
        }

        $rd = $r % 11;
        $rt = 11 - $rd;

        if ($rt == 11) {
            # code...
            return 0;
        }
        if ($rt == 10) {
            # code...
            return 1;
        }

        return $rt;
    }
}
