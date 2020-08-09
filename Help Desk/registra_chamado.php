<?php 

session_start();



$titulo = str_replace('#', '-',$_POST['titulo']);
$categoria = str_replace('#', '-',$_POST['categoria']);
$descrição = str_replace('#', '-',$_POST['descrição']);

//Funcao PHP EOL gera uma quebra de linha a cada registro
$texto = $_SESSION['id'].'#'.$titulo.'#'.'Categoria: '.$categoria.'#'.'Descrição: '.$descrição.PHP_EOL;


//fopen(nome,o que desejo fazer)
$arquivo = fopen('arquivo.txt','a');

//escrevendo o texto dentro do arquivo
fwrite($arquivo, $texto);

//fechando arquivo
fclose($arquivo);

//redirecionamento
header('Location: abrir_chamado.php');
 ?>