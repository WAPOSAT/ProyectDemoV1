<?php 
session_start();
$idUser = $_SESSION["idUser"];
if($idUser) {

// Data send by AJAX
//*****************************************
$idProcessBlock = $_POST["IdProcessBlock"];
//*****************************************

/* ....................................................................... */
require_once ("../../require/conexion.class.php");
require_once ("../../require/process.block.class1.php");

$si1 = new processBlock1();
$si1b = new processBlock1();
$si1c = new processBlock1();

$si1->getProcessBlock ($idUser,$idProcessBlock);

$ProcessBlock = $si1->retornar_SELECT();
$Hi = "Este es el proceso ".$ProcessBlock["block_name"]." (".$ProcessBlock["codename"].")";

$numStations = $si1b->getNumStationBlocks($ProcessBlock["id_block"]);    

    
$si1->getStationBlocks($idProcessBlock);
$StationBlock = array();

While($PB1 = $si1->retornar_SELECT()){
    $si1b->getSensors4($PB1["id_block"]);
    $Sensor = array();
    While($PB2 = $si1b->retornar_SELECT()){
        $last = $si1c->getLastValue($PB2["id_sensor"]);
        
        $new2 = array('Id'=>$PB2["id_sensor"], 'Name'=>$PB2["codename"], 'Code'=>$PB2["codename"], 'Unit'=>"ppm", 'LastValue'=>$last["value"], 'LastDate'=>$last["date"] );
        array_push($Sensor, $new2);
    }
    
    $numDanger = $si1c->getNumDange($idUser,$PB1["id_block"]);
    $numRisk = $si1c->getNumRisk($idUser,$PB1["id_block"]);
    
    $new = array('Id'=>$PB1["id_block"], 'Name'=>$PB1["block_name"], 'CodeName'=>$PB1["block_codename"], 'NumDanger'=>$numDanger, 'NumRisk'=>$numRisk, 'Sensor'=>$Sensor );
    array_push($StationBlock, $new);
}

$StaticInfo = array('Id'=>$ProcessBlock["id_block"], 'Name'=>$ProcessBlock["block_name"], 'CodeName'=>$ProcessBlock["codename"], 'Hi'=>$Hi, 'NumStationBlocks'=>$numStations, 'RefreshFrequencySeg'=>$ProcessBlock["refresh"], 'StationBlock'=>$StationBlock);

echo json_encode($StaticInfo);

/* ....................................................................... */
} else {
    
    
}
?>
