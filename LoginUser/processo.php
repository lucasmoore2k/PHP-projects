<?

include('conexao.php');

if(empty($_POST['user']) || empty($_POST['pass'])){
	header('Location:index.php?Erro=Preencha todos os campos!');
	exit();
}

	    //query
$query = "select * from tb_users where ";
$query .= " usuario = :usuario ";
$query .= "AND senha = :senha ";

		//Evitando injeção de SQL
$state = $conexao->prepare($query);
$state->bindValue(':usuario',$_POST['user']);
$state->bindValue(':senha',$_POST['pass'],PDO::PARAM_INT);
$state->execute();

		//fim da preparação(codigo acaba acima)
$result = $state->fetch();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<body>

	<div class="container bg-success mt-5">
		<? if($result == true)  {?>

			<div class="py-2 pt-5 text-center">
				<img src="imgs/ok.png" style="border-radius: 100%; width: 150px;height: 150px;border:1px solid white">
				<p class="text-light">Sucesso!</p>
			</div>


			<div class="row d-flex justify-content-center">
				<div class="col-md-5 col-md-offset-1">
					<div class="card-body border-primary-mb3 justify-content-center">
						<a href="index.php"><button type="submit" class="btn btn-light border-white">Voltar</button></a>
					</div>
				</div>
			</div>

			<?}?>
			</div>

			<div class="container bg-danger mt-5">
			<? if($result == false)  {?>
				<div class="py-2 pt-5 text-center">
					<img src="imgs/erro.jpeg" style="border-radius:100%; width: 200px;height: 200px;border:solid white">
					<p class="text-light">Falha no Login!</p>
				</div>


				<div class="row d-flex justify-content-center">
					<div class="col-md-5 col-md-offset-1">
						<div class="card-body border-primary-mb3 justify-content-center ">
							<a href="index.php"><button type="submit" class="btn btn-light border-white">Voltar</button></a>
						</div>
					</div>
				</div>
				<?}?>


			</div>

		</body>
		</html>