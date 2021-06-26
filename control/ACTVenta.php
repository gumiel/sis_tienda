<?php

class ACTVenta extends ACTbase
{
    function listarVenta() {
        $this->objParam->defecto('ordenacion', 'id_venta');
        $this->objParam->defecto('dir_ordenacion', 'ASC');

        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODVenta', 'listarVenta');
        } else {
            $this->objFunc = $this->create('MODVenta');
            $this->res = $this->objFunc->listarVenta($this->objParam);

        }
        $this->res->imprimirRespuesta($this->res->generarJson());

    }

    function insertarVenta() {
        $this->objFunc=$this->create('MODVenta');
        if($this->objParam->insertar('id_venta')){
            $this->res=$this->objFunc->insertarVenta($this->objParam);
        } else{
            $this->res=$this->objFunc->modificarVenta($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
    function eliminarVenta() {
        $this->objFunc=$this->create('MODVenta');
        $this->res=$this->objFunc->eliminarVenta($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
}
?>