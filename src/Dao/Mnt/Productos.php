<?php
/**
 * PHP Version 7
 * Modelo de Datos para modelo
 *
 * @category Data_Model
 * @package  Models${1:modelo}
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @version 1.0.0
 *
 * @link http://url.com
 */

namespace Dao\Mnt;

use Dao\Table;

/**
 * Modelo de Datos para la tabla de Productos
 *
 * @category Data_Model
 * @package  Dao.Table
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @link http://url.com
*/
class Productos extends Table
{
    /*
        `invPrdId` bigint(13) NOT NULL AUTO_INCREMENT,
        `invPrdBrCod` varchar(128) DEFAULT NULL,
        `invPrdCodInt` varchar(128) DEFAULT NULL,
        `invPrdDsc` varchar(128) DEFAULT NULL,
        `invPrdTip` char(3) DEFAULT NULL,
        `invPrdEst` char(3) DEFAULT NULL,
        `invPrdPadre` bigint(13) DEFAULT NULL,
        `invPrdFactor` int(11) DEFAULT NULL,
        `invPrdVnd` char(3) DEFAULT NULL,
    */
    /**
     * Obtiene todos los registros de Productos
     *
     * @return array
     */
    public static function getAll()
    {
        $sqlstr = "Select * from productos;";
        return self::obtenerRegistros($sqlstr, array());
    }

    public static function getAllByFilter($description, $minprice, $maxprice)
    {
        $sqlstr = "select * from productos ";   
        $description = strtolower($description);

        if ($description != "" || $minprice != "" || $maxprice != "") {
            $sqlstr .="WHERE ";
        }

        if ($description != ""){
            $sqlstr .= "lower(invPrdDsc) like '$description%'";
            if ($minprice != "" || $maxprice != "") {
                $sqlstr .= " and ";
            }
        }
  
        if ($minprice != ""){
            $sqlstr .= "invPrdPrice >= $minprice ";
            if ($maxprice != "") {
                $sqlstr .= " and ";
            }
        }

        if ($maxprice != ""){
            $sqlstr .= "invPrdPrice <= $maxprice ";
        }

        $sqlstr .= ";";

        return self::obtenerRegistros($sqlstr, array());
    }

    /**
     * Get Producto By Id
     *
     * @param int $invPrdId Codigo del Producto
     *
     * @return array
     */
    public static function getById(int $invPrdId)
    {
        $sqlstr = "SELECT * from `productos` where invPrdId=:invPrdId;";
        $sqlParams = array("invPrdId" => $invPrdId);
        return self::obtenerUnRegistro($sqlstr, $sqlParams);
    }

    /**
     * Insert into Productos
     *
     * @param [type] $invPrdBrCod  description
     * @param [type] $invPrdCodInt description
     * @param [type] $invPrdDsc    description
     * @param [type] $invPrdTip    description
     * @param [type] $invPrdEst    description
     * @param [type] $invPrdPadre  description
     * @param [type] $invPrdFactor description
     * @param [type] $invPrdVnd    description
     *
     * @return void
     */
    public static function insert(
        $invPrdBrCod,
        $invPrdCodInt,
        $invPrdDsc,
        $invPrdTip,
        $invPrdEst,
        $invPrdPadre,
        $invPrdFactor,
        $invPrdVnd,
        $invPrdPrice,
        $invPrdImg
    ) {
        $sqlstr = "INSERT INTO `productos`
(`invPrdBrCod`, `invPrdCodInt`,
`invPrdDsc`, `invPrdTip`, `invPrdEst`,
`invPrdPadre`, `invPrdFactor`, `invPrdVnd`, `invPrdPrice`, `invPrdImg`)
VALUES
(:invPrdBrCod, :invPrdCodInt,
:invPrdDsc, :invPrdTip, :invPrdEst,
:invPrdPadre, :invPrdFactor, :invPrdVnd, :invPrdPrice, :invPrdImg);
";
        $sqlParams = [
            "invPrdBrCod" => $invPrdBrCod ,
            "invPrdCodInt" => $invPrdCodInt ,
            "invPrdDsc" => $invPrdDsc ,
            "invPrdTip" => $invPrdTip ,
            "invPrdEst" => $invPrdEst ,
            "invPrdPadre" => $invPrdPadre ,
            "invPrdFactor" =>  $invPrdFactor ,
            "invPrdVnd" => $invPrdVnd ,
            "invPrdPrice" => $invPrdPrice ,
            "invPrdImg" => $invPrdImg
        ];
        return self::executeNonQuery($sqlstr, $sqlParams);
    }
    /**
     * Updates productos
     *
     * @param [type] $invPrdBrCod  description
     * @param [type] $invPrdCodInt description
     * @param [type] $invPrdDsc    description
     * @param [type] $invPrdTip    description
     * @param [type] $invPrdEst    description
     * @param [type] $invPrdPadre  description
     * @param [type] $invPrdFactor description
     * @param [type] $invPrdVnd    description
     * @param [type] $invPrdId     description
     *
     * @return void
     */
    public static function update(
        $invPrdBrCod,
        $invPrdCodInt,
        $invPrdDsc,
        $invPrdTip,
        $invPrdEst,
        $invPrdPadre,
        $invPrdFactor,
        $invPrdVnd,
        $invPrdPrice,
        $invPrdImg,
        $invPrdId
    ) {
        $sqlstr = "UPDATE `productos` set
`invPrdBrCod`=:invPrdBrCod, `invPrdCodInt`=:invPrdCodInt,
`invPrdDsc`=:invPrdDsc, `invPrdTip`=:invPrdTip, `invPrdEst`=:invPrdEst,
`invPrdPadre`=:invPrdPadre, `invPrdFactor`=:invPrdFactor, `invPrdVnd`=:invPrdVnd, `invPrdPrice`=:invPrdPrice, `invPrdImg`=:invPrdImg where `invPrdId` = :invPrdId;";
        $sqlParams = [
            "invPrdBrCod" => $invPrdBrCod ,
            "invPrdCodInt" => $invPrdCodInt ,
            "invPrdDsc" => $invPrdDsc ,
            "invPrdTip" => $invPrdTip ,
            "invPrdEst" => $invPrdEst ,
            "invPrdPadre" => $invPrdPadre ,
            "invPrdFactor" =>  $invPrdFactor ,
            "invPrdVnd" => $invPrdVnd,
            "invPrdPrice" => $invPrdPrice,
            "invPrdImg" => $invPrdImg,
            "invPrdId" => $invPrdId
        ];
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    /**
     * Undocumented function
     *
     * @param [type] $invPrdId description
     *
     * @return void
     */
    public static function delete($invPrdId)
    {
        $sqlstr = "DELETE from `productos` where invPrdId = :invPrdId;";
        $sqlParams = array(
            "invPrdId" => $invPrdId
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

}
