<?php

class ACTMarca extends ACTbase
{
    function listarMarca() {
        $this->objParam->defecto('ordenacion', 'id_marca');
        $this->objParam->defecto('dir_ordenacion', 'ASC');

        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODMarca', 'listarMarca');
        } else {
            $this->objFunc = $this->create('MODMarca');
            $this->res = $this->objFunc->listarMarca($this->objParam);

        }
        $this->res->imprimirRespuesta($this->res->generarJson());

    }
}
?>