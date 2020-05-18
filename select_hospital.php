<?php
	session_start();
	//print_r($_SESSION);
  	if(!isset($_SESSION) || $_SESSION == null){
  		 header('Location: index.php');
  	}
	require_once "Database/Conexao.php";
	require_once "Models/Usuario.php";
	require_once "Services/UsuarioService.php";

	$conexao = new Conexao();
	$usuario = new Usuario();
	$usuario->__set('email',$_SESSION['email']);
	$usuario->__set('senha',$_SESSION['senha']);
	$usuario_service = new UsuarioService($usuario,$conexao);
	$lista = $usuario_service->ListaHospitaisPorUsuario();
	//print_r($lista);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>AMD2Saúde</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="icon" type="image/png" href="img/logo-pequena.png"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- Estilo customizado css -->
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <!-- HTML5Shiv -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <![endif]-->
</head>
<body style="background: rgba(2, 218, 168, 0.9); no-repeat;background-size: 100% 100%">

	<header>        
      <nav class="navbar navbar-expand-md navbar-dark background-geral">
	        <a class="navbar-brand text-light ml-5" href="home.php"><img class="img-responsive" src="img/logo.png" width="180"></a>
	        <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#barranavegacao">
	        <span class="navbar-toggler-icon"></span>
	        </button>     
        <div class="collapse navbar-collapse mr-3" id="barranavegacao">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <div class="dropdown">
              <a style="cursor: pointer;" class="nav-link text-light" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i> <?= ucfirst($_SESSION['email']) ?>
              </a>
              <div class="dropdown-menu bg-light" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item text-primary" href="Controllers/UsuarioController.php?acao=sair"> <i class="fas fa-arrow-right"></i> Sair
              </a>
              </div>
            </li>
          </ul>
        </div>
        </div>      
      </nav>
      </div>
    </header>
		
	<div class="container">
		<div class="row mt-5">
			</div>
			<div  class="row d-flex justify-content-center mt-2" id="row-login">
			<h2 class="text-center h2-selecioneHospital text-primary">Selecione um Hospital para fazer login</h2>

			<div class="" id="div-form" >
				<div></div>
				<div id="cont-flex-lista-hospitais">

		<?php foreach ($lista as $key => $dados) { ?>
				
				<div class="divs-hospitais">
				<a href="Controllers/UsuarioController.php?acao=escolheHospital&id_hospital=<?= $dados['id_hospital'] ?>&email=<?= $_SESSION['email'] ?>&senha=<?= $_SESSION['senha'] ?>">
					<div class="row">
						<img width="180" height="180" src="upload/<?= $dados['logo'] ?>">
					</div>	
					<h3 class="text-center mt-4 text-secondary"><?= ucfirst($dados['nome']) ?></h3>
				</a>
				</div>

		<?php } ?>

				</div>

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