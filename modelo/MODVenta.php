<?php
/**
 *@package pXP
 *@file gen-MODDevweb.php
 *@author  (admin)
 *@date 04-07-2016 15:19:06
 *@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
 */

class MODVenta extends MODbase
{

    function __construct(CTParametro $pParam)
    {
        parent::__construct($pParam);
    }

    function listarVenta(){
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento='tie.ft_venta_sel';
        $this->transaccion='TIE_VENTA_SEL';
        $this->tipo_procedimiento='SEL';//tipo de transaccion


        //Definicion de la lista del resultado del query
        $this->captura('id_venta','int4');
        $this->captura('estado_reg','varchar');
        $this->captura('id_cliente','int4');
        $this->captura('id_periodo','int4');
        $this->captura('fecha','date');
        $this->captura('nro_fac','int4');
        $this->captura('nro_venta','varchar');
        $this->captura('total','numeric');
        $this->captura('id_usuario_reg','int4');
        $this->captura('fecha_reg','timestamp');
        $this->captura('usuario_ai','varchar');
        $this->captura('id_usuario_ai','int4');
        $this->captura('id_usuario_mod','int4');
        $this->captura('fecha_mod','timestamp');
        $this->captura('usr_reg','varchar');
        $this->captura('usr_mod','varchar');
        $this->captura('id_dosificacion','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function insertarVenta() {

        $this->procedimiento='tie.ft_venta_ime';
        $this->transaccion='TIE_VENTA_INS';
        $this->tipo_procedimiento='IME';

        $this->setParametro('id_venta','id_venta','int4');
        $this->setParametro('id_cliente','id_cliente','int4');
        $this->setParametro('id_periodo','id_periodo','int4');
        $this->setParametro('fecha','fecha','date');
        $this->setParametro('nro_fac','nro_fac','int4');
        $this->setParametro('nro_venta','nro_venta','varchar');
        $this->setParametro('total','total','numeric');
        $this->setParametro('details','details','text');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;

    }
    function generarventaJson() {

        $this->procedimiento='tie.ft_venta_ime';
        $this->transaccion='TIE_GETVEN_JSON';
        $this->tipo_procedimiento='IME';

        $this->setParametro('id_venta','id_venta','int4');


        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;

    }

}
?>