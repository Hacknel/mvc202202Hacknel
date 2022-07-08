<?php
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
use Dao\Mnt\Candidatos;

/**
 * Candidato
 *
 * @category Public
 * @package  Controllers\Mnt;
 * @author   
 * @license  MIT http://
 * @link     http://
 */
class Candidato extends PublicController
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
        Renderer::render("mnt/Candidato", $this->viewData);
    }

    private function init()
    {
        $this->viewData = array();
        $this->viewData["mode"] = "";
        $this->viewData["mode_desc"] = "";
        $this->viewData["crsf_token"] = "";
        $this->viewData["Idcandidato"] = "";
        $this->viewData["Identidad"] = "";
$this->viewData["Nombre"] = "";
$this->viewData["Edad"] = "";

        $this->viewData["error_Identidad"] = array();
$this->viewData["error_Nombre"] = array();
$this->viewData["error_Edad"] = array();


        //$this->viewData["NOMBRE_LLAVE_DEL_ESTADO"] = ""; Descomentar en caso que la tabla tenga estados
        //$this->viewData["NOMBRE_LLAVE_DEL_ESTADOArr"] = array(); Descomentar en caso que la tabla tenga estados
      
        $this->viewData["btnEnviarText"] = "Guardar";
        $this->viewData["readonly"] = false;
        $this->viewData["showBtn"] = true;

        $this->arrModeDesc = array(
            "INS"=>"Nuevo Candidato",
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
                error_log("Error: (Candidato) Mode solicitado no existe.");
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_Candidatos",
                    "No se puede procesar su solicitud!"
                );
            }
        }
        if ($this->viewData["mode"] !== "INS" && isset($_GET["id"])) {
            $this->viewData["Idcandidato"] = intval($_GET["id"]);
            $tmpCandidatos = Candidatos::getById($this->viewData["Idcandidato"]);
            error_log(json_encode($tmpCandidatos));
            \Utilities\ArrUtils::mergeFullArrayTo($tmpCandidatos, $this->viewData);
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
                "index.php?page=mnt_Candidatos",
                "ERROR: Algo inesperado sucedió con la petición Intente de nuevo."
            );
        }

        if (Validators::IsEmpty($this->viewData["Identidad"])) {
$this->viewData["error_Identidad"][]
 = "El Identidad es requerido";
$hasErrors = true;
}

if (Validators::IsEmpty($this->viewData["Nombre"])) {
$this->viewData["error_Nombre"][]
 = "El Nombre es requerido";
$hasErrors = true;
}

if (Validators::IsEmpty($this->viewData["Edad"])) {
$this->viewData["error_Edad"][]
 = "El Edad es requerido";
$hasErrors = true;
}



        
        error_log(json_encode($this->viewData));
        // Ahora procedemos con las modificaciones al registro
        if (!$hasErrors) {
            $result = null;
            switch($this->viewData["mode"]) {
            case "INS":
                $result = Candidatos::insert(
                    $this->viewData["Identidad"],
$this->viewData["Nombre"],
$this->viewData["Edad"]
                );
                if ($result) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_Candidatos",
                            "Candidato Guardado Satisfactoriamente!"
                        );
                }
                break;
            case "UPD":
                $result = Candidatos::update(
                  $this->viewData["Idcandidato"],
$this->viewData["Identidad"],
$this->viewData["Nombre"],
$this->viewData["Edad"]
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt_Candidatos",
                        "Candidato Actualizado Satisfactoriamente"
                    );
                }
                break;
            case "DEL":
                $result = Candidatos::delete(
                    intval($this->viewData["Idcandidato"])
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt_Candidatos",
                        "Candidato Eliminado Satisfactoriamente"
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
                $this->viewData["Idcandidato"],
                $this->viewData["Identidad"]
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

      