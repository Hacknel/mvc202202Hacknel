<?php

 namespace Controllers\Mnt;

use Controllers\PublicController;
use Dao\Mnt\Productos as DaoProductos;
use Views\Renderer;

class Catalogo extends PublicController
{
    public function run():void
    {
        $this->viewData = array();
        $this->viewData["crsf_token"] = "";

        $this->viewData["invPrdDsc"] = "";
        $this->viewData["doubleBasePrice"] = "";
        $this->viewData["doubleMaxPrice"] = "";

        if ($this->isPostBack()) {
            \Utilities\ArrUtils::mergeArrayTo($_POST, $this->viewData);

            if (isset($_SESSION[$this->name . "crsf_token"])
                && $_SESSION[$this->name . "crsf_token"] !== $this->viewData["crsf_token"]
            ) {
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_catalogo",
                    "ERROR: Algo inesperado sucedió con la petición Intente de nuevo."
                );
            }

            $this->viewData ["Productos"] = DaoProductos::getAllByFilter(
            $this->viewData["invPrdDsc"],
            $this->viewData["doubleBasePrice"],
            $this->viewData["doubleMaxPrice"]);
        }else{
            $this->viewData ["Productos"] = DaoProductos::getAll();
        }

        $this->viewData["crsf_token"] = md5(getdate()[0] . $this->name);
        $_SESSION[$this->name . "crsf_token"] = $this->viewData["crsf_token"];
        
        Renderer::render('mnt/catalogo', $this->viewData );
    }
}

?>