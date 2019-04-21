<?php
session_start();

function dd($valor){
    echo "<pre>";
        var_dump($valor);
        exit;
    echo "</pre>";
}

function validarLogin($datos){
    $errores=[];
    $usuario=trim($datos["UsuarioLogin"]);
    if (empty($usuario)){
        $errores["UsuarioLogin"]='Por favor, ingresa un usuario';
    }
    $password=trim($datos["PasswordLogin"]);
    if(!empty($password)){
    $user=buscarEmail($usuario);
        if (empty($user)){
             $errores["Login"]="Usuario o clave incorrecto";}
             else{
                if(password_verify($password,$user["password"])){
                    return $errores;
                }else{
                    $errores["Login"]="Usuario o clave incorrecto";    
                }
            }
    }
    else{
        $errores["Password"]="No ingresaste tu password";
        }
    return $errores;
}

function validarSignUp($datos){
    $errores=[];
    $usuario=trim($datos["usuarioSignUp"]);
    if (empty($usuario)){
        $errores["usuarioSignUp"]='Por favor, ingresa un usuario';
    }
    
    $email=trim($datos["mailSignUp"]);
    if (!empty($email)){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errores["mailSignUp"]='Por favor, ingresa un email valido';    
        }
    }else{
        $errores["mailSignUp"]='Por favor, ingresa un email';
    }

    $password=trim($datos["passwordSignup"]);
    $repassword=trim($datos["repasswordSignup"]);
    if(empty($password)){
        $errores["Password"]="No ingresaste un password";
        }elseif (strlen($password)<6){
            $errores["Password"]="Tu password tiene menos de 6 caracteres";
        }elseif($password!=$repassword){
            $errores["RePassword"]="Los password no son igual";
        }
    if($_FILES["avatar"]["size"]==0){
            $errores["avatar"]="Error debe subir imagen";
        }else{
            $nombre = $_FILES["avatar"]["name"];
            $ext = pathinfo($nombre,PATHINFO_EXTENSION);
            if($ext != "png" && $ext != "jpg"){
                $errores["avatar"]="Debe seleccionar archivo png ó jpg";
                }
        } 
    return $errores;
}

/*
function validar($datos){
    $errores=[];

    $nombre = trim($datos["nombre"]);
    if(empty($nombre)){
        $errores["nombre"]= "El campo nombre no debe estar vacio";
    }
    $email = trim($datos["email"]);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errores["email"]="Email invalido !!!!!";
    }
    $password= trim($datos["password"]);
    $repassword = trim($datos["repassword"]);
    if(empty($password)){
        $errores["password"]= "Hermano mio el campo password no lo podés dejar en blanco";
    }elseif (strlen($password)<6) {
        $errores["password"]="La contraseña debe tener como mínimo 6 caracteres";
    }elseif ($password != $repassword) {
        $errores["repassword"]="Las contraseñas no coinciden";
    }
 
    if(isset($_FILES)){
        if($_FILES["avatar"]["error"]!=0){
            $errores["avatar"]="Error debe subir imagen";
        }
        $nombre = $_FILES["avatar"]["name"];
        $ext = pathinfo($nombre,PATHINFO_EXTENSION);
        if($ext != "png" && $ext != "jpg"){
            $errores["avatar"]="Debe seleccionar archivo png ó jpg";
        }
            
    }

    return $errores;
}
*/

function inputUsuario($campo){
    if(isset($_POST[$campo])){
        return $_POST[$campo];
    }
}

function armarAvatar($imagen){
    $nombre = $imagen["avatar"]["name"];
    $ext = pathinfo($nombre,PATHINFO_EXTENSION);
    $archivoOrigen = $imagen["avatar"]["tmp_name"];
    $archivoDestino = dirname(__DIR__);
    $archivoDestino = $archivoDestino."/img/";
    $avatarPerfil = uniqid();
    $archivoDestino = $archivoDestino.$avatarPerfil;
    $archivoDestino = $archivoDestino.".".$ext;
    move_uploaded_file($archivoOrigen,$archivoDestino);
    $avatarPerfil = $avatarPerfil.".".$ext;
    return $avatarPerfil;
}

function armarRegistro($datos,$imagen){
    $usuario = [
        "nombre"=>$datos["usuarioSignUp"],
        "email"=>$datos["mailSignUp"],
        "password"=>password_hash($datos["passwordSignup"],PASSWORD_DEFAULT),
        "avatar"=>$imagen,
    ];
    return $usuario;
}

function guardarUsuario($usuario){
    $jsusuario = json_encode($usuario);
    file_put_contents('usuarios.json',$jsusuario. PHP_EOL, FILE_APPEND);
}

function buscarEmail($email){
    $baseDatosUsuarios = abrirBaseDatos(); 
    foreach ($baseDatosUsuarios as  $usuario) {
        if ($usuario["email"]== $email){
            return $usuario;
        }
    }
    return null;
}

function abrirBaseDatos(){
    $bDjson = file_get_contents("usuarios.json");
    $bDUsuarios = explode(PHP_EOL, $bDjson);
    array_pop($bDUsuarios);
    foreach ($bDUsuarios as $usuario) {
        $baseDatosUsuarios[]= json_decode($usuario,true);
    }
    return $baseDatosUsuarios;
}

function seteoSesion($usuario,$datos){
    $_SESSION["email"]=$usuario["email"];
    $_SESSION["nombre"]=$usuario["nombre"];
    $_SESSION["avatar"]=$usuario["avatar"];
    
    setcookie("email",$usuario["email"],time()+3600);
    if(isset($datos["recordar"])){
        setcookie("password",$datos["password"],time()+3600);
    }    
}

function controlAcceso(){
    if(isset($_SESSION["email"])){
        return true;
    }elseif (isset($_COOKIE["email"])) {
        $_SESSION["email"]=$_COOKIE["email"];
        return true;
    }else{
        return false;
    }    
}


function logout(){
    session_start();
    session_destroy();
    setcookie("email","",time()-1);
    if(isset($_COOKIE["password"])){
        setcookie("password","",time()-1);
    }    
}