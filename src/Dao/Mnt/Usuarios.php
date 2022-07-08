<?php
      
      namespace Dao\Mnt;
      
      use Dao\Table;
      
      /**
       * Modelo de Datos para la tabla de Usuario
       *
       * @category Data_Model
       * @package  Dao.Table
       * @author   
       * @license  Comercial http://
       *
       * @link http://url.com
      */
      class Usuarios extends Table
      {
          /*
          Tabla a generar:
          usercod
useremail
username
userpswd
userfching
userpswdest
userpswdexp
userest
useractcod
userpswdchg
usertipo

          */
          /**
           * Obtiene todos los registros de Usuarios
           *
           * @return array
           */
          public static function getAll()
          {
              $sqlstr = "Select * from usuario;";
              return self::obtenerRegistros($sqlstr, array());
          }
      
          /**
           * Get Usuarios By Id
           *
           * @param int $usercod Codigo del Usuarios
           *
           * @return array
           */
          public static function getById(int $usercod)
          {
              $sqlstr = "SELECT * from `usuario` where usercod=:usercod;";
              $sqlParams = array("usercod" => $usercod);
              return self::obtenerUnRegistro($sqlstr, $sqlParams);
          }
      
          /**
           * Insert into Usuarios
           */
          public static function insert(
            $useremail,
$username,
$userpswd,
$userfching,
$userpswdest,
$userpswdexp,
$userest,
$useractcod,
$userpswdchg,
$usertipo
          ) {
              $sqlstr = "INSERT INTO `usuario`
      (`useremail`,
`username`,
`userpswd`,
`userfching`,
`userpswdest`,
`userpswdexp`,
`userest`,
`useractcod`,
`userpswdchg`,
`usertipo`)
      VALUES
      (:useremail,
:username,
:userpswd,
:userfching,
:userpswdest,
:userpswdexp,
:userest,
:useractcod,
:userpswdchg,
:usertipo);
      ";
              $sqlParams = [
                  "useremail" => $useremail,
"username" => $username,
"userpswd" => $userpswd,
"userfching" => $userfching,
"userpswdest" => $userpswdest,
"userpswdexp" => $userpswdexp,
"userest" => $userest,
"useractcod" => $useractcod,
"userpswdchg" => $userpswdchg,
"usertipo" => $usertipo
              ];
              return self::executeNonQuery($sqlstr, $sqlParams);
          }
          /**
           * Updates Usuarios
           */
          public static function update(
            $usercod,
$useremail,
$username,
$userpswd,
$userfching,
$userpswdest,
$userpswdexp,
$userest,
$useractcod,
$userpswdchg,
$usertipo
          ) {
              $sqlstr = "UPDATE `usuario` set 
      `useremail`=:useremail,
`username`=:username,
`userpswd`=:userpswd,
`userfching`=:userfching,
`userpswdest`=:userpswdest,
`userpswdexp`=:userpswdexp,
`userest`=:userest,
`useractcod`=:useractcod,
`userpswdchg`=:userpswdchg,
`usertipo`=:usertipo
      where `usercod` =:usercod;";
              $sqlParams = [
                "usercod" => $usercod,
"useremail" => $useremail,
"username" => $username,
"userpswd" => $userpswd,
"userfching" => $userfching,
"userpswdest" => $userpswdest,
"userpswdexp" => $userpswdexp,
"userest" => $userest,
"useractcod" => $useractcod,
"userpswdchg" => $userpswdchg,
"usertipo" => $usertipo
              ];
              return self::executeNonQuery($sqlstr, $sqlParams);
          }
      
          /**
           * Undocumented function
           *
           * @param [type] $usercod Codigo del Usuarios
           *
           * @return void
           */
          public static function delete($usercod)
          {
              $sqlstr = "DELETE from `usuario` where usercod=:usercod;";
              $sqlParams = array(
                  "usercod" => $usercod
              );
              return self::executeNonQuery($sqlstr, $sqlParams);
          }
      
      }
      
      ?>