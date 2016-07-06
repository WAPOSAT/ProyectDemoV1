<?php
//require_once ("../require/conexion_class.php");

class alertData2 {
    private $_conexion;
    
    public function __construct(){
        $this->_conexion = new conexion();
    }
    
    public function getAlerts ($idUser){
        $sql = "SELECT * FROM Notifications_Alert,Monitoring_Events,Event_Type WHERE Notifications_Alert.id_monitoring_event=Monitoring_Events.id_monitoring_event AND Monitoring_Events.id_event_type=Event_Type.id_event_type  AND Notifications_Alert.viewed=0 AND Notifications_Alert.id_user=".$idUser." ";
        $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function getBlocks ($idBlockSensor) {
        $sql = "SELECT * FROM Blocks,Block_Sensors,Sensors WHERE Blocks.id_block=Block_Sensors.id_block AND Block_Sensors.id_sensor=Sensors.id_sensor AND Block_Sensors.id_block_sensor= ".$idBlockSensor." LIMIT 1";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function getBlockName ($idBlock){
        $sql = "SELECT * FROM Blocks WHERE id_block=".$idBlock." ";
        $this->_conexion->ejecutar_sentencia($sql);
        $block = $this->retornar_SELECT();
        return $block["block_name"];
    }
    
    public function getDateEvent ($idMeasurement){
        $sql = "SELECT * FROM Measurement WHERE id_measurement=".$idMeasurement." ";
        $this->_conexion->ejecutar_sentencia($sql);
        $Measure = $this->retornar_SELECT();
        return $Measure["date"];
    }
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
}

?>
