<?php 
session_start();
$idUser = $_SESSION["idUser"];
if($idUser) {



/* ....................................................................... */
require_once ("../../require/conexion.class.php");
require_once ("../../require/static.info.class1.php");

$si1 = new staticInfo1();
$si1b = new staticInfo1();

$si1->getUser($idUser);

$User = $si1->retornar_SELECT();
$Hi = "Hola ".$User["name"].", Bienvenido";

$NumDanger=$si1->getNumDange($idUser);

$NumRisk=$si1->getNumRisk($idUser);


$si1->getProcessBlocks($idUser);
$ProcessBlock = array();

While($PBs = $si1->retornar_SELECT()){
    $numStations = $si1b->getNumStationBlocks($PBs["id_block"]);
    
    $new = array('Id'=>$PBs["id_block"], 'Name'=>$PBs["block_name"], 'CodeName'=>$PBs["codename"], 'NumStationBlocks'=>$numStations, 'vista'=>1 );
    array_push($ProcessBlock, $new);
}

$StaticInfo = array('HiUser'=>$Hi, 'NumDanger'=>$NumDanger, 'NumRisk'=>$NumRisk, 'ProcessBlock'=>$ProcessBlock);

echo json_encode($StaticInfo);

/* ....................................................................... */
} else {
    
    
}
?>
