/***********************************I-SCP-FFP-TIE-1-17/06/2021****************************************/


CREATE TABLE tie.tmarca (
                       id_marca serial NOT NULL,
                       nombre VARCHAR(50) NOT NULL,
                       CONSTRAINT pk_tmarca__id_marca PRIMARY KEY(id_marca)
) INHERITS (pxp.tbase);



/***********************************F-SCP-FFP-TIE-1-17/06/2021*****************************************/
