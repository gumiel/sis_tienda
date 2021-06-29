CREATE OR REPLACE FUNCTION "tie"."ft_venta_ime"(
    p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
    RETURNS character varying AS
$BODY$
DECLARE

    v_consulta            varchar;
    v_parametros          record;
    v_nombre_funcion       text;
    v_resp                varchar;
    v_id_venta             integer;
    v_venta               record;
    v_details_json          json;
    record_detail          record;
    v_periodo          record;
    v_dosificacion          record;
    v_codigo_control text;
    v_nro_fac integer;
    v_nit varchar;
    v_importe_total numeric(10,2) DEFAULT 0;
BEGIN
    v_nombre_funcion = 'tie.ft_venta_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************
     #TRANSACCION:  'TIE_VENTA_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        admin
     #FECHA:        17-04-2020 01:52:57
    ***********************************/

    if(p_transaccion='TIE_VENTA_INS')then

        begin


            v_periodo:= param.f_get_periodo_gestion(v_parametros.fecha::date);

            SELECT id_dosificacion,llave, nro_aut, nro_inicio
            INTO v_dosificacion
            FROM tie.tdosificacion
            WHERE fecha_ini <= now()::date
            AND fecha_fin >= now()::date
            FOR UPDATE;


            IF(v_dosificacion is null) then
                RAISE EXCEPTION '%', 'No tienes una dosificacion';
            END IF;

            v_nro_fac:= v_dosificacion.nro_inicio;

            select nit
            into v_nit
            from tie.tcliente
                where id_cliente = v_parametros.id_cliente;

            --CREATE FUNCTION f_gen_cod_control(llave_dosificacion character varying, autorizacion character varying, nro_factura character varying, nit character varying, fecha_emision character varying, monto_facturado numeric) RETURNS text





            INSERT into tie.tventa(
                id_usuario_reg,
                id_usuario_mod,
                fecha_reg,
                fecha_mod,
                estado_reg,
                id_usuario_ai,
                usuario_ai,
                obs_dba,
                id_cliente,
                id_periodo,
                fecha,
                nro_fac,
                nro_venta,
                total
            ) VALUES (
                         p_id_usuario,
                         null,
                         now(),
                         null,
                         'activo',
                         null,
                         null,
                         null,
                         v_parametros.id_cliente,
                         v_periodo.po_id_periodo,
                         v_parametros.fecha,
                         v_nro_fac,
                         v_parametros.nro_venta,
                         null
                     ) RETURNING id_venta into v_id_venta;



            /*
           details":"[{\"id_producto\":\"7\",\"precio_unitario\":12,\"precio_total\":12,\"cantidad_vendida\":1}]"}
           */
            FOR record_detail IN (SELECT json_array_elements(v_parametros.details::json) obj)
                LOOP


                    v_importe_total:= v_importe_total + (cast(record_detail.obj->>'cantidad_vendida' as integer) * cast(record_detail.obj->>'precio_unitario' as numeric));
                    INSERT into tie.tventa_detalle (
                        id_usuario_reg,
                        id_usuario_mod,
                        fecha_reg,
                        fecha_mod,
                        estado_reg,
                        id_usuario_ai,
                        usuario_ai,
                        obs_dba,
                        id_venta,
                        id_producto,
                        cantidad_vendida,
                        precio_unitario,
                        precio_total
                    ) VALUES (
                                 p_id_usuario,
                                 null,
                                 now(),
                                 null,
                                 'activo',
                                 null,
                                 null,
                                 null,
                                 v_id_venta,
                                 cast(record_detail.obj->>'id_producto' as integer),
                                 cast(record_detail.obj->>'cantidad_vendida' as integer),
                                 cast(record_detail.obj->>'precio_unitario' as numeric),
                                 cast(record_detail.obj->>'precio_total' as numeric)

                             );

                END LOOP;


            v_codigo_control:= pxp.f_gen_cod_control(v_dosificacion.llave,
                                                     v_dosificacion.nro_aut,
                                                     v_nro_fac::varchar,
                                                     v_nit::varchar,
                                                     to_char(now()::date, 'YYYYMMDD')::VARCHAR,
                                                     round(v_importe_total::numeric, 0)
                                   );

           update tie.tventa set codigo_control = v_codigo_control
            where id_venta = v_id_venta;




            UPDATE tie.tdosificacion
            SET nro_inicio = nro_inicio + 1
            WHERE id_dosificacion = v_dosificacion.id_dosificacion;


            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','inserccion exitoso'||v_id_venta||')');
            v_resp = pxp.f_agrega_clave(v_resp,'v_id_venta',v_id_venta::varchar);

            --Devuelve la respuesta
            return v_resp;

        end;

        /*********************************
         #TRANSACCION:  'TIE_categoria_ELI'
         #DESCRIPCION:    eliminar categoria
         #AUTOR:        admin
         #FECHA:        17-04-2020 01:52:57
        ***********************************/

    elsif(p_transaccion='TIE_CATEGORIA_ELI')then

        begin
            DELETE from tie.tcategoria
            where id_categoria = v_parametros.id_categoria;



            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','eliminado exitoso'||v_parametros.id_categoria||')');
            v_resp = pxp.f_agrega_clave(v_resp,'v_id_categoria',v_parametros.id_categoria::varchar);

            --Devuelve la respuesta
            return v_resp;

        end;

        /*********************************
         #TRANSACCION:  'TIE_categoria_MOD'
         #DESCRIPCION:    ELIMINAR categoria
         #AUTOR:        favio figueroa
         #FECHA:        17-04-2020 01:52:57
        ***********************************/

    elsif(p_transaccion='TIE_CATEGORIA_MOD')then

        begin


            UPDATE tie.tcategoria SET nombre = v_parametros.nombre,
                                      fecha_mod = now(),
                                      id_usuario_mod = p_id_usuario,
                                      color = v_parametros.color
            where id_categoria = v_parametros.id_categoria;


            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','modificado exitoso'||v_parametros.id_categoria||')');
            v_resp = pxp.f_agrega_clave(v_resp,'v_id_categoria',v_parametros.id_categoria::varchar);

            --Devuelve la respuesta
            return v_resp;

        end;

    else

        raise exception 'Transaccion inexistente: %',p_transaccion;

    end if;

EXCEPTION

    WHEN OTHERS THEN
        v_resp='';
        v_resp = pxp.f_agrega_clave(v_resp,'mensaje',SQLERRM);
        v_resp = pxp.f_agrega_clave(v_resp,'codigo_error',SQLSTATE);
        v_resp = pxp.f_agrega_clave(v_resp,'procedimientos',v_nombre_funcion);
        raise exception '%',v_resp;

END;
$BODY$
    LANGUAGE 'plpgsql' VOLATILE
                       COST 100;
ALTER FUNCTION "tie"."ft_venta_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
