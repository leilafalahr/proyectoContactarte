<?php
require 'config/configBD.php';
if (isset($_SESSION['username'])){
    $usuario_loggeado = $_SESSION['username'];

    $usuario_detalles = mysqli_query($con,"SELECT * FROM usuarios WHERE username='$usuario_loggeado'");
    $usuario = mysqli_fetch_array($usuario_detalles);

    $artista_detalles = mysqli_query($con, "SELECT * FROM artistas WHERE username='$usuario_loggeado'");
    $artista = mysqli_fetch_array($artista_detalles);

    $reclutador_detalles = mysqli_query($con, "SELECT * FROM reclutadores WHERE username='$usuario_loggeado'");
    $reclutador = mysqli_fetch_array($reclutador_detalles);

    $checkEsArtista = mysqli_query($con,"SELECT tipo_de_usuario FROM usuarios where tipo_de_usuario=0 AND username='$usuario_loggeado'");
    $consultaCheckArtista = mysqli_num_rows($checkEsArtista);
}else{
    header('Location: registro.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>contact(arte)</title>
    <link rel="stylesheet" href="style/style.css">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <!--script js / ajax-->
    <script src="../js/uploadImage.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


</head>
<body>
<div class="header"><!--header-->
    <a href="index.php"><img src="images/imagenes_logo/logo_contactarte_peq2.png" alt="" class="imagen-peq"></a>
    <?php

    if ($consultaCheckArtista == 1){
        echo " <a href='perfil.php' class='enlace-header' ><i class='fas fa-user-alt'style='color:black;font-size:20px'>  Mi perfil</i>
    </a>";
    }else{
        echo "<a href='perfilR.php' class='enlace-header' ><i class='fas fa-user-alt'style='color:black;font-size:20px'>  Mi perfil</i>
    </a>";
    }
    ?>

    <a href="#" class="enlace-header"><i class='fas fa-comment-alt' style='color:black;font-size:20px'></i>
    </a>
    <a href="handlers/logout.php" class="enlace-header"><i class='fa fa-gear' style='color:black;font-size:20px'></i>
    </a>
</div> <!--header-->
