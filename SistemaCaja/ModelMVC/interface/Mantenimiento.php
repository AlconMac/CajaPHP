<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Luis
 */
interface Mantenimiento {
   public static function Sql(thisClass $Objeto);
   public static function Guardar(thisClass $oObjeto);
   public static function Buscar(thisClass $oObjeto);
   public static function Actualizar(thisClass $oObjeto);
   public static function Eliminar(thisClass $oObjeto);
   public static function Listar(thisClass $oObjeto);
}

?>
