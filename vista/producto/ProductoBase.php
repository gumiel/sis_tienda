<?php
header("content-type: text/javascript; charset=UTF-8");
?>
<script>

    Phx.vista.ProductoBase=Ext.extend(Phx.gridInterfaz,{

            constructor:function(config){
                this.maestro=config.maestro;
                //llama al constructor de la clase padre
                Phx.vista.ProductoBase.superclass.constructor.call(this,config);
                this.init();
                //this.load({params:{start:0, limit:this.tam_pag}})

                this.addButton('btn_ejemplo', {
                    text: 'Btn Ejemplo',
                    iconCls: 'badelante',
                    disabled: true,
                    handler: this.handleButton,
                    tooltip: '<b>este es un mensaje</b>'
                })
                this.addButton('btn_ejemplo2', {
                    text: '<i class="fa fa-file-text-o fa-2x"></i><br>OTRO BOTON',
                    disabled: false,
                    handler: () => {
                        alert('asdasdasdasd')
                    },
                    tooltip: '<b>este es un mensaje</b>'
                })
            },

            Atributos:[
                {
                    //configuracion del componente
                    config:{
                        labelSeparator:'',
                        inputType:'hidden',
                        name: 'id_producto'
                    },
                    type:'Field',
                    form:true
                },
                {
                    //configuracion del componente
                    config:{
                        labelSeparator:'',
                        inputType:'hidden',
                        name: 'id_marca'
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
                    filters:{pfiltro:'estado_reg',type:'string'},
                    id_grupo:1,
                    grid:true,
                    form:false
                },
                {
                    config:{
                        name: 'nombre',
                        fieldLabel: 'Nombre',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength:255
                    },
                    type:'TextField',
                    filters:{pfiltro:'tp.nombre',type:'string'},
                    id_grupo:1,
                    grid:true,
                    form:true,
                    bottom_filter: true,
                },
                {
                    config:{
                        name: 'precio',
                        fieldLabel: 'Precio',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength:255
                    },
                    type:'NumberField',
                    filters:{pfiltro:'tp.precio',type:'string'},
                    id_grupo:1,
                    grid:true,
                    form:true,
                    bottom_filter: true,
                },
                {
                    config:{
                        name:'id_categoria',
                        fieldLabel:'Categoria',
                        allowBlank:true,
                        emptyText:'Categorias...',
                        store: new Ext.data.JsonStore({
                            url: '../../sis_tienda/control/Categoria/listarCategoria',
                            id: 'id_categoria',
                            root: 'datos',
                            sortInfo:{
                                field: 'id_categoria',
                                direction: 'ASC'
                            },
                            totalProperty: 'total',
                            fields: ['id_categoria','nombre','color'],
                            // turn on remote sorting
                            remoteSort: true,
                            baseParams:{par_filtro:'nombre'}

                        }),
                        valueField: 'id_categoria',
                        displayField: 'nombre',
                        forceSelection:true,
                        typeAhead: true,
                        triggerAction: 'all',
                        lazyRender:true,
                        mode:'remote',
                        pageSize:10,
                        queryDelay:1000,
                        width:250,
                        minChars:2,
                        enableMultiSelect:true

                        //renderer:function(value, p, record){return String.format('{0}', record.data['descripcion']);}

                    },
                    type:'AwesomeCombo',
                    id_grupo:0,
                    grid:false,
                    form:true
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
                    filters:{pfiltro:'tp.fecha_reg',type:'date'},
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
                    filters:{pfiltro:'tp.id_usuario_ai',type:'numeric'},
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
                    filters:{pfiltro:'tp.usuario_ai',type:'string'},
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
                    filters:{pfiltro:'tm.cuenta',type:'string'},
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
                    filters:{pfiltro:'tm.fecha_mod',type:'date'},
                    id_grupo:1,
                    grid:true,
                    form:false
                }
            ],
            tam_pag:50,
            title:'Marca',
            ActSave:'../../sis_tienda/control/Producto/insertarProducto',
            ActDel:'../../sis_tienda/control/Producto/eliminarProducto',
            ActList:'../../sis_tienda/control/Producto/listarProducto',
            id_store:'id_producto',
            fields: [
                {name:'id_producto', type: 'numeric'},
                {name:'estado_reg', type: 'string'},
                {name:'nombre', type: 'string'},
                {name:'precio', type: 'numeric'},
                {name:'id_usuario_reg', type: 'numeric'},
                {name:'fecha_reg', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
                {name:'id_usuario_ai', type: 'numeric'},
                {name:'usuario_ai', type: 'string'},
                {name:'id_usuario_mod', type: 'numeric'},
                {name:'fecha_mod', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
                {name:'usr_reg', type: 'string'},
                {name:'usr_mod', type: 'string'},
                {name:'desc_marca', type: 'string'},
                {name:'id_categoria', type: 'string'},
            ],
            sortInfo:{
                field: 'id_producto',
                direction: 'ASC'
            },
            bdel:true,
            bsave:true,
            handleButton: function () {
                    console.log('this',this);
                    var rec = this.sm.getSelected();
                    console.log('rec',rec)
            },
            preparaMenu: function (n) {
                var tb = Phx.vista.ProductoBase.superclass.preparaMenu.call(this);

                var tb = this.tbar;
                    var data = this.getSelectedData();
                    console.log('data',data)
                if(data.desc_marca === 'SAMSUNG') {
                    this.getBoton('btn_ejemplo').enable();

                } else {
                    this.getBoton('btn_ejemplo').disable();
                }
                return tb;
            },
        }
    )

</script>
