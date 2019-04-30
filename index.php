<?php
include_once("controladores/funciones.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" media="screen" href="css/estilos.css">
  <link href="https://fonts.googleapis.com/css?family=Shrikhand" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Encode+Sans|Shrikhand" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="main.js"></script>
  <title>Queer Cheer - Home</title>
</head>
<body> 
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand logo_" href="index.php">QC!</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
            </li>
            <?php if(!isset($_SESSION["email"])):?>
              <li class="nav-item">
                  <a class="nav-link" href="login.php">Login</a> 
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="signup.php">Registrate</a>  
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
  <!--CABECERA-->
  <div class="card bg-dark text-white ">
    <img src="img/inicio.jpeg" class="card-img" alt="fotodefondo">
    <div class="card-img-overlay">
      <div class="titulo">
        <h5 class="card-title tituloQC">Queer Cheer</h5>
      </div>
    </div>
  </div>

 <!--SOBRE NOSOTROS-->
  <div class="container">
    <div class="row">
      <div class="col-6 col-md-12 about"> 
        <br>
        <section>
          <article>
            <h5 class="tituloabout">
              Nuestra Historia!
            </h5>
            <p class="about">
              Somos un grupo de desarrolladores que crearon Queer Cheer, juego
              <br>
              de preguntas y respuestas, basadas en la cultura queer.
              <br>
              Preguntas desde música, teatro, política y más! Listo para que juegues con tus amigos o solo!
            </p>
            <hr>
            <h5 class="tituloabout">
            Comparte tu experiencia!
            </h5>
            <p class="about">
            Puedes subir tu video jugando a las redes sociales etiquetandonos a @QueerCheer!
              <br>
            Compartiremos los más divertidos!
            </p>
          </div>
          </article> 
        </section>
      <!--HIPERVINCULOS PARA IRSE A JUGAR-->
      <div class="col-6 col-md-12">
        <div class="card text-white bg-warning mb-3 jugar" >
          <div class="card-header">NIVEL: FÁCIL</div>
          <div class="card-body">
            <a href="login.html"> <h5 class="card-title play">PLAY</h5></a>
          </div>
        </div>
        <div class="card text-white bg-info mb-3 jugar" >
          <div class="card-header">NIVEL: DIFÍCIL</div>
            <div class="card-body">
              <a href="login.html"> <h5 class="card-title play">PLAY</h5></a>
            </div>
        </div>
      </div>
    </div>
  </div>

      <!--FOOTER -->
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
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>     
</body>
</html>