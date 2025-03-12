<?php
    require_once("cabecera.html")
?>
<body>
    <!-- Si tengo el nombre del usuario, lo muestro -->
    <h1>Bienvenido <?php if(isset($nUsu)) echo $nUsu ?> </h1>

    <form action="index.php?action=cerrar" method="post">
        <input type="submit" value="cerrar" name="cerr">
    </form>
</body>




<?php
    require_once("pie.html")
?>