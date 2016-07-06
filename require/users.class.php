<?php
//require_once ("../require/conexion_class.php");

class users {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion();
	}
    
    public function verifyUser ($usuario,$clave){
        $sql = "SELECT * FROM Users WHERE username='".$usuario."' AND password='".$clave."' AND active=1 ";
        $this->_conexion->ejecutar_sentencia($sql);
        $usuario = $this->_conexion->tam_respuesta();
        if($usuario == 1){
            return 1;
        }else {
            return 0;
        }
    }
    
    public function getUser ($usuario, $clave){
        if($this->verificar_usuario($usuario, $clave) == 1 ){
            $sql = "SELECT * FROM Users WHERE username='".$usuario."' AND password='".$clave."' AND active=1 ";
            $this->_conexion->ejecutar_sentencia($sql);
            $usuario = $this->retornar_SELECT();
            return $usuario["id_user"];
        } else {
            return 0;
        }
    }
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
    
    
}
?>