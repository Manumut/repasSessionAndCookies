<?php
    require_once("../../../../cred.php");

    function iniciar(){
        if(isset($_POST["fini"])){
            // llamo a los archivos necesarios para manejar los datos necesarios
            require_once("../modelo/class_db.php");
            require_once("../modelo/cookieAndSession.php");

            // se crea una instancia de la clase para comprobar los datos delusuario
            $bd=new db();

            // Si el usuario marca la casilla de "recordar", borra primero la cookie existente (por si otro usuario había iniciado sesión antes).
            if(isset($_POST["rec"])){
                unset_cookie("usuario");
            }

            // Verifica si las credenciales son correctas con la función comprobarCrede
            if($bd->comprobarCrede($_POST["nom"], $_POST["psw"])){

                // Guarda la cookie del usuario (si eligió recordar). puede servir x si en algun momento le quiero mostrar su nombre de usuario x ejemplo.
                if(isset($_POST["rec"])){
                    set_cookie("usuario", $_POST["nom"]);
                }

                // si son correctas las credenciales se abre la sesion
                set_session("usu", $_POST["nom"]);

                // patra guardar el nombre del usuario q esta ya en la sesion, para luego usarlo en la pagina de bienvenida
                $nUsu=$_SESSION["usu"];

                require_once("../vista/bienvenida.php");

            }else{
                // si lass credenciales no son correctas te vuelve a mandar al login
                require_once("../vista/login.php")
            }
        }
    }

    function cerrar(){
        if(isset($_POST["cerr"])){
            require_once("../modelo/class_db.php");
            unset_session()

            header("Location: login.php"); //redirecciona a la pagina
        }
    }

    function registrar(){
        if(isset($_POST["regis"])){
            require_once("../modelo/class_db.php");
            $db= new db();

            if(strcmp($_POST["psw"], $_POST["psw2"]) == 0){
                //Compara las dos contraseñas y si son iguales devuelve 0
                if(!$db->checckUsuario($_POST["nom"])){//comprueba si ese  nombre de usuario esta ya en la bd, si no lo esta le registra con lo siguiente
                    if($db->registrarUsu($_POST["nom"],$_POST["psw"])){
                        header("Location: index.php")
                    }else{
                        header("Location: index.php?action=registro");
                    }
                }else{
                    $err="<p style='color:red'>El usuario ya está registrado</p>";
                }
            } else{
                $err="<p style='color:red'>Las contraseñas no coinciden</p>";
            }
            require_once("../vista/registro.php")
        }
    }

    //Función para que si el usuario no tiene cuenta, le redirija a registro
    function registro(){
        require_once("../vista/registro.php");
    }

  
    // vamos a hacer uso del action y su utilidad

    if (isset($_REQUEST["action"])) {
        $action = $_REQUEST["action"];
        $action();
        // Con todo esto lo q hacemos es llamar a la accion que hace el usuario, q va enlazada con una funcion, entonces en la variable de action guardamos la funcion que realiza y con $action() lo que hacemos es llamar a la funcion q queremos realizar, ya q tiene guaradada en la variable la el nombre de la funcion
    }else{
        // Si no se recibe ninguna acción (ni por formulario ni por URL), verifica si el usuario ya tiene una sesión activa o si debe ir al login.
        require_once("../modelo/cookieAndSession.php");

        // comprobamos si tiene sesion abierta
        if(is_session("usu")){
            //Se guarda el nombre del usuario (que está en la sesión), para luego utilizarlo dentro de la página de bienvenida
            $nUsu=get_session("usu");
            require_once("../vista/bienvenida.php");
            // Si la sesión está activa, el usuario ve directamente la página de bienvenida sin pasar por el login.
        }else{
            header("Location: login.php");
            // Si no hay sesión activa, lo manda directamente al formulario de inicio de sesión

        }

    }
?>