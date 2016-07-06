<?php 
session_start();
$idUser = $_SESSION["idUser"];
if($idUser) {

/* ....................................................................... */
require_once ("../../require/conexion.class.php");
require_once ("../../require/alert.data.class1.php");

$si1 = new alertData1();
$si1b = new alertData1();

$si1->getAlerts($idUser);
$Danger = array();
$Risk = array();
$longD=0;
$longR=0;
    
While($PB1 = $si1->retornar_SELECT()){
    $Block = $si1b->getBlocks($PBs["id_block_sensor"]);
    $ProcessBlockName = $si1b->getBlockName($Block["id_parent_block"]);
    $Date = $si1b->getDateEvent($PB1["id_measurement"]);
    $Message = "".$ProcessBlockName."/".$Block["block_codename"]."-".$Block["codename"];
    if ($PB1["alert_type"]=1){
        $new = array('IdProcessBlock'=>$Block["id_parent_block"], 'IdStationBlock'=>$Block["id_block"], 'Id_Notification'=>$PB1["id_notification_alert"], 'Message'=>$Message, 'Date'=>$Date );
    array_push($Danger, $new);
        $longD++;       
    } else if ($PB1["alert_type"]=2){
        $new = array('IdProcessBlock'=>$Block["id_parent_block"], 'IdStationBlock'=>$Block["id_block"], 'Id_Notification'=>$PB1["id_notification_alert"], 'Message'=>$Message, 'Date'=>$Date );
        array_push($Risk, $new);
        $longR++;     
    }
    
}

$StaticInfo = array('LongDanger'=>$longD, 'LongRisk'=>$longR, 'Danger'=>$Danger, 'Risk'=>$Risk );    

echo json_encode($StaticInfo);

/* ....................................................................... */
} else {
    
    
}
?>
