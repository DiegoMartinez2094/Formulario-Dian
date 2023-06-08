<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>formulario</title>
</head>

<body>
    <form method="POST">
        <div class="container">
            <br><br>
            <div class="row">
                <div class="col-lg-6">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <input type="text" name="nombre" placeholder="Nombre">
                </div>
                <div class="col-lg-3">
                    <h2>Campuslands</h2>
                </div>
                <br /><br />
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <input type="text" name="apellidos" placeholder="Apellidos">
                </div>
                <div class="col-lg-3">
                    <input type="number" name="edad" placeholder="Edad"> <br /><br />
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <input type="text" name="direccion" placeholder="Direccion">
                </div>
                <div class="col-lg-3">
                    <input type="text" name="email" placeholder="Email"><br /><br />
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <input type="time" name="horario" placeholder="Horario de entrada"> <label>Horario de
                        entrada</label>

                </div>
                <div class="col-lg-1">
                    <input type="submit" value="✔" name="crear">
                </div>
                <div class="col-lg-1">
                    <input type="button" value="X" name="eliminar"> <br /><br />
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <input type="text" name="team" placeholder="Team">
                </div>
                <div class="col-lg-1">
                    <input type="button" value="✎" name="editar">
                </div>
                <div class="col-lg-1">
                    <input type="button" value="search" name="buscar">
                </div> <br /><br />
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <input type="text" name="trainer" placeholder="Trainer">
                </div>
                <div class="col-lg-3">
                    <input type="number" name="cedula" placeholder="cedula">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Direccion</th>
                                <th scope="col">Edad</th>
                                <th scope="col">Email</th>
                                <th scope="col">Horario entrada</th>
                                <th scope="col">Team</th>
                                <th scope="col">Trainer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST['crear'])) {
                                $nombre = $_POST["nombre"];
                                $apellidos = $_POST["apellidos"];
                                $direccion = $_POST["direccion"];
                                $edad = $_POST["edad"];
                                $email = $_POST["email"];
                                $horario = $_POST["horario"];
                                $team = $_POST["team"];
                                $trainer = $_POST["trainer"];
                                $cedula = $_POST["cedula"];
                            }
                            ?>
                            <tr>
                                <?php

                                ?>
                                <td>
                                    <?php echo $nombre; ?>
                                </td>
                                <td>
                                    <?php echo $apellidos; ?>
                                </td>
                                <td>
                                    <?php echo $direccion; ?>
                                </td>
                                <td>
                                    <?php echo $edad; ?>
                                </td>
                                <td>
                                    <?php echo $email; ?>
                                </td>
                                <td>
                                    <?php echo $horario; ?>
                                </td>
                                <td>
                                    <?php echo $team; ?>
                                </td>
                                <td>
                                    <?php echo $trainer; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </form>

</body>

</html>




<?php
$credenciales["http"]["method"] = "POST";
$credenciales["http"]["header"] = "Content-type: application/json";

if (isset($_POST['crear'])) {
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $direccion = $_POST["direccion"];
    $edad = $_POST["edad"];
    $email = $_POST["email"];
    $horario = $_POST["horario"];
    $team = $_POST["team"];
    $trainer = $_POST["trainer"];
    $cedula = $_POST["cedula"];

    $data = [
        "nombre" => $nombre,
        "apellido" => $apellidos,
        "edad" => $edad,
        "cedula" => $cedula,
        "direccion" => $direccion,
        "email" => $email,
        "horario" => $horario,
        "team" => $team,
        "trainer" => $trainer,
    ];

    $data = json_encode($data); //convertir la matriz $data en un archivo json
    $credenciales["http"]["content"] = $data;
    $config = stream_context_create($credenciales);

    $_DATA = file_get_contents("https://6480e391f061e6ec4d49fed8.mockapi.io/informacion", false, $config);

}
?>