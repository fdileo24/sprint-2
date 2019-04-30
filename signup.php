<?php
include_once("controladores/funciones.php");
$errores=[];
if (($_POST)){
  $errores=validarSignUp($_POST);
  if (count($errores)==0){
    $avatarperfil=armarAvatar($_FILES);
    $usuario=armarRegistro($_POST,$avatarperfil);
    guardarUsuario($usuario);
    seteoSesion($usuario,$_POST);
    header('Location: index.php');
  }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Queer Cheer - Registrate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="css/estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="main.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand logo_" href="index.php">QC!</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <?php if(!isset($_SESSION["email"])):?>
              <li class="nav-item">
                  <a class="nav-link" href="login.php">Login</a> 
              </li>
              <li class="nav-item active">
                  <a class="nav-link" href="signup.php">Registrate<span class="sr-only">(current)</span></a>  
              </li>
            <?php endif;?>
              <li class="nav-item ">
                  <a class="nav-link" href="preguntas.php">FAQ</a> 
              </li>
            <?php if(isset($_SESSION["email"])):?>
              <li class="nav-item">
              <a class="nav-link" href="perfil.php">Perfil</a>            
              </li>
              <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>            
              </li>
            <?php endif;?>
          </ul>
        </div>
      </nav>

      <!-- Tabla de errores  -->
      <?php
        if (count($errores)>0):?>
            <ul class="alert alert-danger">
            <?php foreach ($errores as $key => $value) :?>
                <li><?=$value;?></li>
            <?php endforeach;?>
            </ul>
      <?php endif;?>

      <!-- Formulario  -->
      <div class="login">
    <form class="text-center border border-0 p-5 col-md-4  center_div__ " method="POST" enctype="multipart/form-data" >   
        <!-- <form class="text-center border border-light p-5 col-md-4 col-sm-6 center_div__ "> -->
        <p class="h4 mb-4 text-white">Sign up</p>
        
        <!-- Usuario -->
        <input type="text" id="usuarioSignUp" class="form-control mb-4" <?php
        if (empty($_POST["usuarioSignUp"])):?> placeholder="Usuario" <?php else:?> value=<?=$_POST["usuarioSignUp"];?> <?php endif;?> name="usuarioSignUp">

        <!-- E-mail -->
        <input type="email" id="Email" class="form-control mb-4" <?php
    if (empty($_POST["mailSignUp"])):?> placeholder="E-mail" <?php else:?> value=<?=$_POST["mailSignUp"];?> <?php endif;?>  name="mailSignUp">
        <!-- No se persiste el password por cuestiones de seguridad"> -->
        <!-- Password -->
        <input type="password" id="defaultRegisterFormPassword" class="form-control mb-4 " placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock" name="password">
        <!-- RePassword -->
        <input type="password" id="defaultRegisterFormPassword" class="form-control mb-4 " placeholder="Confirma el password" aria-describedby="defaultRegisterFormPasswordHelpBlock" name="repassword">
        <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-white mb-4 ">
          El password debe tener por lo menos 6 caracteres.
        </small>
        <!--imagen -->
        <div class="custom-file">
        <input type="file" class="custom-file-input" id="avatar" name="avatar" >
        <label class="custom-file-label" for="avatar">Elegi una foto</label>
        </div>
        <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-white mb-4 ">
          Selecciona una imagen de avatar , debe ser jpeg.
        <!-- Botom -->
        <button class="btn btn-info my-4 btn-block " type="submit">Registrate!</button>
        <hr>

        <!--ToS -->
        <p class="text-white">Haciendo click en 
            <em>Registrate</em> estas de acuerdo con nuestros
            <a href="" target="_blank" >Terminos y condiciones</a></p>

    </form>
  </div>
  <!--PIE DE PAG-->
    <footer class="pie">
        <div class="row">
            <section class="col-sm-12 col-md-6 col-lg-6">
              <h4>Servicio al Consumidor</h4>
              <br>
              <p>0800-19354778-99010</p>
              <br>
              <h4>Dirección</h4>
              <p>Virrey del Skere 1980</p>
            </section>
            <section class="col-sm-12 col-md-6 col-lg-6">
              <a href="https://www.facebook.com/"><i class="fa fa-facebook-square" style="font-size:36px"></i></a>
              <a href="https://www.instagram.com/"><i class="fa fa-instagram" style="font-size:36px"></i></a> 
              <a href="https://www.youtube.com/"><i class="fa fa-youtube-square" style="font-size:36px"></i></a> 
                <hr>
                  <p>© 2019 QueerCheer, Inc.</p>
            </section>  
        </div>
      </footer>
<!-- Default form register -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>