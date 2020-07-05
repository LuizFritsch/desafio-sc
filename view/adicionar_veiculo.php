<?php
	include("../model/DAO/CarroDAO.php");
	$co=new CarroDAO();
	if (!$co) {
		echo json_encode(array('response' => 'erro ao conectar na base de dados'));
	}

	if (!isset($_REQUEST['caracteristicas'])) {
		echo json_encode(array('response' => 'selecione pelo menos duas caracteristicas...'));
		return false;
	}
	if (!isset($_POST['ano'])) {
		echo json_encode(array('response' => 'digite o ano por favor...'));
		return false;
	}
	if (!isset($_POST['chassi'])) {
		echo json_encode(array('response' => 'digite o chassi por favor...'));
		return false;
	}
	if (!isset($_POST['modelo'])) {
		echo json_encode(array('response' => 'selecione o modelo por favor...'));
		return false;
	}
	if (!isset($_POST['placa'])) {
		echo json_encode(array('response' => 'digite a placa por favor...'));
		return false;
	}


	foreach ($_REQUEST['caracteristicas'] as $selectedOption){
	    $caract[]=$selectedOption;
	}
	$ano=$_POST['ano'];
	$chassi=$_POST['chassi'];
	$modelo=$_POST['modelo'];
	$placa=$_POST['placa'];
	if (count($caract)<2) {
		echo json_encode(array('response' => 'selecione pelo menos duas caracteristicas...'));
		return false;
	}else if (!is_numeric($ano)) {
		echo json_encode(array('response' => 'ano esta incorreto...'));
		return false;
	}else if(strlen($placa)!=7){
		echo json_encode(array('response' => 'digite corretamente a placa...'));
		return false;
	}else if(strlen($chassi)!=17){
		echo json_encode(array('response' => 'digite corretamente o chassi...'));
		return false;
	}else{
		$co->InsertCarro($chassi,$modelo,$ano,$placa,$caract);	
	}
?>