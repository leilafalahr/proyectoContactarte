<?php
require 'config/configBD.php';
$error_array=array();

if (isset($_POST['registrar'])) {

    //recibir los datos del post
    $nombre = filter_var($_POST['nombre'],FILTER_SANITIZE_STRING);
    $nombre = ucfirst(strtolower($nombre));//poner la primera letra en mayúscula
    $_SESSION['nombre'] = $nombre; //Recupera la variable de la sesión anterior

    $apellido = filter_var($_POST['apellido'],FILTER_SANITIZE_STRING);
    $apellido = ucfirst(strtolower($apellido));//poner la primera letra en mayúscula
    $_SESSION['apellido'] = $apellido; //Recupera la variable de la sesión anterior

    $username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
    $_SESSION['username'] = $username; //Recupera la variable de la sesión anterior

    $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $_SESSION['email'] = $email; //Recupera la variable de la sesión anterior

    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($_POST['tipoUsuario']=="artista"){
        $tipo_de_usuario = 0;
    } else{
        if($_POST['tipoUsuario']=="reclutador") {
            $tipo_de_usuario = 1;
        }
    }

    //Verificar que el correo ya está en uso
    $emailExiste = mysqli_query($con, "SELECT email from usuarios WHERE email='$email'");
    $checkEmail = mysqli_num_rows($emailExiste);

    if($checkEmail > 0) {
        array_push($error_array,"El correo electrónico ya está en uso.");
    }
    //Verificar que el username ya está en uso
    $usernameExiste = mysqli_query($con, "SELECT username from usuarios WHERE username='$username'");
    $checkUsername = mysqli_num_rows($usernameExiste);

    if($checkUsername > 0) {
        array_push($error_array,"El username ya está en uso.");
    }

    //Verificar que las contraseñas están correctas
    if($password != $password2){
        array_push($error_array, "Las contraseñas no coinciden.");
    }
    //Verificar que la contraseña tiene entre 20 y 5 caracteres
    if(strlen($password)>20 OR strlen($password<5)){
        array_push($error_array, "La contraseña tiene que tener entre 20 y 5 caracteres.");
    }
    //encriptar contraseña antes de enviarla a la BD
    if(empty($error_array)) {
        $password = md5($password);
        //mandar los datos a la BD
        $query = mysqli_query($con, "INSERT INTO usuarios (nombre,apellido,username,email,password,tipo_de_usuario) VALUES ('$nombre', '$apellido', '$username', '$email', '$password', '$tipo_de_usuario')");

        $img_perfil = 'images/imagenes_perfil/foto_perfil_por_defecto.png';
        if($tipo_de_usuario==0){
            mysqli_query($con,"INSERT INTO artistas(username,imagen_perfil) VALUES ('$username','$img_perfil')");
        }else{
            mysqli_query($con,"INSERT INTO reclutadores(username,imagen_perfil) VALUES ('$username','$img_perfil')");
        }
    }

    //Limpiar las variables de sesión
    $_SESSION['nombre'] = "";
    $_SESSION['apellido'] = "";
    $_SESSION['username'] = "";
    $_SESSION['email'] = "";
    $_SESSION['password'] = "";

}//registrar
