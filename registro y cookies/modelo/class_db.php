<?php
    require_once("../../../../cred.php");

    class db{
        private $conn;
        public function __construct(){
            $this->conn= new mysqli("localhost",USU_CONN,PSW_CONN,"cookies");
        }
        public function comporbarCrede(String $nom, String $psw){
            $sentencia="SELECT count(*) FROM usuarios WHERE usuario=? AND pass =?";
            $consulta=$this->conn->prepare($sentencia);
            $consulta->bind_param("ss",$nom,$psw);
            $consulta->bind_result($count);

            $consulta->execute();
            $consulta->fetch();
            $consulta->close();

            // si el count es 1 es que existe el usuario en la bd
            $existe=false;
            if($count ==1){
                $existe=true;
            }else{
                $existe=false;
            }
            return $existe;
        }


        // Compruebo si el usu esta en la bd
        public function checkUsuario(String $nom){
            $sentencia="SELECT count(*) from usuarios where usuario=?";
            
            $consulta=$this->conn->prepare($sentencia);
            $consulta->bind_param("s", $nom);
            $consulta->bind_result($count);

            $consulta->execute();
            $consulta->fetch();
            $consulta->close();

            $existe = false;
            if($count == 1){
                $existe=true;
            }else{
                $existe=false;
            }
            return $existe;
        }

        // insertamos el usu en la bd
        public function registrarUsu(String $nom, String $psw){
            $sentencia="INSERT INTO usuarios VALUES (?,?)";
            
            $consulta=$this->conn->prepare($sentencia);
            $consulta->bind_param("ss", $nom, $psw);

            $consulta->execute();

            // Compruebo si se ha insertado
            $res=false;
            if($consulta->affected_rows==1){ // si el numero de filas afectadas es 1
                $res=true;
            }
            return $res;
            $consulta->close();

        }
    }





?>
