<?php
header("content-type: text/javascript; charset=UTF-8");

?>
<script>
    Phx.vista.ProductoHijo4 = {
        require: '../../../sis_tienda/vista/producto/ProductoBase.php',
        requireclase: 'Phx.vista.ProductoBase',
        title: 'Producto Hijo con filtro combo',
        nombreVista: 'producto_hijo_4',
        constructor: function (config) {

            this.initButtons = [this.cmbIdMarca,this.cmbTipo];
            Phx.vista.ProductoHijo4.superclass.constructor.call(this,config);

            this.load({params:{start:0, limit:this.tam_pag}});

        },
        cmbIdMarca : new Ext.form.ComboBox({
            name: 'id_marca',
            fieldLabel: 'Marca',
            allowBlank: false,
            emptyText: 'Elija una opcion',
            store: new Ext.data.JsonStore({
                url: '../../sis_tienda/control/Marca/listarMarca',
                id: 'id_marca',
                root: 'datos',
                sortInfo: {
                    field: 'id_marca',
                    direction: 'ASC',
                },
                totalProperty: 'total',
                fields: ['id_marca', 'nombre'],
                remoteSort: true,
                baseParams: {par_filtro: 'tm.nombre'},
            }),
            valueField: 'id_marca',
            displayField: 'nombre',
            hiddenName: 'id_marca',
            triggerAction: 'all',
            lazyRender: true,
            mode: 'remote',
            pageSize: 15,
            queryDelay: 1000,
            anchor: '100%',
            minChars: 2,
        }),
        cmbTipo: new Ext.form.ComboBox({
            name: 'tipo',
            fieldLabel: 'Tipo',
            allowBlank: true,
            emptyText: 'Tipo.....',
            typeHead: true,
            triggerAction: 'all',
            lazyRender: true,
            mode: 'local',
            store: ['ENTRADA', 'SALIDA'],
            width: 200,
            type: 'ComboBox'
        }),
        validarFiltro: function () {
            if(this.cmbIdMarca.getValue() !== '') {

                return true;
            }
            return false;
        },
        onButtonAct: function () {
            if(!this.validarFiltro()) {
                alert('necesitas seleccionar marca');
            } else {
                this.store.baseParams.id_marca = this.cmbIdMarca.getValue();
                Phx.vista.ProductoHijo4.superclass.onButtonAct.call(this);
            }
        },
        onButtonNew: function () {
            if(!this.validarFiltro()) {
                alert('necesitas seleccionar marca');
            } else {
                Phx.vista.ProductoHijo4.superclass.onButtonNew.call(this);
                this.Cmp.id_marca.setValue(this.cmbIdMarca.getValue())
            }
        },
        onButtonEdit: function () {
            Phx.vista.ProductoHijo4.superclass.onButtonEdit.call(this);
            this.Cmp.id_marca.setValue(this.cmbIdMarca.getValue())
        }


    }
</script>
