<?php
require "connection.php";
$conexion = conectarBD();

session_start();

$localidadSeleccionada = '';
if(isset($_SESSION['localidad'])) {
    $localidadSeleccionada = $_SESSION['localidad'];
}

if(isset($_GET['localidad'])) {
    $localidadSeleccionada = $_GET['localidad'];
    $_SESSION['localidad'] = $localidadSeleccionada;
}

?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>Taquillator</title>
</head>

<body>
    <form action="" method="get">
    <select name="localidad">
        <option value="">Todas las localidades</option>
        <option value="Gijón" <?= $localidadSeleccionada == 'Gijón' ? 'selected' : ''; ?> >Gijón</option>
        <option value="Oviedo" <?= $localidadSeleccionada == 'Oviedo' ? 'selected' : ''; ?>>Oviedo</option>
        <option value="Avilés" <?= $localidadSeleccionada == 'Avilés' ? 'selected' : ''; ?>>Avilés</option>
    </select>
        <input type="submit" value="Buscar">
    </form>

</body>

</html>



<?php

if (isset($_GET['localidad'])) {

    ////////////////////////////////////////////
    // TODO 2: Obtener taquillas según filtro //
    ////////////////////////////////////////////

    $localidad = $_GET['localidad'];
    $sql = "SELECT * FROM puntosderecogida WHERE localidad = '$localidad'";

    $resultado = $conexion->query($sql);
    if ($resultado->rowCount() > 0) {
        echo "<table><tr><th>Localidad</th><th>Dirección</th><th>Capacidad</th><th>Ocupadas</th></tr>";
        /////////////////////////////////////
        // TODO 3: Imprimir filas de tabla //

        /////////////////////////////////////
        while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
            if ($fila['capacidad'] != $fila['ocupadas']) {
                echo "<tr>";
                echo "<td>" . $fila['localidad'] . "</td>";
                echo "<td>" . $fila['direccion'] . "</td>";
                echo "<td>" . $fila['capacidad'] . "</td>";
                echo "<td>" . $fila['ocupadas'] . "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
    } else {
        $sql = "SELECT * FROM puntosderecogida";
        $resultado = $conexion->query($sql);
    if ($resultado->rowCount() > 0) {
        echo "<table><tr><th>Localidad</th><th>Dirección</th><th>Capacidad</th><th>Ocupadas</th></tr>";
        while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
            if ($fila['capacidad'] != $fila['ocupadas']) {
                echo "<tr>";
                echo "<td>" . $fila['localidad'] . "</td>";
                echo "<td>" . $fila['direccion'] . "</td>";
                echo "<td>" . $fila['capacidad'] . "</td>";
                echo "<td>" . $fila['ocupadas'] . "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
    }}}
?>