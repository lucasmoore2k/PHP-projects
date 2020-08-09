<?php 
 require_once "validador.php";



//Chamados
$chamados = array();
             
//Abrindo arquivo no back end
$arquivo = fopen('arquivo.txt','r');

while(!feof($arquivo)){
 //Recupera as linhas
$registro = fgets($arquivo);

//Separo os arquivos dentro do codigo num array
$dados = explode('#', $registro);

//Ao logar o usuário (não admin) ele vai executar a lógica abaixo
if ($_SESSION['id']==2){
  //Os dados[i] são os dados de registro,se o usuário logado for diferente do usuario do registro o programa não fará nada(continue)
  if($dados[0] != $_SESSION['id']){
    continue;
  }
} else{
  $chamados[] = $registro;
}



}

//fechar
fclose($arquivo);


 ?>


<html>
  <head>
    <meta charset="utf-8" />
    <title>App Help Desk</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      .card-consultar-chamado {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
      }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="home.php">
        <img src="logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        LUCAS M - Help Desk
      </a>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="logoff.php">SAIR</a>
        </li>
      </ul>
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-consultar-chamado">
          <div class="card">
            <div class="card-header">
              Consulta de chamado
            </div>
            
            <div class="card-body">

              
              <? foreach($chamados as $chamado) { ?>
              
                <?php

                  $dados_exibicacao = explode('#', $chamado);

                  //não existe detalhes do chamado se ele não estiver completo
                  if(count($dados_exibicacao) < 3) {
                    continue;
                  }

                ?>
  
              <div class="card mb-3 bg-light">
                <div class="card-body">
                  <h5 class="card-title"><?=$dados_exibicacao[1]?></h5>
                  <h6 class="card-subtitle mb-2 text-muted"><?=$dados_exibicacao[2]?></h6>
                  <p class="card-text"><?=$dados_exibicacao[3]?></p>

                </div>
              </div>

            <? } ?>

            

           

            

              <div class="row mt-5">
                <div class="col-6">
                  <a class="btn btn-lg btn-warning btn-block" type="submit" href="home.php">Voltar</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>