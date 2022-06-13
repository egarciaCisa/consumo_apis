<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/ruta.controlador.php";

require_once "controladores/administradores.controlador.php";
require_once "modelos/administradores.modelo.php";

require_once "controladores/tyrecheck.controlador.php";
require_once "modelos/tyrecheck.modelo.php";

require_once "controladores/cloudcore.controlador.php";
require_once "modelos/cloudcore.modelo.php";

require_once "controladores/inicio.controlador.php";
require_once "modelos/inicio.modelo.php";


$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();