<?php
/*
First load of information about specific MonitorBlock, it include Static and Dynamic information
*/

// Data send by AJAX
//Identification number of a specific ProcessBlock, use Blocks.id_block with id_block_type=2
//*****************************************
$idProcessBlock = $_POST["IdProcessBlock"]; 
//*****************************************

switch ($idProcessBlock) {
    case 1:
        $StationMonitor = array(
            ['Id'=>1,
             'Name' => 'Sistema de Agua Cruda',
             'CodeName' => 'PM-101'],
            ['Id'=>2,
             'Name' => 'Tanque Reactor',
             'CodeName' => 'PM-102']
        );
        break;
    case 2:
        $StationMonitor = array(
            ['Id'=>3,
             'Name' => 'Sistema de Ingreso de Agua',
             'CodeName' => 'PM-201'],
            ['Id'=>4,
             'Name' => 'Sistema de Salida de Agua',
             'CodeName' => 'PM-102']
        );
        break;
}

echo json_encode($StationBlock);
?>