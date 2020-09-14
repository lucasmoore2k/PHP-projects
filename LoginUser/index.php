<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<body>

	<div class="container bg-dark mt-5">

		<div class="py-2 pt-5 text-center">
			<img src="imgs/logo.png" style="border-radius: 100%; width: 150px;height: 150px;">
			<h2 class="text-light">Login</h2>
		</div>

		<div class="row d-flex justify-content-center">
			<div class="col-md-5 col-md-offset-1">
				<div class="card-body border-primary-mb3">
					<!--Form-->
				<form action="processo.php" method="post">
					<div class="form-group">
					
						<input type="text" name="user" class="form-control" placeholder="Usuário">
					</div>

					<div class="form-group">
						
						<input type="text" name="pass" class="form-control" placeholder="Senha">
					</div>

					<p class="text-warning">
						<? if(isset($_GET['Erro'])) {
						echo $_GET['Erro'];}
					?></p>

					<button type="submit" class="btn btn-light border-white">Enviar</button>

				</form>
			</div>
			</div>
		</div>
	</div>

</body>
</html>