<?php
      
      namespace Dao\Mnt;
      
      use Dao\Table;
      
      /**
       * Modelo de Datos para la tabla de Candidato
       *
       * @category Data_Model
       * @package  Dao.Table
       * @author   
       * @license  Comercial http://
       *
       * @link http://url.com
      */
      class Candidatos extends Table
      {
          /**
           * Obtiene todos los registros de Candidatos
           *
           * @return array
           */
          public static function getAll()
          {
              $sqlstr = "Select * from candidatos;";
              return self::obtenerRegistros($sqlstr, array());
          }
      
          /**
           * Get Candidatos By Id
           *
           * @param int $Idcandidato Codigo del Candidatos
           *
           * @return array
           */
          public static function getById(int $Idcandidato)
          {
              $sqlstr = "SELECT * from `candidatos` where Idcandidato=:Idcandidato;";
              $sqlParams = array("Idcandidato" => $Idcandidato);
              return self::obtenerUnRegistro($sqlstr, $sqlParams);
          }
      
          /**
           * Insert into Candidatos
           */
          public static function insert(
            $Identidad,
            $Nombre,
            $Edad
          ) {
              $sqlstr = "INSERT INTO `candidatos`
                (`Identidad`, `Nombre`, `Edad`)
                VALUES
                (:Identidad, :Nombre, :Edad);";
              $sqlParams = [
                  "Identidad" => $Identidad, 
                  "Nombre" => $Nombre,
                  "Edad" => $Edad
              ];
              return self::executeNonQuery($sqlstr, $sqlParams);
          }
          /**
           * Updates Candidatos
           */
          public static function update(
            $Idcandidato, $Identidad, $Nombre, $Edad
          ) {
              $sqlstr = "UPDATE `candidatos` set 
            `Identidad`=:Identidad, 
            `Nombre`=:Nombre,
            `Edad`=:Edad
            where `Idcandidato` =:Idcandidato;";
              $sqlParams = [
                "Idcandidato" => $Idcandidato,
                "Identidad" => $Identidad,
                "Nombre" => $Nombre,
                "Edad" => $Edad
              ];
              return self::executeNonQuery($sqlstr, $sqlParams);
          }
      
          /**
           *
           * @param [type] $Idcandidato Codigo del Candidatos
           *
           * @return void
           */
          public static function delete($Idcandidato)
          {
              $sqlstr = "DELETE from `candidatos` where Idcandidato=:Idcandidato;";
              $sqlParams = array(
                  "Idcandidato" => $Idcandidato
              );
              return self::executeNonQuery($sqlstr, $sqlParams);
          }
      
      }
      
      ?>