<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    protected $fillable = [
        'identificacion',//
        'razonsocial',//
        'tipo',
        'sexo',
        'estadocivil',
        'fechanacimiento',
        'nacionalidad',
        'ciudad',
        'direccion',//
        'nrocalle',
        'estadoContribuyente',
        //adicionales
        'telefono',//
        'celular',//
        'email',//

        //sri
        'fecha',
        'NUMERO_RUC',//
        'RAZON_SOCIAL',//
        'NOMBRE_COMERCIAL',//
        'ESTADO_CONTRIBUYENTE',
        'CLASE_CONTRIBUYENTE',
        'FECHA_INICIO_ACTIVIDADES',
        'FECHA_ACTUALIZACION',
        'fechan_inicio_actividades',
        'fechan_actualizacion',
        'FECHA_SUSPENSION_DEFINITIVA',
        'FECHA_REINICIO_ACTIVIDADES',
        'fechan_suspension_definitiva',
        'fechan_reinicio_actividades',
        'OBLIGADO',
        'TIPO_CONTRIBUYENTE',
        'NUMERO_ESTABLECIMIENTO',
        'NOMBRE_FANTASIA_COMERCIAL',
        'CALLE',
        'INTERSECCION',
        'ESTADO_ESTABLECIMIENTO',
        'DESCRIPCION_PROVINCIA',
        'DESCRIPCION_CANTON',
        'DESCRIPCION_PARROQUIA',
        'CODIGO_CIIU',
        'ACTIVIDAD_ECONOMICA',
    ];
}
