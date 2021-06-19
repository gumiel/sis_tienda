CREATE OR REPLACE FUNCTION "tie"."ft_producto_ime"(
    p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
    RETURNS character varying AS
$BODY$
DECLARE

    v_consulta            varchar;
    v_parametros          record;
    v_nombre_funcion       text;
    v_resp                varchar;
    v_id_producto              integer;
BEGIN
    v_nombre_funcion = 'tie.ft_producto_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************
     #TRANSACCION:  'TIE_PRODUCTO_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        Ivan Callapa Quiroz
     #FECHA:        17-04-2020 01:52:57
    ***********************************/

    if(p_transaccion='TIE_PRODUCTO_INS')then

        begin
            INSERT into tie.tproducto(
                id_usuario_reg,
                id_usuario_mod,
                fecha_reg,
                fecha_mod,
                estado_reg,
                id_usuario_ai,
                usuario_ai,
                obs_dba,
                nombre,
                precio,
                id_marca
            ) VALUES (
                         p_id_usuario,
                         null,
                         now(),
                         null,
                         'activo',
                         null,
                         null,
                         null,
                         v_parametros.nombre,
                         v_parametros.precio,
                      v_parametros.id_marca
                      ) RETURNING id_producto into v_id_producto;


            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','insercion exitoso'||v_id_producto||')');
            v_resp = pxp.f_agrega_clave(v_resp,'v_id_producto',v_id_producto::varchar);

            --Devuelve la respuesta
            return v_resp;

        end;

        /*********************************
         #TRANSACCION:  'TIE_PRODUCTO_ELI'
         #DESCRIPCION:    eliminar producto
         #AUTOR:        Ivan Callapa Quiroz
         #FECHA:        17-04-2020 01:52:57
        ***********************************/

    elsif(p_transaccion='TIE_PRODUCTO_ELI')then

        begin
            DELETE from tie.tproducto
            where id_producto = v_parametros.id_producto;



            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','eliminado exitoso'||v_parametros.id_producto||')');
            v_resp = pxp.f_agrega_clave(v_resp,'v_id_marca',v_parametros.id_producto::varchar);

            --Devuelve la respuesta
            return v_resp;

        end;

        /*********************************
         #TRANSACCION:  'TIE_PRODUCTO_MOD'
         #DESCRIPCION:    modificar producto
         #AUTOR:        Ivan Callapa Quiroz
         #FECHA:        17-04-2020 01:52:57
        ***********************************/

    elsif(p_transaccion='TIE_PRODUCTO_MOD')then
        begin
            UPDATE tie.tproducto SET nombre = v_parametros.nombre,
                                     precio = v_parametros.precio,
                                  fecha_mod = now(),
                                  id_usuario_mod = p_id_usuario,
                                     id_marca = v_parametros.id_marca
            where id_producto = v_parametros.id_producto;


            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','modificado exitoso'||v_parametros.id_producto||')');
            v_resp = pxp.f_agrega_clave(v_resp,'v_id_marca',v_parametros.id_producto::varchar);

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
ALTER FUNCTION "tie"."ft_producto_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
