<?php
//require_once ("../require/conexion_class.php");

class stationBlock1 {
    private $_conexion;
    
    public function __construct(){
        $this->_conexion = new conexion();
    }
    
    public function getStationBlock ($idBlock){
        $sql = "SELECT * FROM Blocks,Users_Blocks WHERE Users_Blocks.id_block=Blocks.id_block AND Blocks.id_block_type=3 AND Blocks.id_block=".$idBlock." LIMIT 1";
        $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function getNumStationBlocks ($idBlock){
        $sql = "SELECT * FROM Blocks WHERE id_parent_block=".$idBlock." ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    
    public function getStationBlocks ($idBlock){
        $sql = "SELECT * FROM Blocks WHERE id_parent_block=".$idBlock." ";
        $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function getSensors ($idBlock){
        $sql = "SELECT * FROM Sensors,Block_Sensors WHERE Block_Sensors.id_sensor=Sensors.id_sensor AND Block_Sensors.id_block=".$idBlock." ";
        $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function getLastValue ($idSensor) {
        $sql = "SELECT * FROM Measurement WHERE id_sensor=".$idSensor." LIMIT 1";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
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
    
    public function getNumDange ($idUser,$idBlock) {
        $sql = "SELECT * FROM Notifications_Alert,Monitoring_Events,Block_Sensors WHERE Block_Sensors.id_block_sensor=Monitoring_Events.id_block_sensor AND Notifications_Alert.id_monitoring_event=Monitoring_Events.id_monitoring_event AND Block_Sensors.id_block = ".$idBlock." AND  Notifications_Alert.id_user=".$idUser." AND Notifications_Alert.showed=0 AND Notifications_Alert.viewed=0 ORDER BY id_notification_alert AND Monitoring_Events.id_event_type=1 DESC";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    
    public function getNumRisk ($idUser,$idBlock) {
        $sql = "SELECT * FROM Notifications_Alert,Monitoring_Events,Block_Sensors WHERE Block_Sensors.id_block_sensor=Monitoring_Events.id_block_sensor AND Notifications_Alert.id_monitoring_event=Monitoring_Events.id_monitoring_event AND Block_Sensors.id_block = ".$idBlock." AND  Notifications_Alert.id_user=".$idUser." AND Notifications_Alert.showed=0 AND Notifications_Alert.viewed=0 ORDER BY id_notification_alert AND Monitoring_Events.id_event_type=2 DESC";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
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
