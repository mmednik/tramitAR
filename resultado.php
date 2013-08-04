<?php 
	include('lib/class.MySQL.php');
	$oMySQL = new MySQL('tramites','root','mysql');
	$resultSearch = $oMySQL->ExecuteSQL('SELECT idtramites FROM tramites WHERE titulo ="' . $_POST['datum'] . '"');
	$html = intval($resultSearch['idtramites']);
	//$html = 'SELECT idtramites FROM tramites WHERE titulo ="' . $_POST['datum'] . '"';
	echo $html;
?>
    
      

  

     