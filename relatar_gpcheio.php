<?php
	$nomegp = $_POST['nomegp'];

	require_once("../../../wp-load.php");
	require_once("functions.php");

	$email = enviar_email('contato@trampe.xyz','Grupo Cheio: '.$nomegp, 'O seguinte grupo foi relatado como cheio: ' . $nomegp);
	if ($email)
	  	$results = array(
			'sucess' => 'true'
		);
	else 
		$results = array(
			'sucess' => 'false'
		);
  
  	echo json_encode($results);

?>