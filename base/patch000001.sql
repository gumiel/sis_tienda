/***********************************I-SCP-FFP-TIE-1-17/06/2021****************************************/
CREATE TABLE tie.tmarca (
    id_marca serial NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    CONSTRAINT pk_tmarca__id_marca PRIMARY KEY(id_marca)
) INHERITS (pxp.tbase);
/***********************************F-SCP-FFP-TIE-1-17/06/2021*****************************************/

/***********************************I-SCP-ICQ-TIE-2-17/06/2021****************************************/
CREATE TABLE tie.tproducto (
    id_producto serial NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    precio DECIMAL NOT NULL default 0,
    CONSTRAINT pk_tproducto__id_producto PRIMARY KEY(id_producto)
) INHERITS (pxp.tbase);
/***********************************F-SCP-ICQ-TIE-2-17/06/2021*****************************************/


/***********************************I-SCP-FFP-TIE-1-19/06/2021****************************************/
alter table tie.tproducto alter column precio type numeric(10,2) using precio::numeric(10,2);

/***********************************F-SCP-FFP-TIE-1-19/06/2021*****************************************/


/***********************************I-SCP-FFP-TIE-2-19/06/2021****************************************/

alter table tie.tproducto
    add id_marca integer;

/***********************************F-SCP-FFP-TIE-2-19/06/2021*****************************************/

/***********************************I-SCP-DZ-TIE-3-23/06/2021****************************************/
CREATE TABLE tie.tCategoria (
                                id_categoria serial NOT NULL,
                                nombre VARCHAR(50) NOT NULL,
                                color VARCHAR(50) NOT NULL,
                                CONSTRAINT pk_tcategoria__id_categoria PRIMARY KEY(id_categoria)
) INHERITS (pxp.tbase);
/***********************************F-SCP-DZ-TIE-3-23/06/2021*****************************************/


/***********************************I-SCP-FFP-TIE-3-23/06/2021****************************************/
CREATE TABLE tie.tproducto_categoria (
                                id_producto_categoria serial NOT NULL,
                                id_categoria integer,
                                id_producto integer,
                                CONSTRAINT pk_tproducto_categoria__id_producto_categoria PRIMARY KEY(id_producto_categoria)
) INHERITS (pxp.tbase);
/***********************************F-SCP-FFP-TIE-3-23/06/2021*****************************************/