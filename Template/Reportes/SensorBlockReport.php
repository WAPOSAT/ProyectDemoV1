<?php
/*
First load of information about specific MonitorBlock, it include Static and Dynamic information
*/

// Data send by AJAX
//Identification number of a specific ProcessBlock, use Blocks.id_block with id_block_type=2
//*****************************************
$idStationBlock = $_POST["IdStationBlock"];
$DateBegin = $_POST["DateBegin"];
$DateEnd = $_POST["DateEnd"];
//*****************************************

switch ($idStationBlock) {
    case 1:
        $Sensor = array(
            ['Id'=>1,
             'Name' => 'Cloro Residual',
             'Title' => 'mg/L vs Tiempo',
             'Data' => [140, 153, 139],
             'Time' => ['Ene','Feb','Mar'],
             'Maximo' => 19.8,
             'Media' => 19.6,
             'Minimo' => 19.3,
             'Tendencia' => 3.4],
            ['Id'=>2,
             'Name' => 'pH',
             'Title' => 'pH vs Tiempo',
             'Data' => [120, 121, 125],
             'Time' => ['Ene','Feb','Mar'],
             'Maximo' => 125,
             'Media' => 120,
             'Minimo' => 119,
             'Tendencia' => 0.9],
            ['Id'=>3,
             'Name' => 'Turbiedad',
             'Title' => 'NTU vs Tiempo',
             'Data' => [5.0, 5.2, 5.0],
             'Time' => ['Ene','Feb','Mar'],
             'Maximo' => 6,
             'Media' => 5.5,
             'Minimo' => 5.4,
             'Tendencia' => 10.5]
        );
        break;
    case 2:
        $Sensor = array(
            ['Id'=>4,
             'Name' => 'Cloro Residual',
             'Title' => 'mg/L vs Tiempo',
             'Data' => [140, 153, 139],
             'Time' => ['Ene','Feb','Mar'],
             'Maximo' => 19.8,
             'Media' => 19.6,
             'Minimo' => 19.3,
             'Tendencia' => 3.4],
            ['Id'=>5,
             'Name' => 'pH',
             'Title' => 'pH vs Tiempo',
             'Data' => [120, 121, 125],
             'Time' => ['Ene','Feb','Mar'],
             'Maximo' => 125,
             'Media' => 120,
             'Minimo' => 119,
             'Tendencia' => 0.9]
        );
        break;
    case 3:
        $Sensor = array(
            ['Id'=>6,
             'Name' => 'Temperatura',
             'Title' => '°C vs Tiempo',
             'Data' => [25, 24.6, 23.6],
             'Time' => ['Ene','Feb','Mar'],
             'Maximo' => 25.4,
             'Media' => 24.3,
             'Minimo' => 24.1,
             'Tendencia' => 6.1],
            ['Id'=>7,
             'Name' => 'Disolución de Oxígeno',
             'Title' => 'mg/L vs Tiempo',
             'Data' => [4.5, 3.1, 2.0],
             'Time' => ['Ene','Feb','Mar'],
             'Maximo' => 5.2,
             'Media' => 3.3,
             'Minimo' => 1.6,
             'Tendencia' => -45.3],
            ['Id'=>8,
             'Name' => 'Potencial Oxido Reducion',
             'Title' => 'mV vs Tiempo',
             'Data' => [1300, 1452, 1325],
             'Time' => ['Ene','Feb','Mar'],
             'Maximo' => 1503,
             'Media' => 1398,
             'Minimo' => 1253,
             'Tendencia' => 0.45]
        );
        break;
    case 4:
        $Sensor = array(
            ['Id'=>9,
             'Name' => 'Cloro Residual',
             'Title' => 'mg/L vs Tiempo',
             'Data' => [140, 153, 139],
             'Time' => ['Ene','Feb','Mar'],
             'Maximo' => 19.8,
             'Media' => 19.6,
             'Minimo' => 19.3,
             'Tendencia' => 3.4],
            ['Id'=>10,
             'Name' => 'Disolución de Oxígeno',
             'Title' => 'mg/L vs Tiempo',
             'Data' => [4.45, 3.4, 2.1,
             'Time' => ['Ene','Feb','Mar'],
             'Maximo' => 5.2,
             'Media' => 3.5,
             'Minimo' => 1.9,
             'Tendencia' => -23.3],
            ['Id'=>11,
             'Name' => 'Turbiedad',
             'Title' => 'NTU vs Tiempo',
             'Data' => [5.0, 5.2, 5.0],
             'Time' => ['Ene','Feb','Mar'],
             'Maximo' => 6,
             'Media' => 5.5,
             'Minimo' => 5.4,
             'Tendencia' => 10.5],
            ['Id'=>12,
             'Name' => 'Conductividad',
             'Title' => 'uS/cm vs Tiempo',
             'Data' => [35, 32.4, 34.2],
             'Time' => ['Ene','Feb','Mar'],
             'Maximo' => 36,
             'Media' => 35.2,
             'Minimo' => 33.1,
             'Tendencia' => 2.6]
        );
        break;
}

echo json_encode($Sensor);
?>