<?php

class ACTVentaDetalle extends ACTbase
{
    function listarVentaDetalle() {
        $this->objParam->defecto('ordenacion', 'id_venta_detalle');
        $this->objParam->defecto('dir_ordenacion', 'ASC');

        if($this->objParam->getParametro('id_venta') != '') {
            $this->objParam->addFiltro("tvd.id_venta= ".$this->objParam->getParametro('id_venta'));
        }

        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODVentaDetalle', 'listarVentaDetalle');
        } else {
            $this->objFunc = $this->create('MODVentaDetalle');
            $this->res = $this->objFunc->listarVentaDetalle($this->objParam);

        }
        $this->res->imprimirRespuesta($this->res->generarJson());

    }

    function insertarVentaDetalle() {
        $this->objFunc=$this->create('MODVentaDetalle');
        if($this->objParam->insertar('id_venta_detalle')){
            $this->res=$this->objFunc->insertarVentaDetalle($this->objParam);
        } else{
            $this->res=$this->objFunc->modificarVentaDetalle($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
    function eliminarVentaDetalle() {
        $this->objFunc=$this->create('MODVentaDetalle');
        $this->res=$this->objFunc->eliminarVentaDetalle($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
}
?>