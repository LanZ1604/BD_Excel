<?php
$servername = "b9bdlxqzkhuj5i1vnrru-mysql.services.clever-cloud.com";
$username = "uubaage33ygqjkn9";
$password = "GWidIGmHPgspC1CMiweD";
$dbname = "b9bdlxqzkhuj5i1vnrru";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die(json_encode(["error" => "Conexión fallida: " . $conn->connect_error]));
}

// Consultar los datos
$sql = "SELECT Año, Trimestre, IED, FBCF, `IED/FBCF` FROM mi_bd_workbench2";
$result = $conn->query($sql);

if ($result === FALSE) {
    die(json_encode(["error" => "Error en la consulta: " . $conn->error]));
}

$anios = [];
$trimestres = [];
$ied = [];
$fbcf = [];
$ied_fbcf = [];

if ($result->num_rows > 0) {
    // Recoger los datos
    while($row = $result->fetch_assoc()) {
        $anios[] = $row["Año"];
        $trimestres[] = $row["Trimestre"];
        $ied[] = $row["IED"];
        $fbcf[] = $row["FBCF"];
        $ied_fbcf[] = $row["IED/FBCF"];
    }
    echo json_encode([
        "anios" => $anios,
        "trimestres" => $trimestres,
        "ied" => $ied,
        "fbcf" => $fbcf,
        "ied_fbcf" => $ied_fbcf
    ]);
} else {
    echo json_encode(["error" => "0 resultados"]);
}
$conn->close();
?>
