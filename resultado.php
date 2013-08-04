<?php 
	include('lib/class.MySQL.php');
	$oMySQL = new MySQL('tramites','***','***');
	$resultSearch = $oMySQL->ExecuteSQL('SELECT idtramites FROM tramites WHERE titulo ="' . $_POST['datum'] . '"');
	$html = intval($resultSearch['idtramites']);
	echo $html;
?>
    
      

  

     
