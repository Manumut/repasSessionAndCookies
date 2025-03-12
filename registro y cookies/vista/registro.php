<?php
    require_once("cabecera.html")
?>
<body>
    <?php if(isset($err)) echo $err; //MENSAJE DE ERROR Q HAGO EN EL INDEX.PHP ?> 

    <form action="index.php?action=registrar" method="post">
        <input type="text" name="nom" placeholder="Nombre del usuario">
        <br>
        <input type="password" name="psw" placeholder="introduzca la contraseña">
        <br>

        <input type="password" name="psw2" placeholder="repita la contraseña">
        <br>

        <input type="submit" value="enviar" name="regis">

        <p>¿Tienes cuenta? <a href="login.php">Login</a></p>

    </form>
</body>


<?php
    require_once("pie.html")
?>