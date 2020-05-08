<?php
	//Controller de recuperação de senha pelo gmail utlizando o phpmailer
	require "../bibliotecas/PHPMailer/Exception.php";
	require "../bibliotecas/PHPMailer/OAuth.php";
	require "../bibliotecas/PHPMailer/PHPMailer.php";
	require "../bibliotecas/PHPMailer/POP3.php";
	require "../bibliotecas/PHPMailer/SMTP.php";
	require_once "../Models/Mensagem_RecuperacaoModel.php";
	require_once "../Database/Conexao.php";
	require_once "../Models/Usuario.php";
	require_once "../Services/UsuarioService.php";

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	if(isset($_GET['acao']) && $_GET['acao'] == 'recuperar'){

		$conexao=new Conexao();
		$usuario=new Usuario();
		$usuario->__set('email',$_POST['email']);
		$usuario_service=new UsuarioService($usuario,$conexao);
		$result=$usuario_service->buscarEmailUsuario();

		$mail = new PHPMailer(true);
		$mensagem = new Mensagem();

	if($_POST['email'] == $result['email']){
		$mensagem->__set('para', $result['email']);
		$mensagem->__set('assunto', utf8_decode('Recuperação de senha'));
		$mensagem->__set('mensagem', 'Sua senha: '.$result['senha']);

		try{ 
		    //Server settings
		    $mail->SMTPDebug = false;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'm4saude@gmail.com';                 // SMTP username
		    $mail->Password = 'P@cs2020';                           // SMTP password
		    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 587;                                    // TCP port to connect to

		    //Recipients
		    $mail->setFrom('m4saude@gmail.com', 'CME');
		    $mail->addAddress($mensagem->__get('para'));     // Add a recipient
		    //$mail->addReplyTo('info@example.com', 'Information');
		    //$mail->addCC('cc@example.com');
		    //$mail->addBCC('bcc@example.com');

		    //Attachments
		    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = $mensagem->__get('assunto');
		    $mail->Body    = $mensagem->__get('mensagem');
		    $mail->AltBody = 'É necessário utilizar um client que suporte HTML para ter acesso total ao conteúdo dessa mensagem';

		    $mail->send();

		    $mensagem->status['codigo_status'] = 1;
		    $mensagem->status['descricao_status'] = 'E-mail enviado com sucesso';
		    header('Location: ../index.php?enviado');
		
		} catch (Exception $e) {
			header('Location: ../recupera.php?inexistente');
			$mensagem->status['codigo_status'] = 2;
		    $mensagem->status['descricao_status'] = 'Não foi possível enviar este e-mail! Por favor tente novamente mais tarde. Detalhes do erro: ' . $mail->ErrorInfo;
		    
		    //alguma lógica que armazene o erro para posterior análise por parte do programador
		}

	}else{
		header('Location: ../recupera.php?inexistente');
	}
	}else if(isset($_GET['acao']) && $_GET['acao'] == 'contato'){

		$mail = new PHPMailer(true);
		$mensagem = new Mensagem();
		if($_POST['nome'] != null && $_POST['email'] != null && $_POST['menssagem'] != null){
			print_r($_POST);
			$mensagem->__set('para', 'm4saude@gmail.com');
			$mensagem->__set('assunto', utf8_decode('Contato de Usuario'));
			$mensagem->__set('mensagem', 'Usuario: '.$_POST['nome'].', Email: '.utf8_decode($_POST['email']).'assunto: '.utf8_decode($_POST['menssagem']));
		try{ 
		    //Server settings
		    $mail->SMTPDebug = false;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'm4saude@gmail.com';                 // SMTP username
		    $mail->Password = 'P@cs2020';                           // SMTP password
		    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 587;                                    // TCP port to connect to

		    //Recipients
		    $mail->setFrom('m4saude@gmail.com', 'CME');
		    $mail->addAddress($mensagem->__get('para'));     // Add a recipient
		    //$mail->addReplyTo('info@example.com', 'Information');
		    //$mail->addCC('cc@example.com');
		    //$mail->addBCC('bcc@example.com');

		    //Attachments
		    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = $mensagem->__get('assunto');
		    $mail->Body    = $mensagem->__get('mensagem');
		    $mail->AltBody = 'É necessário utilizar um client que suporte HTML para ter acesso total ao conteúdo dessa mensagem';

		    $mail->send();

		    $mensagem->status['codigo_status'] = 1;
		    $mensagem->status['descricao_status'] = 'E-mail enviado com sucesso';
		    header('Location: ../contato.php?enviado');
		
		} catch (Exception $e) {
			header('Location: ../recupera.php?inexistente');
			$mensagem->status['codigo_status'] = 2;
		    $mensagem->status['descricao_status'] = 'Não foi possível enviar este e-mail! Por favor tente novamente mais tarde. Detalhes do erro: ' . $mail->ErrorInfo;
		    
		    //alguma lógica que armazene o erro para posterior análise por parte do programador
		}
		}else{
			header('Location: ../contato.php?invalido');
		}
	}

?>