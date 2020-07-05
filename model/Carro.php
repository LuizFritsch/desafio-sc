<?php
class Carro{

    private $_id;
    private $_nmrChassi;
    private $_marca;
    private $_modelo;
    private $_ano;
    private $_placa;
    private $_caracteristicas;

    /**
     * CARRO constructor.
     * @param $_id
     * @param $_nmrChassi
     * @param $_marca
     * @param $_modelo
     * @param $_ano
     * @param $_placa
     * @param $_caracteristicas
     */
    public function __construct($_id, $_nmrChassi, $_marca, $_modelo, $_ano, $_placa, $_caracteristicas)
    {
        try {
            $this->_id = $_id;
            $this->_nmrChassi = $_nmrChassi;
            $this->_marca = $_marca;
            $this->_modelo = $_modelo;
            $this->_ano = $_ano;
            $this->_placa = $_placa;
            $this->_caracteristicas = $_caracteristicas;
        }catch (Exception $e){
            throw new Exception('Erro ao criar um veiculo');
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }


    /**
     * @return mixed
     */
    public function getNmrChassi()
    {
        return $this->_nmrChassi;
    }

    /**
     * @param mixed $nmrChassi
     */
    public function setNmrChassi($nmrChassi)
    {
        $this->_nmrChassi = $nmrChassi;
    }

    /**
     * @return mixed
     */
    public function getMarca()
    {
        return $this->_marca;
    }

    /**
     * @param mixed $marca
     */
    public function setMarca($marca)
    {
        $this->_marca = $marca;
    }

    /**
     * @return mixed
     */
    public function getModelo()
    {
        return $this->_modelo;
    }

    /**
     * @param mixed $modelo
     */
    public function setModelo($modelo)
    {
        $this->_modelo = $modelo;
    }

    /**
     * @return mixed
     */
    public function getAno()
    {
        return $this->_ano;
    }

    /**
     * @param mixed $ano
     */
    public function setAno($ano)
    {
        $this->_ano = $ano;
    }

    /**
     * @return mixed
     */
    public function getPlaca()
    {
        return $this->_placa;
    }

    /**
     * @param mixed $placa
     */
    public function setPlaca($placa)
    {
        $this->_placa = $placa;
    }

    /**
     * @return mixed
     */
    public function getCaracteristicas()
    {
        return $this->_caracteristicas;
    }

    /**
     * @param mixed $caracteristicas
     */
    public function setCaracteristicas($caracteristicas)
    {
        $this->_caracteristicas = $caracteristicas;
    }



}

?>