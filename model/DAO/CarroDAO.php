<?php include("../model/Carro.php")?>
<?php
include ("conexao.php");

class CarroDAO{

    public function InsertCarro($chassi,$modelo,$ano,$placa,$caract){
        try {
            $cona = new Conexao();
            $con=$cona->abreConexao();

            $id=null;
            $modelo*=1;
            $ano*=1;
            $SQL = "INSERT INTO carro (id,nmr_chassi,fk_modelo,ano,placa) VALUES (null, '$chassi', $modelo, $ano, '$placa')";

            $con->query($SQL);

            //$stmt->execute();

            $sqlIDCARRO=$con->query("SELECT MAX(id) FROM carro");
            $idCARRO=$sqlIDCARRO->fetch_row()[0];
            foreach ($caract as $carac) {
                $sqlCaracteristicas="INSERT INTO caracteristicas_carro VALUES ($carac,$idCARRO)";
                $con->query($sqlCaracteristicas);
            }
            echo "sucesso";
        } catch (Exception $e) {
            echo $e;
        }
        
    }

    public function getPlacaById($idVeiculo){
        try {
            $cona = new Conexao();
            $con=$cona->abreConexao();
            $SQL=$con->query("SELECT placa FROM carro WHERE id='$idVeiculo'");
            return $SQL->fetch_row()[0];
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function getAnoById($idVeiculo){
        try {
            $cona = new Conexao();
            $con=$cona->abreConexao();
            $SQL=$con->query("SELECT ano FROM carro WHERE id='$idVeiculo'");
            return $SQL->fetch_row()[0];
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function getNmrChassiById($idVeiculo){
        try {
            $cona = new Conexao();
            $con=$cona->abreConexao();
            $SQL=$con->query("SELECT nmr_chassi FROM carro WHERE id='$idVeiculo'");
            return $SQL->fetch_row()[0];
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function deleteVeiculo($id){
        try {
            $cona = new Conexao();
            $con=$cona->abreConexao();
            $sqlDelete=$con->query("DELETE FROM carro WHERE id='$id'");
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function selectMarcaByModelo($modelo){
        $cona = new Conexao();
        $con=$cona->abreConexao();
        $SQL=$con->query("SELECT fk_marca FROM modelo WHERE id='$modelo'");
        return $SQL->fetch_row()[0];
    }

    public function getCaracteristicaByID($id){
        $cona = new Conexao();
        $con=$cona->abreConexao();
        $SQL=$con->query("SELECT nome FROM caracteristicas WHERE id='$id'");
        return $SQL->fetch_row()[0];
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
                $SQLcarac=$con->query("SELECT nome FROM caracteristicas INNER JOIN caracteristicas_carro ON caracteristicas_carro.fk_caracteristica=caracteristicas.id AND caracteristicas_carro.fk_carro='$idCarro'");
                $caracteristicas="";
                while($registrosCaracteristicas = $SQLcarac->fetch_array()){
                    $caracteristicas=$caracteristicas." | ".$registrosCaracteristicas["nome"];
                }
                $sqlMarca=$con->query("SELECT marca.nome as marn, modelo.nome as modn FROM modelo INNER JOIN marca WHERE modelo.id='$idModelo' AND modelo.fk_marca=marca.id");
                $marcaModelo = $sqlMarca->fetch_row();
                $marca=$marcaModelo[0];
                $modelo=$marcaModelo[1];


                $listaCarros[]=new Carro($registros["id"],$registros["nmr_chassi"],$marca,$modelo,$registros["ano"],$registros["placa"],$caracteristicas);
            }   
            return $listaCarros;
        }catch(Exception $e){
            echo json_encode(array('response' => 'ocorreu algum erro ao inserir :/...'));
            return false;
        }
    }

    public function selectMarcaModeloUpdate($idVeiculo){
        $cona = new Conexao();
        $con=$cona->abreConexao();
        $SQLveiculoUpdate=$con->query("SELECT fk_modelo FROM carro WHERE id='$idVeiculo'");
        $idModeloVeiculo=$SQLveiculoUpdate->fetch_row()[0];
        $SQL=$con->query("SELECT modelo.id as mid,modelo.nome as modn,marca.nome as marn FROM modelo INNER JOIN marca ON modelo.fk_marca=marca.id");
        $i=0;
        while($registros = $SQL->fetch_array()){
            if ($registros["mid"]==$idModeloVeiculo) {
               $listaMarca[]=" <th scope='row'>".$registros["marn"]."</th>
                                <td>".$registros["modn"]."</td>
                                <td>
                                    <input checked class='form-check-input' type='radio' name='modelo' id='inlineCheckbox".$registros["mid"]."' value='".$registros["mid"]." required'>
                                </td>
                                
                                ";
            }else{
                if ($i==0) {
                    $listaMarca[]=" <th scope='row'>".$registros["marn"]."</th>
                                <td>".$registros["modn"]."</td>
                                <td>
                                    <input class='form-check-input' type='radio' name='modelo' id='inlineCheckbox".$registros["mid"]."' value='".$registros["mid"]." required'>
                                </td>
                                
                                ";
                }else{
                    $listaMarca[]=" <th scope='row'>".$registros["marn"]."</th>
                                    <td>".$registros["modn"]."</td>
                                    <td>
                                        <input class='form-check-input' type='radio' name='modelo' id='inlineCheckbox".$registros["mid"]."' value='".$registros["mid"]."'>
                                    </td>
                                ";
                }
            }
            
            
            $i++;
        }       
        return $listaMarca;
    }

    public function selectMarcaModelo(){
        $cona = new Conexao();
        $con=$cona->abreConexao();
        $SQL=$con->query("SELECT modelo.id as mid,modelo.nome as modn,marca.nome as marn FROM modelo INNER JOIN marca ON modelo.fk_marca=marca.id");
        $i=0;
        while($registros = $SQL->fetch_array()){
            if ($i==0) {
               $listaMarca[]=" <th scope='row'>".$registros["marn"]."</th>
                            <td>".$registros["modn"]."</td>
                            <td>
                                <input class='form-check-input' type='radio' name='modelo' id='inlineCheckbox".$registros["mid"]."' value='".$registros["mid"]." required'>
                            </td>
                            
                            ";
            }else{
                $listaMarca[]=" <th scope='row'>".$registros["marn"]."</th>
                                <td>".$registros["modn"]."</td>
                                <td>
                                    <input class='form-check-input' type='radio' name='modelo' id='inlineCheckbox".$registros["mid"]."' value='".$registros["mid"]."'>
                                </td>
                            ";
                        }
                        $i++;
                }       
        return $listaMarca;
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
            $listaCaracteristicas[]="<option value='".$registros["id"]."'>".$registros["nome"]."</option>";
        }
        return $listaCaracteristicas;
    }

    public function selectCaracteristicasUpdate($idVeiculo){
        $cona = new Conexao();
        $con=$cona->abreConexao();
        $selectCaracteristicasCarro=$con->query("SELECT * FROM caracteristicas_carro WHERE fk_carro='$idVeiculo'");
        while($res = $selectCaracteristicasCarro->fetch_array()){
            $listaCaracteristicasCarro[]=$res["fk_caracteristica"];
        }
        $SQL=$con->query("SELECT * FROM caracteristicas");
        while($registros = $SQL->fetch_array()){
            if (in_array($registros["id"], $listaCaracteristicasCarro)) {
               $listaCaracteristicas[]="<option selected='' value='".$registros["id"]."'>".$registros["nome"]."</option>";
            }else{
                $listaCaracteristicas[]="<option value='".$registros["id"]."'>".$registros["nome"]."</option>";
            }
        }
        return $listaCaracteristicas;
    }

    public function deleteCaracteristicasVeiculo($idVeiculo){
        try {
            $cona = new Conexao();
            $con=$cona->abreConexao();
            $sqlDelete=$con->query("DELETE FROM caracteristicas_carro WHERE fk_carro='$idVeiculo'");
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function UpdateVeiculo($idVeiculo,$chassi,$modelo,$ano,$placa,$caracteristicas){
        try{
            $cona = new Conexao();
            $con=$cona->abreConexao();
            $SQL=$con->query("SELECT * FROM carro");
            $SQL = $con->prepare("UPDATE carro SET nmr_chassi = '$chassi', fk_modelo = '$modelo', ano = '$ano', placa = '$placa' WHERE id = $idVeiculo");
            $SQL->execute();

           $sqlDelete=$con->query("DELETE FROM caracteristicas_carro WHERE fk_carro='$idVeiculo'");
            
            foreach ($caracteristicas as $carac) {
                $sqlCaracteristicas="INSERT INTO caracteristicas_carro VALUES ($carac,$idVeiculo)";
                $con->query($sqlCaracteristicas);
            } 
            echo "sucesso";
        }catch(Exception $e){
            echo json_encode(array('response' => 'ocorreu algum erro ao inserir :/...'));
            return false;
        }
        
    }
}
?>