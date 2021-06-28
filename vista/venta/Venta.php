<?php
header("content-type: text/javascript; charset=UTF-8");
?>
<script>

    Phx.vista.Venta=Ext.extend(Phx.gridInterfaz,{

            constructor:function(config){
                this.maestro=config.maestro;
                //llama al constructor de la clase padre
                Phx.vista.Venta.superclass.constructor.call(this,config);
                this.init();
                this.load({params:{start:0, limit:this.tam_pag}})
            },

            Atributos:[
                {
                    //configuracion del componente
                    config:{
                        labelSeparator:'',
                        inputType:'hidden',
                        name: 'id_venta'
                    },
                    type:'Field',
                    form:true
                },
                {
                    config:{
                        name: 'estado_reg',
                        fieldLabel: 'Estado Reg.',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength:10
                    },
                    type:'TextField',
                    filters:{pfiltro:'tv.estado_reg',type:'string'},
                    id_grupo:1,
                    grid:true,
                    form:false
                },
                {
                    //configuracion del componente
                    config:{
                        labelSeparator:'',
                        inputType:'hidden',
                        name: 'id_cliente'
                    },
                    type:'Field',
                    form:true
                },
                {
                    //configuracion del componente
                    config:{
                        labelSeparator:'',
                        inputType:'hidden',
                        name: 'id_periodo'
                    },
                    type:'Field',
                    form:true
                },
                {
                    config:{
                        name: 'fecha',
                        fieldLabel: 'Fecha',
                        allowBlank: true,
                        anchor: '30%',
                        gwidth: 100,
                        maxLength:255
                    },
                    type:'DateField',
                    filters:{pfiltro:'tv.fecha',type:'numeric'},
                    id_grupo:1,
                    grid:true,
                    form:true,
                    bottom_filter: true,
                },
                {
                    config:{
                        name: 'nro_fac',
                        fieldLabel: 'Numero factura',
                        allowBlank: true,
                        anchor: '50%',
                        gwidth: 100,
                        maxLength:255
                    },
                    type:'TextField',
                    filters:{pfiltro:'tv.nro_fac',type:'numeric'},
                    id_grupo:1,
                    grid:true,
                    form:true,
                    bottom_filter: true,
                },
                {
                    config:{
                        name: 'nro_venta',
                        fieldLabel: 'Numero Venta',
                        allowBlank: true,
                        anchor: '50%',
                        gwidth: 100,
                        maxLength:255
                    },
                    type:'TextField',
                    filters:{pfiltro:'tv.nro_venta',type:'String'},
                    id_grupo:1,
                    grid:true,
                    form:true,
                    bottom_filter: true,
                },
                {
                    config:{
                        name: 'total',
                        fieldLabel: 'Total',
                        allowBlank: true,
                        anchor: '50%',
                        gwidth: 100,
                        maxLength:255
                    },
                    type:'TextField',
                    filters:{pfiltro:'tv.total',type:'numeric'},
                    id_grupo:1,
                    grid:true,
                    form:true,
                    bottom_filter: true,
                },

                {
                    config:{
                        name: 'usr_reg',
                        fieldLabel: 'Creado por',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength:4
                    },
                    type:'Field',
                    filters:{pfiltro:'usu1.cuenta',type:'string'},
                    id_grupo:1,
                    grid:true,
                    form:false
                },
                {
                    config:{
                        name: 'fecha_reg',
                        fieldLabel: 'Fecha creación',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        format: 'd/m/Y',
                        renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
                    },
                    type:'DateField',
                    filters:{pfiltro:'tv.fecha_reg',type:'date'},
                    id_grupo:1,
                    grid:true,
                    form:false
                },
                {
                    config:{
                        name: 'id_usuario_ai',
                        fieldLabel: 'Fecha creación',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength:4
                    },
                    type:'Field',
                    filters:{pfiltro:'tv.id_usuario_ai',type:'numeric'},
                    id_grupo:1,
                    grid:false,
                    form:false
                },
                {
                    config:{
                        name: 'usuario_ai',
                        fieldLabel: 'Funcionaro AI',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength:300
                    },
                    type:'TextField',
                    filters:{pfiltro:'tv.usuario_ai',type:'string'},
                    id_grupo:1,
                    grid:true,
                    form:false
                },
                {
                    config:{
                        name: 'usr_mod',
                        fieldLabel: 'Modificado por',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength:4
                    },
                    type:'Field',
                    filters:{pfiltro:'tv.cuenta',type:'string'},
                    id_grupo:1,
                    grid:true,
                    form:false
                },
                {
                    config:{
                        name: 'fecha_mod',
                        fieldLabel: 'Fecha Modif.',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        format: 'd/m/Y',
                        renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
                    },
                    type:'DateField',
                    filters:{pfiltro:'tv.fecha_mod',type:'date'},
                    id_grupo:1,
                    grid:true,
                    form:false
                }
            ],
            tam_pag:50,
            title:'Venta',
            ActSave:'../../sis_tienda/control/Venta/insertarVenta',
            //ActDel:'../../sis_tienda/control/Venta/eliminarVenta',
            ActList:'../../sis_tienda/control/Venta/listarVenta',
            id_store:'id_venta',
            fields: [
                {name:'id_venta', type: 'numeric'},
                {name:'estado_reg', type: 'string'},
                {name:'id_cliente', type: 'numeric'},
                {name:'id_periodo', type: 'numeric'},
                {name:'fecha', type: 'date'},
                {name:'nro_fac', type: 'numeric'},
                {name:'nro_venta', type: 'numeric'},
                {name:'total', type: 'numeric'},
                {name:'nombre', type: 'string'},
                {name:'color', type: 'string'},
                {name:'id_usuario_reg', type: 'numeric'},
                {name:'fecha_reg', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
                {name:'id_usuario_ai', type: 'numeric'},
                {name:'usuario_ai', type: 'string'},
                {name:'id_usuario_mod', type: 'numeric'},
                {name:'fecha_mod', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
                {name:'usr_reg', type: 'string'},
                {name:'usr_mod', type: 'string'},

            ],
            sortInfo:{
                field: 'id_venta',
                direction: 'ASC'
            },
            bdel:false,
            bedit:false,
            bsave:true,
            tabsouth: [
                {
                    url: '../../../sis_tienda/vista/venta_detalle/VentaDetalle.php',
                    title: 'Venta Detalle',
                    height: '50%',
                    cls: 'VentaDetalle',
                }
            ],
            onSaveForm: function (form, objRes) {
                var me = this;
                form.panel.destroy();
                me.reload();
            },
            abrirFormulario: function () {
                var me = this;
                me.objSolForm = Phx.CP.loadWindows(
                    '../../../sis_tienda/vista/venta/FormVenta.php',
                    'Formulario Venta',
                {
                    modal: true,
                        width: '90%',
                    height: '90%',
                },
                {
                    data: {objPadre: me, tipo_form: 'new'}
                },
                this.idContenedor,
                    'FormVenta',
                    {
                        config: [{
                            event:'successsave',
                            delegate: this.onSaveForm
                        }],
                        scope: this
                    }
                );


                /*Phx.CP.loadWindows('../../../sis_devoluciones/vista/liquidacion/FormGenerarNota.php',
                    'Item',
                    {
                        width:900,
                        height:400
                    },rec.json,this.idContenedor,'FormGenerarNota',
                    {
                        config: [{
                            event: 'successsave',
                            delegate: this.onSavedGenerarNota,
                        }],
                        scope: this
                    }
                )*/





            },
            onButtonNew: function () {
                this.abrirFormulario();
            },
        }
    )

</script>
