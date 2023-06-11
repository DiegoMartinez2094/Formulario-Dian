<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>formulario</title>
</head >

<?php
/**FUNCION ELIMINAR */
if (isset($_POST['eliminar'])) {
    if (!empty($_POST['cedula'])) {
        $cedula = $_POST['cedula'];
        $url = "https://6480e391f061e6ec4d49fed8.mockapi.io/informacion?cedula=" . urlencode($cedula);
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        if (!empty($data)) {
            $id = $data[0]['id'];
            $credenciales["http"]["method"] = "DELETE";
            $config = stream_context_create($credenciales);
            $url = "https://6480e391f061e6ec4d49fed8.mockapi.io/informacion/" . urlencode($id);
            $response = file_get_contents($url, false, $config);
            if ($response !== false) {
                echo "<h1>Los datos se eliminaron correctamente.</h1>";
            } else {
                echo '<h1>No se encontraron datos para la cédula ingresada.</h1>';
            }
        }
    }
}
/**-------------------------------------------------------------------------------------------------------------------------------------------------------- */
/** FUNCION EDITAR */
if (isset($_POST['editar'])) {
    if (!empty($_POST['cedula'])) {
         $cedula = $_POST['cedula'];
        $url = "https://6480e391f061e6ec4d49fed8.mockapi.io/informacion?cedula=" . urlencode($cedula);
            $response = file_get_contents($url);
            $data = json_decode($response, true);
        if (!empty($data)) {
            $id = $data[0]['id'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST["apellido"];
            $direccion = $_POST['direccion'];
            $edad = $_POST['edad'];
            $email = $_POST['email'];
            $horario = $_POST['horario'];
            $team = $_POST['team'];
            $trainer = $_POST['trainer'];
            // Construir el array de datos a enviar en la solicitud de actualización
            $dataToUpdate = array(
                'nombre' => $nombre,
                'apellido' => $apellido,
                'direccion' => $direccion,
                'edad' => $edad,
                'email' => $email,
                'horario' => $horario,
                'team' => $team,
                'trainer' => $trainer,
                'cedula' => $cedula,
            );
            $jsonData = json_encode($dataToUpdate); // Convertir los datos a formato JSON
            // Construir las credenciales y configuración de la solicitud
            $credenciales["http"]["method"] = "PUT";
            $credenciales["http"]["header"] = "Content-type: application/json";
            $credenciales["http"]["content"] = $jsonData;
            $config = stream_context_create($credenciales);
            $url = "https://6480e391f061e6ec4d49fed8.mockapi.io/informacion/" . urlencode($id);// Realizar la solicitud de actualización enviando los datos al endpoint correspondiente
            $response = file_get_contents($url, false, $config);
            
            if ($response !== false) {
                echo '<h1>Los datos se actualizaron correctamente.</h1>';
            } else {
                echo "Error al actualizar los datos.";
            }
        }
    } else {
        echo " <h1>No se encontraron datos para la cédula ingresada.</h1>";
    }
}
/**--------------------------------------------------------------------------------------------------------------------------------------------------------------- */
/**FUNCION BUSCAR E IMPRIMIR EN LOS INPUTS LA INFORMACION */
if (isset($_POST['buscar'])) {
    if (!empty($_POST['cedula'])) {
        $cedula = $_POST['cedula'];
        $url = "https://6480e391f061e6ec4d49fed8.mockapi.io//informacion?cedula=" . urlencode($cedula);
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if (!empty($data)) {
            $nombre = $data[0]['nombre'];
            $apellido = $data[0]['apellido'];
            $direccion = $data[0]['direccion'];
            $edad = $data[0]['edad'];
            $email = $data[0]['email'];
            $horario = $data[0]['horario'];
            $team = $data[0]['team'];
            $trainer = $data[0]['trainer'];
        } else {
            echo '<h1>No se encontraron resultados.</h1>';
        }
    }
}
/**--------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
?>

<body>
    <form method="POST">
        <div class="container">
            <br><br>
            <div class="row">
                <div class="col-lg-8">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <input type="text" name="nombre" placeholder="Nombre"
                        value="<?php echo isset($nombre) ? $nombre : ''; ?>">
                </div>
                <div class="col-lg-4">
                    <h2>Campuslands</h2>
                </div>
                <br /><br />
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <input type="text" name="apellido" placeholder="Apellido"
                        value="<?php echo isset($apellido) ? $apellido : ''; ?>">
                </div>
                <div class="col-lg-4">
                    <input type="number" name="edad" placeholder="Edad" |
                        value="<?php echo isset($edad) ? $edad : ''; ?>"> <br /><br />
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <input type="text" name="direccion" placeholder="Direccion"
                        value="<?php echo isset($direccion) ? $direccion : ''; ?>">
                </div>
                <div class="col-lg-4">
                    <input type="text" name="email" placeholder="Email"
                        value="<?php echo isset($email) ? $email : ''; ?>"><br /><br />
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <input type="time" name="horario" placeholder="Horario de entrada"
                        value="<?php echo isset($horario) ? $horario : ''; ?>"> <label>Horario de entrada</label>

                </div>
                <div class="col-lg-1">
                    <input type="submit" value="✔" name="crear"> <label>Crear</label>
                </div>
                <div class="col-lg-2">
                    <input type="submit" value="X" name="eliminar"> <label>Eliminar</label> <br /><br />
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <input type="text" name="team" placeholder="Team" value="<?php echo isset($team) ? $team : ''; ?>">
                </div>
                <div class="col-lg-1">
                    <input type="submit" value="✎" name="editar"> <label>Editar</label>
                </div>
                <div class="col-lg-1">
                    <input type="submit" value="🔍" name="buscar"><label>Buscar</label>
                </div> <br /><br />
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <input type="text" name="trainer" placeholder="Trainer"
                        value="<?php echo isset($trainer) ? $trainer : ''; ?>">
                </div>
                <div class="col-lg-4">
                    <input type="number" name="cedula" placeholder="cedula"
                        value="<?php echo isset($cedula) ? $cedula : ''; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
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
$url = "https://6480e391f061e6ec4d49fed8.mockapi.io/informacion/";

if (isset($_POST['crear'])) {
    if (!empty($_POST['cedula'])) {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $direccion = $_POST["direccion"];
        $edad = $_POST["edad"];
        $email = $_POST["email"];
        $horario = $_POST["horario"];
        $team = $_POST["team"];
        $trainer = $_POST["trainer"];
        $cedula = $_POST["cedula"];

        $newData = [
            "nombre" => $nombre,
            "apellido" => $apellido,
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
}
// Obtener los datos 
$data = getData($url);
$arrayAsociativo = json_decode($data, true); //convertir string a array 
echo '<div class="row">
        <div class="col-lg-6">
            <table class="table" style="margin-left:300px">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Edad</th>
                        <th scope="col">Email</th>
                        <th scope="col">Horario entrada</th>
                        <th scope="col">Team</th>
                        <th scope="col">Trainer</th>
                    </tr>
                </thead>
                <tbody>';

foreach ($arrayAsociativo as $item) { 
echo '<tr>
            <td>' . $item['nombre'] . '</td>
            <td>' . $item['apellido'] . '</td>
            <td>' . $item['direccion'] . '</td>
            <td>' . $item['edad'] . '</td>
            <td>' . $item['email'] . '</td>
            <td>' . $item['horario'] . '</td>
            <td>' . $item['team'] . '</td>
            <td>' . $item['trainer'] . '&nbsp &nbsp <input type="button" value="↑" name="editar"></td>
        </tr>';
}
echo '</tbody>
        </table>
    </div>
</div>';
?>