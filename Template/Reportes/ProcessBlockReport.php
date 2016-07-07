<?php
/*
Static Info to Load Screen 1

*** PARAMETERS REQUIRED: ***
NOTHING
****************************    
*/


$MonitorBlock = array(
    ['Id'=>1,
     'Name' => 'Planta de Purificacion de Agua',
     'CodeName'=> 'Bloque-101',
     'NumMonitorPoints'=> 2],
    ['Id'=>2,
     'Name' => 'Tanque XYZ',
     'CodeName'=> 'Bloque-102',
     'NumMonitorPoints'=> 2]
);

echo json_encode($MonitorBlock);
?>