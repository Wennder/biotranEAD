<?php

require '../library/Biotran/AutoLoad.php';
 
Biotran_AutoLoad::registrar();
Biotran_Mvc::pegarInstancia()->rodar();

?>