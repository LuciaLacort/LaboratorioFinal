<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
</head>

<body class="body">
    <div class="container">
    <h1>¡Regístrate!</h1>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellido1">Primer apellido:</label>
            <input type="text" id="apellido1" name="apellido1" required>

            <label for="apellido2">Segundo apellido:</label>
            <input type="text" id="apellido2" name="apellido2" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login">
        </form>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "Empleados";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = validateInput($_POST["nombre"]);
            $apellido1 = validateInput($_POST["apellido1"]);
            $apellido2 = validateInput($_POST["apellido2"]);
            $email = validateInput($_POST["email"]);
            $password = validateInput($_POST["password"]);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo '<div class="error">Error: El email no tiene un formato válido.</div>';
            } else {
                $sql = "SELECT * FROM USERS WHERE email = '$email'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<div class="error">Error: Este email ya está registrado. Introduzca otro email válido.</div>';
                } else {
                    if (strlen($password) < 4 || strlen($password) > 8) {
                        echo '<div class="error">Error: La contraseña debe tener entre 4 y 8 caracteres.</div>';
                    } else {
                        $sql = "INSERT INTO USERS (nombre, apellido1, apellido2, email, password) VALUES ('$nombre', '$apellido1', '$apellido2', '$email', '$password')";

                        if ($conn->query($sql) === TRUE) {
                            echo '<div class="success">Registro creado con éxito</div>';
                            echo '<button onclick="location.href=\'consulta.php\'">Consulta</button>';
                            exit();
                        } else {
                            echo '<div class="error">Error al crear el registro: ' . $conn->error . '</div>';
                        }
                    }
                }
            }
        }

        function validateInput($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $conn->close();
        ?>

    </div>
</body>
</html>
