<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


//Aqui é onde recupero os dados utilizando o metodo desejado(get,post...)

//Vamos abstrair uma mensagem do mundo real
class Mensagem{

	private $email = null;
	private $assunto = null;
	private $mensagem = null;
	public $status = array('codigo_status'=> null, 'descricao_status'=> '');

	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr,$value){
		return $this->$attr=$value;
	}

	public function mensagemValida(){

		if(empty($this->email)||empty($this->assunto) || empty($this->mensagem)){
			return false;
		}
		return true;
	}
}

$mensagem = new Mensagem();

$mensagem->__set('email', $_POST['email']);
$mensagem->__set('assunto', $_POST['assunto']);
$mensagem->__set('mensagem', $_POST['mensagem']);




if(!$mensagem->mensagemValida()){
	header('Location:index.php?errado=Complete todos os campos!');
}



//processamento php mailer

$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = false;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'email';                 // email de acesso a gmail
    $mail->Password = 'pass';                           // password de acesso ao email do gmail
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to
    $mail->SMTPOptions = array(
    	'ssl' => array(
    		'verify_peer' => false,
    		'verify_peer_name' => false,
    		'allow_self_signed' => true
    	)
    );

    //Recipients
    $mail->setFrom('email', 'Email Teste App');
    $mail->addAddress($mensagem->__get('email'));     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $mensagem->__get('assunto');
    $mail->Body    = $mensagem->__get('mensagem');;
    $mail->AltBody = 'É necessario um cliente que renderize HTML';

    $mail->send();

    $mensagem->status['codigo_status'] = 1;
    

}catch (Exception $e){

	$mensagem->status['codigo_status'] = 2;
	$mensagem->status['descricao_status']='Não foi possivel enviar a mensagem!'.$mail->ErrorInfo;
     }


?>


<html>
<head>
	<meta charset="utf-8" />
	<title>App Mail Send</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

	<div class="container">
		<div class="py-3 text-center">
			<img class="d-block mx-auto mb-2" src="logo.png" alt="" width="72" height="72">
			<h2>Send Mail</h2>
			<p class="lead">Seu app de envio de e-mails particular!</p>
		</div>

		<div class="row">
			<div class="col-md-12">

				<? if($mensagem->status['codigo_status'] == 1) { ?>
 
					<div class="container">
						<h1 class="display-4 text-success">Sucesso</h1>
						<p>Email enviado com sucesso!</p>
						<a href="index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>
					</div>

				<? } ?>
				<? if($mensagem->status['codigo_status'] == 2) { ?>

					<div class="container">
						<h1 class="display-4 text-danger">Falha!</h1>
						<p><?=$mensagem->status['descricao_status'] ?></p>
						<a href="index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>
					</div>

				<? } ?>

			</div>
		</div>
	</div>

</body>
</html>
