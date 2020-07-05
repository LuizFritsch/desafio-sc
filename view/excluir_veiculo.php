<?php
	include("../model/DAO/CarroDAO.php");
	$co=new CarroDAO();
	if (!$co) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$idVeiculo=$_POST['idVeiculo'];
	$co->deleteVeiculo($idVeiculo);
?> 