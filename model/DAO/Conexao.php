<?php
/**
 * 
 */
class Conexao{
	public function abreConexao(){
		$link = mysqli_connect("localhost", "root", "", "luizfritsch");
	 
		if (!$link) {
		    echo "Error: Falha ao conectar-se com o banco de dados MySQL." . PHP_EOL;
		    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		    exit;
		}

		return $link;
	}

	public function fechaConexao($link){
		mysqli_close($link);
	}
	
}

?> 