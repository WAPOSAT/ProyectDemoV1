<?php
//require_once ("../require/conexion_class.php");

class staticInfo2 {
    private $_conexion;
    
    public function __construct(){
        $this->_conexion = new conexion();
    }
    
    public function getUser ($idUser){
        $sql = "SELECT * FROM Users WHERE id_user=".$idUser." LIMIT 1";
        $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function getNumDange ($idUser) {
        $sql = "SELECT * FROM Notifications_Alert,Monitoring_Events WHERE Notifications_Alert.id_monitoring_event=Monitoring_Events.id_monitoring_event AND Notifications_Alert.id_user=".$idUser." AND Notifications_Alert.showed=0 AND Notifications_Alert.viewed=0 ORDER BY id_notification_alert AND Monitoring_Events.id_event_type=1 DESC";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    
    public function getNumRisk ($idUser) {
        $sql = "SELECT * FROM Notifications_Alert,Monitoring_Events WHERE Notifications_Alert.id_monitoring_event=Monitoring_Events.id_monitoring_event AND Notifications_Alert.id_user=".$idUser." AND Notifications_Alert.showed=0 AND Notifications_Alert.viewed=0 ORDER BY id_notification_alert AND Monitoring_Events.id_event_type=2 DESC";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    
    public function getProcessBlocks ($idUser){
        $sql = "SELECT * FROM Blocks,Users_Blocks WHERE Users_Blocks.id_block=Blocks.id_block AND Blocks.id_block_type=1 AND Users_Blocks.id_user='".$idUser."' ";
        $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function getNumStationBlocks ($idBlock){
        $sql = "SELECT * FROM Blocks WHERE id_parent_block=".$idBlock." ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
}

?>
