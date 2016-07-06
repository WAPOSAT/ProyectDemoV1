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
require_once ("../../require/process.block.class2.php");

$si1 = new processBlock2();
$si1b = new processBlock2();
$si1c = new processBlock2();

$si1->getProcessBlock ($idUser,$idProcessBlock);

$ProcessBlock = $si1->retornar_SELECT();
$Hi = "Este es el proceso ".$ProcessBlock["block_name"]." (".$ProcessBlock["codename"].")";

$numStations = $si1b->getNumStationBlocks($ProcessBlock["id_block"]);    

    
$si1->getStationBlocks($idProcessBlock);
$StationBlock = array();
$Danger = array();
$Risk = array();

While($PB1 = $si1->retornar_SELECT()){
    $si1b->getSensors($PB1["id_block"]);
    $Sensor = array();
    While($PB2 = $si1b->retornar_SELECT()){
        $last = $si1c->getLastValue($PB2["id_sensor"]);
        
        $new2 = array('Id'=>$PB2["id_sensor"], 'Name'=>$PB2["codename"]."p", 'Code'=>$PB2["codename"], 'Unit'=>"ppm", 'LMP'=>$PB2["up_danger_limit"], 'LMR'=>$PB2["up_risk_limit"],  'LastValue'=>$last["value"], 'LastDate'=>$last["date"] );
        
        if($last["value"]>$PB2["up_risk_limit"]){
            if($last["value"]>$PB2["up_danger_limit"]){
                $new3 = array('Id'=>$PB1["id_block"], 'Name'=>$PB1["block_name"], 'CodeName'=>$PB1["block_codename"], 'SensorName'=>$PB2["codename"], 'IdSensor'=>$PB2["id_sensor"] );
                array_push($Danger, $new3);
            } else {
                $new3 = array('Id'=>$PB1["id_block"], 'Name'=>$PB1["block_name"], 'CodeName'=>$PB1["block_codename"], 'SensorName'=>$PB2["codename"], 'IdSensor'=>$PB2["id_sensor"] );
                array_push($Risk, $new3);
            }
        }
        
        array_push($Sensor, $new2);
    }
    
    $new = array('Id'=>$PB1["id_block"], 'Name'=>$PB1["block_name"], 'CodeName'=>$PB1["block_codename"], 'URL'=>$PB1["image"], 'Sensor'=>$Sensor );
    array_push($StationBlock, $new);
}

$StaticInfo = array('Id'=>$ProcessBlock["id_block"], 'Name'=>$ProcessBlock["block_name"], 'CodeName'=>$ProcessBlock["codename"], 'Hi'=>$Hi, 'NumStationBlocks'=>$numStations, 'RefreshFrequencySeg'=>$ProcessBlock["refresh"], 'StationBlock'=>$StationBlock, 'Danger'=>$Danger, 'Risk'=>$Risk);

echo json_encode($StaticInfo);

/* ....................................................................... */
} else {
    
    
}
?>
