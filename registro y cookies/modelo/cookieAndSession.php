<?php

//Gestionamos las cookies y sesiones en otro modelo por separado

// Settear cookie
// esta funcion lo q hace es que si existe la cookie de usuario, se muestre el valor de la cookie 
function set_cookie(String $nom, $val){
    setcookie($nom, $val, time() +(86400*30));
}


function unset_cookie(String $nom){
    $comp=false;

    if(isset($_COOKIE[$nom])){
        setcookie($nom, "", time()-(86400*30));
        $comp=true;

    }
    return $comp;
}

function start_session(){
    // Esta funcion comprueba q si no esta iniciada ninguna sesion, ps la inicia
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
}

 // funcion para actualizar o creaar variable de sesion
 function set_session(String $nom, $val){
    start_session();
    $_SESSION[$nom]=$val;
}

// obtener valor de la varibale de sesion
function get_session(String $nom){
    start_session();
    return $_SESSION[$nom];
}

// Çesta funcion serviria para cerrar la sesion
function unset_session(){
    start_session();
    session_unset();
    session_destroy();
}

// verifica si la sesion exite
function is_session(String $nom){
    // necesitamos q la sesion este iniciada porque sino da error al usar $_SESSION
    start_session();
    $existe=isset($_SESSION[$nom]);

    return $existe;
}
?>