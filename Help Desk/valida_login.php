<?php

//Criando sessão
session_start();


$autenticado = false;
$usuario_id=null;
$usuario_perfil_id= null;


$perfis_users = array(1=>'Administrativo', 2=>'Usuario');

//Declarar array abaixo que será necessário para entrada,simulando um BD com os dados do usuário autorizado
$usuarios_app = array(
	array('id'=>1,'email'=> 'adm@teste.com', 'senha'=>'abcd', perfil_id=>1),
	array('id'=>2,'email'=> 'user@teste.com', 'senha'=>'abcd',perfil_id=>1),
    array('id'=>3,'email'=> 'jose@teste.com', 'senha'=>'abcd',perfil_id=>2),
    array('id'=>4,'email'=> 'maria@teste.com', 'senha'=>'abcd',perfil_id=>2),

);




//Percorrendo o array do BD e verificando se está de acordo com o valor do formulario
foreach ($usuarios_app as  $user) {
	//Se o usuário que consta no BD for igual ao usuário recebido pela requisição forem iguais o usuário é autenticado
	if($user['email'] == $_POST['email'] && $user['senha'] == $_POST['senha']) {
		$autenticado = true;
        $usuario_id = $user['id'];
        $usuario_perfil_id = $user['perfil_id'];
	}
}



//Criando a sessão e enviando uma respota de requisição
if($autenticado){
        //echo 'Usuário autenticado.';

        $_SESSION['autenticado'] = 'SIM';
        $_SESSION['id'] = $usuario_id;
        $_SESSION['perfil_id'] = $usuario_perfil_id;
        header('Location: home.php?login=Usuário Logado');
    }else{  
        $_SESSION['autenticado'] = 'NÃO';
        header('Location: index.php?login=Usuário/Senha incorreto(s)');
      }



?>