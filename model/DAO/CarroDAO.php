<?php include("../model/Carro.php")?>
<?php
include ("conexao.php");

class CarroDAO{

    public function InsertCarro(Carro $carro){

        $cona = new Conexao();
        $con=$cona->abreConexao();


        $SQL = $con->prepare("INSERT INTO carro (id,nmr_chassi,fk_modelo,ano,placa) VALUES (?, ?, ?, ?, ?)") or die ($mysqli->error);

        $SQL->bind_param("isiis", null, $carro->getNmrChassi(), $carro->getModelo(),  $carro->getAno(), $carro->getPlaca());

        $SQL->execute();


        if ($SQL->affected_rows > 0)
            return true;
    }

    public function deleteVeiculo($id){
        try {
            $cona = new Conexao();
            $con=$cona->abreConexao();
            echo '$id';
            $sqlDelete=$con->query("DELETE FROM carro WHERE id='$id'");
        } catch (Exception $e) {
            throw new Exception("Error Processing Request", 1);
        }
    }

    public function selectTodosCarros(){
        try{
            $cona = new Conexao();
            $con=$cona->abreConexao();
            $SQL=$con->query("SELECT * FROM carro");
            $listaCarros=[];
            while($registros = $SQL->fetch_array()){
                $idCarro=$registros["id"];
                $idModelo=$registros["fk_modelo"];
                $SQLcarac=$con->query("SELECT fk_caracteristica as fkid FROM caracteristicas_carro WHERE fk_carro='$idCarro'");
                while($registrosCaracteristicas = $SQLcarac->fetch_array()){
                    $caracteristicas=$registrosCaracteristicas["fkid"];
                }

                $sqlMarca=$con->query("SELECT marca.nome as marn, modelo.nome as modn FROM modelo INNER JOIN marca WHERE modelo.id='$idModelo' AND modelo.fk_marca=marca.id");

                $marcaModelo = $sqlMarca->fetch_row();
                $marca=$marcaModelo[0];
                $modelo=$marcaModelo[1];


                $listaCarros[]=new Carro($registros["id"],$registros["nmr_chassi"],$marca,$modelo,$registros["ano"],$registros["placa"],$caracteristicas);
            }   
            return $listaCarros;
        }catch(Exception $e){
            return $e;
        }
    }

    public function selectMarca(){
        $cona = new Conexao();
        $con=$cona->abreConexao();
        $SQL=$con->query("SELECT * FROM marca");
        
        while($registros = $SQL->fetch_array()){
            $listaMarca[$registros["id"]]="<option value='".$registros["id"]."'>".$registros["nome"]."</option>";
        }       
        return $listaMarca;
    }

    public function selectModelos(){
        $cona = new Conexao();
        $con=$cona->abreConexao();
        $SQL=$con->query("SELECT * FROM modelo");
        $i=0;
        while($registros = $SQL->fetch_array()){
            if ($i==0) {
                $listaModelos[]="<option selected value='".$registros["id"]."'>".$registros["nome"]."</option>";
            }
            $listaModelos[]="<option value='".$registros["id"]."'>".$registros["nome"]."</option>";
            $i++;
        }       
        return $listaModelos;
    }

    public function selectCaracteristicas(){
        $cona = new Conexao();
        $con=$cona->abreConexao();
        $SQL=$con->query("SELECT * FROM caracteristicas");
        while($registros = $SQL->fetch_array()){
            $listaCaracteristicas[]="<div class='form-check'>
                                        <input type='checkbox' class='form-check-input' name='checkCaracteristicas[]' id='check".$registros["id"]."'>
                                        <label class='form-check-label' for='check".$registros["id"]."'>".$registros["nome"]."</label>
                                    </div>";
        }
        return $listaCaracteristicas;
    }

    public function UpdateContasReceber(ContasReceber $carro){
        global $con;
        $SQL = $con->prepare("UPDATE contasreceber SET documento_contasreceber = ?, valor_contasreceber = ?, cliente_contasreceber = ?, status_contasreceber = ?,  vencimento_contasreceber = ? WHERE id_contasreceber = ?");
        $SQL->bind_param("sdissi", $P1, $P2, $P3, $P4, $P5, $P6);

        $P1 = $carro->getDocumento_contasreceber();
        $P2 = $carro->getValor_contasreceber();
        $P3 = $carro->getCliente_contasreceber();
        $P4 = $carro->getStatus_contasreceber();
        $P5 = $carro->getVencimento_contasreceber();
        $P6 = $carro->getId_contasreceber();

        $SQL->execute();

        if($SQL->affected_rows > 0)
            return true;
    }
}
?>