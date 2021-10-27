<?php 

session_start();
if(!isset($_SESSION['usuario'])){
    //echo "redirigir al login...no hay usuario";
    header('location:index.php');
}{
    //print_r($_SESSION['usuario']);
}
?>