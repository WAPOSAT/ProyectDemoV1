<?php 
session_start();
$idUser = $_SESSION["idUser"];
if($idUser) {
    
/* ....................................................................... */
require_once ("../../require/conexion.class.php");
require_once ("../../require/alert.data.class2.php");

$si1 = new alertData2();
$si1b = new alertData2();

$si1->getAlerts($idUser);
$AlertData = array();
$long=0;
    
While($PB1 = $si1->retornar_SELECT()){
    $Block = $si1b->getBlocks($PBs["id_block_sensor"]);
    $ProcessBlockName = $si1b->getBlockName($Block["id_parent_block"]);
    $Date = $si1b->getDateEvent($PB1["id_measurement"]);
    $Message = "".$ProcessBlockName."/".$Block["block_codename"]."-".$Block["codename"];
    $AlertType = $PB1["alert_type"]-1;
    
    $new = array('IdProcessBlock'=>$Block["id_parent_block"], 'IdStationBlock'=>$Block["id_block"], 'Id_Notification'=>$PB1["id_notification_alert"], 'Message'=>$Message, 'Date'=>$Date, 'AlertType'=>$AlertType );
    array_push($AlertData, $new);
    $long++;
}

$StaticInfo = array('Long'=>$long, 'Alert'=>$AlertData );    

echo json_encode($StaticInfo);

/* ....................................................................... */
} else {
    
    
}
?>
