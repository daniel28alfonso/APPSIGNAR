<?php  //echo "soy index en modulos";

if(isset($_POST["btnlogin"])){

    include("global/conexion.php");

    $txtemail=($_POST["txtemail"]);
    $txtpassword=($_POST["txtpassword"]);

    $sentenciaSQL=$pdo->prepare("SELECT * FROM registro
    WHERE correo=:correo AND password=:password");
   
    $sentenciaSQL->bindParam("correo",$txtemail,PDO::PARAM_STR);
    $sentenciaSQL->bindParam("password",$txtpassword,PDO::PARAM_STR);
    $sentenciaSQL->execute();
    
    $registro=$sentenciaSQL->fetch(PDO::FETCH_ASSOC);
    /*print_r($registro);*/
     //inicio de sesion
    

    $numeroRegistros=$sentenciaSQL->rowCount();

    if ($numeroRegistros>=1){

        session_start();
        $_SESSION['usuario']=$registro;
        echo "BIENVENIDO.......";
        header('location:inicio.php');

    }else{
        echo "NO SE ENCONTRARON REGISTROS.......";
    }
    echo "<br/> hay que validar el correo y contraseña";
}




?>