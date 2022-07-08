<?php

  /**
   * Hacknel Alexis Reyes 1001-2001-00363
   * Script Generador WW
   * 
   * Instrucciones para ejecutarlo.
   * 
   * 
   * Pasos previos -- 
   * En la variable @servername se debe especificar el servidor de BD con el que se trabajará.
   * En la variable @username se debe especificar el nombre de usuario con el que se accede a la base de datos.
   * En la variable @password se debe especificar la contraseña para acceder al servidor de base de datos.
   * En la variable @dbname se debe especificar el nombre de la base de datos donde se requiere obtener las tabla para generar el WW.
   * en la variable @table se debe espeficficar literalmente el nombre de la tabla a la que se desa generar el WW.
   * 
   * Ejecución --
   * En el archivo composer.json se debe agregar en la parte de scripts las siguientes lineas:
   * "post-install-cmd": [
   *     "@php ./docs/scripts/scriptWW.php"
   * ]
   * Depende del directorio en donde este archivo está alojado se pondrá en la ruta de composer.json
   * Al momento de correrlo se debe ejecutar con: php composer.phar install
   * 
   * Creará todos los archivos básicos de un WW.
   * 
   * Nota: en las creaciones de archivos de las lineas posteriores a la finalización de cada elemento de puede
   * especificar la ruta donde quiere que se genere el archivo de salida.
   * 
   */

      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "nw202202";
      $table = "candidatos";
      $errors = "";
      $arrColumns = array();

      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql = "DESCRIBE ".$table;
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          $arrColumns = $result->fetch_all();
      } else {
        $errors .= "0 results in select description of table \n";
      }
      $conn->close();

      /**
       * Variables generales para clases y nombres.
       */

       //Valida si la tabla no tiene s
      if (substr($table, strlen($table)-1) != "s") {
        $className = ucfirst($table)."s"; 
        $tableWithOut_s = ucfirst($table);
      }
      else{
        $className = ucfirst($table);
        $tableWithOut_s = substr($className, 0, -1);
      }

      function imprimirTabla($indexStart, $arrColumns, $toConcatStart, $toConcatEnd){
         $str = "";
        for ($i=$indexStart; $i < count($arrColumns); $i++) { 
          $str .= $toConcatStart.$arrColumns[$i][0].$toConcatEnd;
       }
       return $str;
       }
       function imprimirTablaParams($indexStart, $arrColumns, $toConcatStart, $toConcatMid, $toConcatEnd){
        $str = "";
       for ($i=$indexStart; $i < count($arrColumns); $i++) { 
         $str .= $toConcatStart.$arrColumns[$i][0].$toConcatMid.$arrColumns[$i][0].$toConcatEnd;
      }
      return $str;
      }
      function imprimirTablaValidation($indexStart, $arrColumns, $toConcatStart, $toConcatMid, $toConcatMidMsg, $toConcatEnd){
        $str = "";
       for ($i=$indexStart; $i < count($arrColumns); $i++) { 
         $str .= $toConcatStart.$arrColumns[$i][0].$toConcatMid.$arrColumns[$i][0].$toConcatMidMsg.$arrColumns[$i][0].$toConcatEnd;
      }
      return $str;
      }
      function imprimirTablaForm($indexStart, $arrColumns, $toConcatStart, $toConcat1, $toConcat2, $toConcat3, $toConcat4,
      $toConcat5, $toConcat6, $toConcat7, $toConcat8, $toConcat9, $toConcatEnd){
        $str = "";
       for ($i=$indexStart; $i < count($arrColumns); $i++) {
         $str .= $toConcatStart.$arrColumns[$i][0].
                 $toConcat1.$arrColumns[$i][0].
                 $toConcat2.$arrColumns[$i][0].
                 $toConcat3.$arrColumns[$i][0].
                 $toConcat4.$arrColumns[$i][0].
                 $toConcat5.$arrColumns[$i][0].
                 $toConcat6.$arrColumns[$i][0].
                 $toConcat7.$arrColumns[$i][0].
                 $toConcat8.$arrColumns[$i][0].
                 $toConcat9.$arrColumns[$i][0].
                 $toConcatEnd;
      }
      return $str;
      }

      /**
       * DAO 
       */

      $strToGenerateDAO = '<?php
      
      namespace Dao\Mnt;
      
      use Dao\Table;
      
      /**
       * Modelo de Datos para la tabla de '.$tableWithOut_s.'
       *
       * @category Data_Model
       * @package  Dao.Table
       * @author   
       * @license  Comercial http://
       *
       * @link http://url.com
      */
      class '.$className.' extends Table
      {
          /*
          Tabla a generar:
          '.sprintf(imprimirTabla(0, $arrColumns, "", "\n")).'
          */
          /**
           * Obtiene todos los registros de '.$className.'
           *
           * @return array
           */
          public static function getAll()
          {
              $sqlstr = "Select * from '.$table.';";
              return self::obtenerRegistros($sqlstr, array());
          }
      
          /**
           * Get '.$className.' By Id
           *
           * @param int $'.$arrColumns[0][0].' Codigo del '.$className.'
           *
           * @return array
           */
          public static function getById(int $'.$arrColumns[0][0].')
          {
              $sqlstr = "SELECT * from `'.$table.'` where '.$arrColumns[0][0].'=:'.$arrColumns[0][0].';";
              $sqlParams = array("'.$arrColumns[0][0].'" => $'.$arrColumns[0][0].');
              return self::obtenerUnRegistro($sqlstr, $sqlParams);
          }
      
          /**
           * Insert into '.$className.'
           */
          public static function insert(
            '.sprintf(substr(imprimirTabla(1, $arrColumns, "$", ",\n"), 0, -2)).'
          ) {
              $sqlstr = "INSERT INTO `'.$table.'`
      ('.sprintf(substr(imprimirTabla(1, $arrColumns, "`", "`,\n"), 0, -2)).')
      VALUES
      ('.sprintf(substr(imprimirTabla(1, $arrColumns, ":", ",\n"), 0, -2)).');
      ";
              $sqlParams = [
                  '.sprintf(substr(imprimirTablaParams(1, $arrColumns, '"', '" => $', ",\n"), 0, -2)).'
              ];
              return self::executeNonQuery($sqlstr, $sqlParams);
          }
          /**
           * Updates '.$className.'
           */
          public static function update(
            '.sprintf(substr(imprimirTabla(0, $arrColumns, "$", ",\n"), 0, -2)).'
          ) {
              $sqlstr = "UPDATE `'.$table.'` set 
      '.sprintf(substr(imprimirTablaParams(1, $arrColumns, '`', '`=:', ",\n"), 0, -2)).'
      where `'.$arrColumns[0][0].'` =:'.$arrColumns[0][0].';";
              $sqlParams = [
                '.sprintf(substr(imprimirTablaParams(0, $arrColumns, '"', '" => $', ",\n"), 0, -2)).'
              ];
              return self::executeNonQuery($sqlstr, $sqlParams);
          }
      
          /**
           * Undocumented function
           *
           * @param [type] $'.$arrColumns[0][0].' Codigo del '.$className.'
           *
           * @return void
           */
          public static function delete($'.$arrColumns[0][0].')
          {
              $sqlstr = "DELETE from `'.$table.'` where '.$arrColumns[0][0].'=:'.$arrColumns[0][0].';";
              $sqlParams = array(
                  "'.$arrColumns[0][0].'" => $'.$arrColumns[0][0].'
              );
              return self::executeNonQuery($sqlstr, $sqlParams);
          }
      
      }
      
      ?>';

      $fp = fopen('src/Dao/Mnt/'.$className.'.php', 'w');
      fwrite($fp, $strToGenerateDAO);
      fclose($fp);

      /**
       * Controllers/Mnt/ListadorTabla
       */

      $strToGenerateControllerTable = '<?php
      /**
       * PHP Version 7.2
       * Mnt
       *
       * @category Controller
       * @package  Controllers\Mnt
       * @author   
       * @license  Comercial http://
       * @version  CVS:1.0.0
       * @link     http://url.com
       */
       namespace Controllers\Mnt;
      
      // ---------------------------------------------------------------
      // Sección de imports
      // ---------------------------------------------------------------
      use Controllers\PublicController;
      use Dao\Mnt\\'.$className.' as Dao'.$className.';
      use Views\Renderer;
      
      /**
       * '.$className.'
       *
       * @category Public
       * @package  Controllers\Mnt;
       * @author   
       * @license  MIT http://
       * @link     http://
       */
      class '.$className.' extends PublicController
      {
          /**
           * Runs the controller
           *
           * @return void
           */
          public function run():void
          {
              // code
              $viewData = array();
              $viewData["'.$className.'"] = Dao'.$className.'::getAll();
              error_log(json_encode($viewData));
            
              Renderer::render("mnt/'.$className.'", $viewData);
          }
      }
      
      ?>
      ';

      $fp = fopen('src/Controllers/Mnt/'.$className.'.php', 'w');
      fwrite($fp, $strToGenerateControllerTable);
      fclose($fp);


      /**
       * Controllers/Mnt/ControladorForm
       */

      $strToGenerateControllerForm = '<?php
/**
 * PHP Version 7.2
 * Mnt
 *
 * @category Controller
 * @package  Controllers\Mnt
 * @author   
 * @license  Comercial http://
 * @version  CVS:1.0.0
 * @link     http://url.com
 */
 namespace Controllers\Mnt;

// ---------------------------------------------------------------
// Sección de imports
// ---------------------------------------------------------------
use Controllers\PublicController;
use Views\Renderer;
use Utilities\Validators;
use Dao\Mnt\\'.$className.';

/**
 * '.$tableWithOut_s.'
 *
 * @category Public
 * @package  Controllers\Mnt;
 * @author   
 * @license  MIT http://
 * @link     http://
 */
class '.$tableWithOut_s.' extends PublicController
{
    private $viewData = array();
    private $arrModeDesc = array();
    //private $arrEstados = array(); Descomentar en caso que la tabla tenga estados

    /**
     * Runs the controller
     *
     * @return void
     */
    public function run():void
    {
        // code
        $this->init();
        // Cuando es método GET (se llama desde la lista)
        if (!$this->isPostBack()) {
            $this->procesarGet();
        }
        // Cuando es método POST (click en el botón)
        if ($this->isPostBack()) {
            $this->procesarPost();
        }
        // Ejecutar Siempre
        $this->processView();
        Renderer::render("mnt/'.$tableWithOut_s.'", $this->viewData);
    }

    private function init()
    {
        $this->viewData = array();
        $this->viewData["mode"] = "";
        $this->viewData["mode_desc"] = "";
        $this->viewData["crsf_token"] = "";
        $this->viewData["'.$arrColumns[0][0].'"] = "";
        '.sprintf(imprimirTabla(1, $arrColumns, '$this->viewData["', '"] = "";'."\n")).'
        '.sprintf(imprimirTabla(1, $arrColumns, '$this->viewData["error_', '"] = array();'."\n")).'

        //$this->viewData["NOMBRE_LLAVE_DEL_ESTADO"] = ""; Descomentar en caso que la tabla tenga estados
        //$this->viewData["NOMBRE_LLAVE_DEL_ESTADOArr"] = array(); Descomentar en caso que la tabla tenga estados
      
        $this->viewData["btnEnviarText"] = "Guardar";
        $this->viewData["readonly"] = false;
        $this->viewData["showBtn"] = true;

        $this->arrModeDesc = array(
            "INS"=>"Nuevo '.$tableWithOut_s.'",
            "UPD"=>"Editando %s %s",
            "DSP"=>"Detalle de %s %s",
            "DEL"=>"Eliminado %s %s"
        );

        // $this->arrEstados = array(  Descomentar en caso que la tabla tenga estados
        //     array("value" => "ACT", "text" => "Activo"),
        //     array("value" => "INA", "text" => "Inactivo"),
        // );

        // $this->viewData["NOMBRE_LLAVE_DEL_ESTADOArr"] = $this->arrEstados; Descomentar en caso que la tabla tenga estados

    }

    private function procesarGet()
    {
        if (isset($_GET["mode"])) {
            $this->viewData["mode"] = $_GET["mode"];
            if (!isset($this->arrModeDesc[$this->viewData["mode"]])) {
                error_log("Error: ('.$tableWithOut_s.') Mode solicitado no existe.");
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_'.$className.'",
                    "No se puede procesar su solicitud!"
                );
            }
        }
        if ($this->viewData["mode"] !== "INS" && isset($_GET["id"])) {
            $this->viewData["'.$arrColumns[0][0].'"] = intval($_GET["id"]);
            $tmp'.$className.' = '.$className.'::getById($this->viewData["'.$arrColumns[0][0].'"]);
            error_log(json_encode($tmp'.$className.'));
            \Utilities\ArrUtils::mergeFullArrayTo($tmp'.$className.', $this->viewData);
        }
    }
    private function procesarPost()
    {
        // Validar la entrada de Datos
        //  Todos valor puede y sera usando en contra del sistema
        $hasErrors = false;
        \Utilities\ArrUtils::mergeArrayTo($_POST, $this->viewData);
        if (isset($_SESSION[$this->name . "crsf_token"])
            && $_SESSION[$this->name . "crsf_token"] !== $this->viewData["crsf_token"]
        ) {
            \Utilities\Site::redirectToWithMsg(
                "index.php?page=mnt_'.$className.'",
                "ERROR: Algo inesperado sucedió con la petición Intente de nuevo."
            );
        }

        '.sprintf(imprimirTablaValidation(1, $arrColumns, 'if (Validators::IsEmpty($this->viewData["', '"])) {'."\n".
            '$this->viewData["error_', '"][]'."\n".
              ' = "El ', ' es requerido";'."\n".
              '$hasErrors = true;'."\n".
        '}'."\n\n")).'

        
        error_log(json_encode($this->viewData));
        // Ahora procedemos con las modificaciones al registro
        if (!$hasErrors) {
            $result = null;
            switch($this->viewData["mode"]) {
            case "INS":
                $result = '.$className.'::insert(
                    '.sprintf(substr(imprimirTabla(1, $arrColumns, '$this->viewData["', '"],'."\n"), 0, -2)).'
                );
                if ($result) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_'.$className.'",
                            "'.$tableWithOut_s.' Guardado Satisfactoriamente!"
                        );
                }
                break;
            case "UPD":
                $result = '.$className.'::update(
                  '.sprintf(substr(imprimirTabla(0, $arrColumns, '$this->viewData["', '"],'."\n"), 0, -2)).'
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt_'.$className.'",
                        "'.$tableWithOut_s.' Actualizado Satisfactoriamente"
                    );
                }
                break;
            case "DEL":
                $result = '.$className.'::delete(
                    intval($this->viewData["'.$arrColumns[0][0].'"])
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt_'.$className.'",
                        "'.$tableWithOut_s.' Eliminado Satisfactoriamente"
                    );
                }
                break;
            }
        }
    }

    private function processView()
    {
        if ($this->viewData["mode"] === "INS") {
            $this->viewData["mode_desc"]  = $this->arrModeDesc["INS"];
            $this->viewData["btnEnviarText"] = "Guardar Nuevo";
        } else {
            $this->viewData["mode_desc"]  = sprintf(
                $this->arrModeDesc[$this->viewData["mode"]],
                $this->viewData["'.$arrColumns[0][0].'"],
                $this->viewData["'.$arrColumns[1][0].'"]
            );
            // $this->viewData["NOMBRE_LLAVE_DEL_ESTADOArr"]  Descomentar en caso que la tabla tenga estados
            //     = \Utilities\ArrUtils::objectArrToOptionsArray(
            //         $this->arrEstados,
            //         "value",
            //         "text",
            //         "value",
            //         $this->viewData["NOMBRE_LLAVE_DEL_ESTADO"]
            //     );
            
            if ($this->viewData["mode"] === "DSP") {
                $this->viewData["readonly"] = true;
                $this->viewData["showBtn"] = false;
            }
            if ($this->viewData["mode"] === "DEL") {
                $this->viewData["readonly"] = true;
                $this->viewData["btnEnviarText"] = "Eliminar";
            }
            if ($this->viewData["mode"] === "UPD") {
                $this->viewData["btnEnviarText"] = "Actualizar";
            }
        }
        $this->viewData["crsf_token"] = md5(getdate()[0] . $this->name);
        $_SESSION[$this->name . "crsf_token"] = $this->viewData["crsf_token"];
    }
}

      ';

      $fp = fopen('src/Controllers/Mnt/'.$tableWithOut_s.'.php', 'w');
      fwrite($fp, $strToGenerateControllerForm);
      fclose($fp);

      /**
       * Plantilla de lista
      */

      $strToGeneratePlantillaLista = '

      <h1>Trabajar con '.$className.' </h1>
      <section>
      </section>
      <section>
        <table>
          <thead>
            <tr>
            '.sprintf(imprimirTabla(0, $arrColumns, "<th>", "</th>\n")).'
              <th><a href="index.php?page=Mnt-'.$tableWithOut_s.'&mode=INS">Nuevo</a></th>
            </tr>
          </thead>
          <tbody>
            {{foreach '.$className.'}}
            <tr>
              <td>{{'.$arrColumns[0][0].'}}</td>
              <td> <a href="index.php?page=Mnt-'.$tableWithOut_s.'&mode=DSP&id={{'.$arrColumns[0][0].'}}">{{'.$arrColumns[1][0].'}}</a></td>
              '.sprintf(imprimirTabla(2, $arrColumns, "<td>{{", "}}</td>\n")).'
              <td>
                <a href="index.php?page=Mnt-'.$tableWithOut_s.'&mode=UPD&id={{'.$arrColumns[0][0].'}}">Editar</a>
                &NonBreakingSpace;
                <a href="index.php?page=Mnt-'.$tableWithOut_s.'&mode=DEL&id={{'.$arrColumns[0][0].'}}">Eliminar</a>
              </td>
            </tr>
            {{endfor '.$className.'}}
          </tbody>
        </table>
      </section>
      ';

      $fp = fopen('src/Views/templates/mnt/'.$className.'.view.tpl', 'w');
      fwrite($fp, $strToGeneratePlantillaLista);
      fclose($fp);

      /**
       * Plantilla de formulario
      */

      $strToGeneratePlantillaFormulario = '
      <h1>{{mode_desc}}</h1>
      <section>
        <form action="index.php?page=mnt_'.$tableWithOut_s.'" method="post">
          <input type="hidden" name="mode" value="{{mode}}" />
          <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
          <input type="hidden" name="'.$arrColumns[0][0].'" value="{{'.$arrColumns[0][0].'}}" />

          '.sprintf(imprimirTablaForm(1, $arrColumns, 
          '<fieldset>'."\n".
          '<label for="', '">', '</label>'."\n".
          '<input {{if readonly}} readonly {{endif readonly}} type="text" id="','" name="', '" placeholder="', '" value="{{', '}}" />'."\n".
          '{{if error_','}}'."\n".
          '{{foreach error_', '}}'."\n".
          '<div class="error">{{this}}</div>'."\n".
          '{{endfor error_', '}}'."\n".
          '{{endif error_','}}'."\n".
          '</fieldset>'."\n\n")).'

          <!-- 
          <fieldset>    Descomentar en caso que la tabla tenga estados
            <label for="scoreest">Estado</label>
            <select name="scoreest" id="scoreest" {{if readonly}} readonly disabled {{endif readonly}}>
              {{foreach scoreestArr}}
              <option value="{{value}}" {{selected}}>{{text}}</option>
              {{endfor scoreestArr}}
            </select>
          </fieldset> 
          -->

          <fieldset>
            {{if showBtn}}
            <button type="submit" name="btnEnviar">{{btnEnviarText}}</button>
            &nbsp;
            {{endif showBtn}}
            <button name="btnCancelar" id="btnCancelar">Cancelar</button>
          </fieldset>
        </form>
      </section>
      <script>
        document.addEventListener("DOMContentLoaded", function(){ document.getElementById("btnCancelar").addEventListener("click", function(e){ e.preventDefault(); e.stopPropagation();
        window.location.href = "index.php?page=mnt_'.$className.'"; }); });
      </script>
      ';

      $fp = fopen('src/Views/templates/mnt/'.$tableWithOut_s.'.view.tpl', 'w');
      fwrite($fp, $strToGeneratePlantillaFormulario);
      fclose($fp);
          ?>