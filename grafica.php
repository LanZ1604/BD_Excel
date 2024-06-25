<?php
$servername = "b9bdlxqzkhuj5i1vnrru-mysql.services.clever-cloud.com";
$username = "uubaage33ygqjkn9";
$password = "GWidIGmHPgspC1CMiweD";
$dbname = "b9bdlxqzkhuj5i1vnrru";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname, 3306); // Agregamos el puerto 3306

// Verificar la conexión
if ($conn->connect_error) {
    die(json_encode(["error" => "Conexión fallida: " . $conn->connect_error]));
}

// Consultar los datos
$sql = "SELECT Fecha, IED, FBCF, Porcentaje FROM mi_bd_workbench";
$result = $conn->query($sql);

if ($result === FALSE) {
    die(json_encode(["error" => "Error en la consulta: " . $conn->error]));
}

$fechas = [];
$ied = [];
$fbcf = [];
$porcentajes = [];

if ($result->num_rows > 0) {
    // Recoger los datos
    while($row = $result->fetch_assoc()) {
        $fechas[] = $row["Fecha"];
        $ied[] = $row["IED"];
        $fbcf[] = $row["FBCF"];
        $porcentajes[] = $row["Porcentaje"];
    }
    echo json_encode([
        "fechas" => $fechas,
        "ied" => $ied,
        "fbcf" => $fbcf,
        "porcentajes" => $porcentajes
    ]);
} else {
    echo json_encode(["error" => "0 resultados"]);
}
$conn->close();
?>