<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Inscritos</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Usuarios inscritos</h1>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "Empleados";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        $sql = "SELECT nombre, apellido1 FROM USERS";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>{$row['nombre']} {$row['apellido1']}</li>";
            }
            echo "</ul>";
        } else {
            echo "No hay usuarios registrados.";
        }

        $conn->close();
        ?>

    </div>
</body>
</html>
