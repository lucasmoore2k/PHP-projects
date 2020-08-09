<?php 
session_start();

 if(!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'SIM'){
    header('Location: index.php?login=Faça login antes de tentar acessar as páginas restritas');
  }






?>