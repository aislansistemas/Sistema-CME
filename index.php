
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>CME</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- Estilo customizado css -->
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <!-- HTML5Shiv -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <![endif]-->
</head>
<body style="background: rgba(2, 218, 168, 0.9); no-repeat;background-size: 100% 100%">
		<!--= feedback de cadastro feito com sucesso=-->
			<?php if(isset($_GET['criado'])){ ?>
			      <div class="alert alert-primary alert-dismissible">
			        <button class="close" type="button" data-dismiss="alert">
			        &times;
			        </button>
			        <span class="">Cadastro feito com sucesso!</span>
			      </div>
    		<?php } ?>
    	<!--= ======-->
    	<!--= feedback recuperação de senha=-->
			<?php if(isset($_GET['enviado'])){ ?>
			      <div class="alert alert-primary alert-dismissible">
			        <button class="close" type="button" data-dismiss="alert">
			        &times;
			        </button>
			        <span class="">Enviamos sua senha por E-mail!</span>
			      </div>
    		<?php } ?>
    	<!--= ======-->
    	<!--= feedback de email ou senha invalidos=-->
    		<?php if(isset($_GET['invalido'])){ ?>
			      <div class="alert alert-danger alert-dismissible">
			        <button class="close" type="button" data-dismiss="alert">
			        &times;
			        </button>
			        <span class="">E-mail ou senha inválidos!</span>
			      </div>
    		<?php } ?>
		<!--= ======-->
	<div class="container">
			<div  class="row d-flex justify-content-center mt-5" id="row-login">
				<div style="border-radius:10px;background: rgba(250,250,250,0.9);box-shadow:  5px 10px 20px #888888;" class="mt-5 p-5" id="div-form" >
					<div class="text-center">
					<img width="180" class="pb-5" src="img/logo.png">
					</div>
					<form action="Controllers/UsuarioController.php?acao=login" method="POST">
						
						<label for="email">E-mail</label>
						<input class="form-control input-login" type="text" name="email" id="email" required="">
						
						<label for="senha">Senha</label>
						<input class="form-control input-login mb-3" type="password" name="senha" id="senha" required="">

						<small style="font-size: 15px"><a class="links-from" style="text-decoration: none;" href="recupera.php">Esqueceu sua senha?</a></small>
					
						<input type="submit" class="form-control btn input-login inpt-buton mt-3 mb-4" value="ENTRAR">						
					</form>
					<small style="font-size: 15px">Ainda não é cadastrado? <a class="links-from" style="text-decoration: none;" href="cadastro.php">Crie sua conta</a></small>
				</div>			
			</div>
	</div>

	<!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>