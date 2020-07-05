<?php
	include("../model/DAO/CarroDAO.php");
	$co=new CarroDAO();
	if (!$co) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	if (!is_numeric($_POST['ano']) OR $_POST['ano']<0) {
		throw new Exception("Por favor, digite um ano valido...", 1);
	}
	$chassi=$_POST['chassi'];
	$ano=$_POST['ano'];
	$modelo=$_POST['modelo'];
	$placa=$_POST['placa'];
	$caracteristicas=$_POST['caracteristicas'];
	echo $chassi.' - '.$ano.' - '.$modelo.' - '.$placa.' !!! ';
	//$co->deleteVeiculo($idVeiculo);
?> 