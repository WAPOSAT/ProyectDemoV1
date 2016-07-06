<?php 
session_start();
$idUser = $_SESSION["idUser"];
if($idUser) {

// Data send by AJAX
//*****************************************
$idStationBlock = $_POST["IdStationBlock"];
//*****************************************

/* ....................................................................... */
require_once ("../../require/conexion.class.php");
require_once ("../../require/station.block.class1.php");

$si1 = new stationBlock1();
$si1b = new stationBlock1();
$si1c = new stationBlock1();

$si1->getStationBlock ($idUser,$idStationBlock);

$StationBlock = $si1->retornar_SELECT();

$numDanger = $si1->getNumDange($idUser,$StationBlock["id_block"]);
$numRisk = $si1->getNumRisk($idUser,$StationBlock["id_block"]);

$si1->getSensors($idStationBlock);
$Sensor = array();

While($PB1 = $si1->retornar_SELECT()){
    $last = $si1b->getLastValue($PB1["id_sensor"]);
    $MP = $si1b->getMPSensor($PB1["id_sensor"]);
    $MinValue = $si1b->getMinValue($PB1["id_sensor"], 20);
    $MaxValue = $si1b->getMaxValue($PB1["id_sensor"], 20);
    
    $new = array('Id'=>$PB1["id_sensor"], 'LastValue'=>$last["value"], 'LastDate'=>$last["date"] );
    array_push($Sensor, $new);
}

$StaticInfo = array('Id'=>$StationBlock["id_block"], 'numDanger'=>$numDanger, 'numRisk'=>$numRisk, 'Sensor'=>$Sensor);

echo json_encode($StaticInfo);

/* ....................................................................... */
} else {
    
    
}
?>
