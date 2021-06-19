/*******************************************I-DAT-FFP-TIE-1-18/06/2021***********************************************/

INSERT INTO segu.tsubsistema ( codigo, nombre, fecha_reg, prefijo, estado_reg, nombre_carpeta, id_subsis_orig)
VALUES ('TIE', 'tienda', '2021-06-18', 'TIE', 'activo', 'tienda', NULL);

select pxp.f_insert_tgui ('TIENDA', '', 'TIE', 'si', 1, '', 1, '', '', 'TIE');

select pxp.f_insert_tgui ('Marca', 'Marca', 'MAR', 'si', 1, 'sis_tienda/vista/marca/Marca.php', 2, '', 'Marca', 'TIE');

/*******************************************F-DAT-FFP-TIE-1-18/06/2021***********************************************/

/*******************************************I-DAT-ICQ-TIE-2-18/06/2021***********************************************/
select pxp.f_insert_tgui ('Producto', 'Producto', 'PROD', 'si', 2, 'sis_tienda/vista/producto/Producto.php', 2, '', 'Producto', 'TIE');
/*******************************************F-DAT-ICQ-TIE-2-18/06/2021***********************************************/

