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
                    <input type="submit" value="X" name="eliminar"> <br /><br />
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <input type="text" name="team" placeholder="Team">
                </div>
                <div class="col-lg-1">
                    <input type="submit" value="✎" name="editar">
                </div>
                <div class="col-lg-1">
                    <input type="submit" value="search" name="buscar">
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

        </div>

    </form>

</body>

</html>




<?php


// Función para realizar una solicitud POST a la API ENVIAR AL SERVIDOR 
function postData($url, $data)
{
    $credenciales["http"]["method"] = "POST";
    $credenciales["http"]["header"] = "Content-type: application/json";
    $data = json_encode($data);
    $credenciales["http"]["content"] = $data;
    $config = stream_context_create($credenciales);
    return file_get_contents($url, false, $config);
}


// Función para realizar una solicitud GET a la API OBTENER
function getData($url)
{
    $credenciales["http"]["method"] = "GET";
    $config = stream_context_create($credenciales);
    return file_get_contents($url, false, $config);
}

// Función para realizar una solicitud PUT a la API EDITAR
function putData($url, $data)
{
    $credenciales["http"]["method"] = "PUT";
    $credenciales["http"]["header"] = "Content-type: application/json";
    $data = json_encode($data);
    $credenciales["http"]["content"] = $data;
    $config = stream_context_create($credenciales);
    return file_get_contents($url, false, $config);
}

// Función para realizar una solicitud DELETE a la API ELIMINAR
function deleteData($url)
{
    $credenciales["http"]["method"] = "DELETE";
    $config = stream_context_create($credenciales);
    return file_get_contents($url, false, $config);
}


$url = "https://6480e391f061e6ec4d49fed8.mockapi.io/informacion/";

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

    $newData = [
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

    $response = postData($url, $newData);



}

// Obtener los datos 
$data = getData($url);
// echo "Datos después de crear el registro:<br>";
// print_r($data);
// echo "<br><br>";
$arrayAsociativo = json_decode($data, true); //convertir string a array 
// Mostrar el array asociativo
// print_r($arrayAsociativo);
echo '<div class="row">
            <div class="col-lg-6">
                <table class="table" style="margin-left:200px">
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
                    
                </table>
            </div>
        </div>';
foreach ($arrayAsociativo as $item) {
    echo '<div class="row">
            <div class="col-lg-6">
                <table class="table" style="margin-left:200px">
                    <tbody>
                        <tr>
                            <td>' . $item['nombre'] . '</td>
                            <td>' . $item['apellido'] . '</td>
                            <td>' . $item['direccion'] . '</td>
                            <td>' . $item['edad'] . '</td>
                            <td>' . $item['email'] . '</td>
                            <td>' . $item['horario'] . '</td>
                            <td>' . $item['team'] . '</td>
                            <td>' . $item['trainer'] . '&nbsp &nbsp <input type="button" value="↑" name="editar"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>';
}

if (isset($_POST['buscar'])) {
    $cedula = $_POST["cedula"];

    $url = "https://6480e391f061e6ec4d49fed8.mockapi.io/informacion/?cedula=" . urlencode($cedula);
    $response = file_get_contents($url);
    $data = json_decode($response, true);
    $data = getData($url);
    $arrayAsociativo = json_decode($data, true);
    print_r($arrayAsociativo);
    echo'<br>';
    echo gettype($arrayAsociativo);
}


?>