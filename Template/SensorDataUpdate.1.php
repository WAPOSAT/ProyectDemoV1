<?php 
session_start();
$idUser = $_SESSION["idUser"];
if(!$idUser) { //corregir negacion
$idUser = 1;
$idStationBlock = $_POST["IdStationBlock"];
$idStationBlock = 1;
$idSensor = $_POST["IdSensor"];
$idSensor = 1;
$lastID = $_POST["LastID"];
$lastID = 3;

/* ....................................................................... */
require_once ("../require/conexion.class.php");
require_once ("../require/sensor.data.class1.php");

$si1 = new sensorData1();
$si1b = new sensorData1();
$si1c = new sensorData1();

$si1->getSensor($idStationBlock, $idSensor);
$Sensor = $si1->retornar_SELECT();
    
$MP = $si1b->getMPSensor($Sensor["id_sensor"]);
$MinValue = $si1b->getMinValue($Sensor["id_sensor"], 20);
$MaxValue = $si1b->getMaxValue($Sensor["id_sensor"], 20);



$si1->getNewData($Sensor["id_sensor"], $lastID);
$long = 0;
$AcumVal = 0;
$lastID = 0;
$Date = array();
$Value = array();
    
While($PB1 = $si1->retornar_SELECT()){
    $datetmp = strtotime($PB1["date"]);
    $horatmp = date('H',$datetmp);
    $minutotmp = date('i',$datetmp);
    $segundotmp = date('s',$datetmp);
    $NewDate = $horatmp.":".$minutotmp.":".$segundotmp;
    $NewDate = "".$NewDate;
        
    array_push($Date, $NewDate);
    array_push($Value, $PB1["value"]);
    
    $AcumVal = $AcumVal+$PB1["value"];
    if($lastID < $PB1["id_measurement"]){
        $months = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
        $date = strtotime($PB1["date"]);
        $mesText = $months[date('n', $date)-1];
        $dia = date('d', $date);
        $hora = date('H', $date);
        $DateText = "Dia: ".$mesText."-".$dia." ".$hora."horas";

        $Last = array('Id'=>$PB1["id_measurement"], 'Value'=>$PB1["value"], 'Date'=>$DateText );
        $lastID = $PB1["id_measurement"];
    }
    $long++;
}
    
$Time = array_reverse($Date);
$Value = array_reverse($Value);
$Data = array('Time'=>$Time, 'Value'=>$Value);
    
    
$MeanValue = $AcumVal/$long;
$MeanValue = round($MeanValue,2);

    
$StaticInfo = array('Id'=>$Sensor["id_sensor"], 'IdStationBlock'=>$Sensor["id_block"],'Long'=>$long, 'Last'=>$Last, 'Data'=>$Data);

echo json_encode($StaticInfo);

/* ....................................................................... */
} else {
    
    
}
?>
