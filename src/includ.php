<?php
require("function.php");
define("SRC", dirname(__FILE__));
define("ROOT", dirname(SRC));
var_dump(__FILE__);
define("SP",DIRECTORY_SEPARATOR);
define("MODEL", ROOT.SP."model");
define("VIEWS",ROOT.SP."views");
// var_dump(array("MODEL","VIEWS"));






?>