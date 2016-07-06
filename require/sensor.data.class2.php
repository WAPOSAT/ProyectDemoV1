<?php
//require_once ("../require/conexion_class.php");

class sensorData2 {
    private $_conexion;
    
    public function __construct(){
        $this->_conexion = new conexion();
    }
    
    public function getSensor ($idBlock,$idSensor){
        $sql = "SELECT * FROM Sensors,Block_Sensors WHERE Block_Sensors.id_sensor=Sensors.id_sensor AND Block_Sensors.id_block=".$idBlock." AND Sensors.id_sensor=".$idSensor." ";
        $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function getStationBlocks ($idBlock){
        $sql = "SELECT * FROM Blocks WHERE id_parent_block=".$idBlock." ";
        $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function getLastValue ($idSensor) {
        $sql = "SELECT * FROM Measurement WHERE id_sensor=".$idSensor." LIMIT 1";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function getData ($idSensor, $long){
        $sql = "SELECT * FROM Measurement WHERE id_sensor=".$idSensor." ORDER BY id_measurement DESC LIMIT 0 ,".$long." ";
        $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function getNewData($idSensor, $lastID){
        $sql = "SELECT * FROM Measurement WHERE id_sensor='".$idSensor."' AND id_measurement>".$lastID." ORDER BY id_measurement DESC";
        $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function getMaxValue ($idSensor, $long){
        $sql = "SELECT MAX(value) AS value FROM Measurement WHERE id_sensor=".$idSensor." ORDER BY  id_sensor DESC LIMIT 0 , ".$long."  ";
        $this->_conexion->ejecutar_sentencia($sql);
        $value = $this->retornar_SELECT();
        return $value["value"];
    }
    
    public function getMinValue ($idSensor, $long){
        $sql = "SELECT MIN(value) AS value FROM Measurement WHERE id_sensor=".$idSensor." ORDER BY  id_sensor DESC LIMIT 0 , ".$long."  ";
        $this->_conexion->ejecutar_sentencia($sql);
        $value = $this->retornar_SELECT();
        return $value["value"];
    }
    
    public function getMPSensor ($idSensor){
        $sql = "SELECT * FROM Sensors,Sensor_Models WHERE Sensors.id_sensor_model=Sensor_Models.id_sensor_model AND Sensors.id_sensor=".$idSensor." ";
        $this->_conexion->ejecutar_sentencia($sql);
        $model = $this->retornar_SELECT();
        return $model["max_limit"];
        
    }
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
}

?>
