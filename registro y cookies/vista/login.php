<?php
    require_once 'cabecera.html';
?>
<body>
    <form action="index.php?action=iniciar" method="post">
        <input type="text" name="nom" placeholder="Introduce tu nombre" value=<?php if(isset($_COOKIE["usuario"])) echo $_COOKIE["usuario"] ?> >
        <!-- este primer input lo que hace es que si existe la cookie de usuario, se muestre el valor de la cookie -->
        <input type="pasword" name="psw" placeholder="Introduce tu contraseña">
        <br><br>

        <!-- Campo para las cookies -->
         <input type="checkbox" name="rec" <?php
         if(isset($_COOKIE["usuario"]))  echo "checked" ?>>
         <!-- si existe la cookie de usuario, se muestre el checkbox marcado  -->
          <label for="rec">Recuerdame</label>
          <br><br>

          <input type="submit" value="Eniviar" name="fini">
    </form>

    <p>Si no tienes cuenta <a href="index.php?action=registro">Registrate</a></p>
</body>

<?php
    require_once 'pie.html';
?>