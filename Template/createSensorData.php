<?php 
require_once ("../require/conexion.class.php");
require_once ("../require/measurement.class.php");

$ob = new measurement();

$num_measures = 1;

for($i=12;$i<39;$i++){
    for($j=0;$j<$num_measures;$j++){
        $PI = 3.14159;
        // Generando valor aleatorio
        $aleatorioT = rand(0,100)/100;
        $aleatorio2T = rand(0,100)/100;
        $value = $aleatorioT*$aleatorio2T*0.4+(-1*cos(($j)*$PI*2/$num_measures)*2)+15;
        $value = round($value,2);
        $ob->pushMeasure ($i, $value);
    }
}

?>
