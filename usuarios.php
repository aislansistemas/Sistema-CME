<?php
  session_start();
  if(!isset($_SESSION) || $_SESSION == null){
    header('Location: index.php');
    }

  require_once "Database/Conexao.php";
  require_once "Models/Usuario.php";
  require_once "Services/UsuarioService.php";

  $conexao = new Conexao();
  $usuario = new Usuario();
  $usuario->__set('id_hospital',$_SESSION['id_hospital']);
  $usuario_service = new UsuarioService($usuario,$conexao);
  $lista=$usuario_service->listarUsuarios();

?>
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
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Estilo customizado css -->
    <!-- HTML5Shiv -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <![endif]-->
</head>
<body>

    <header>        
      <nav class="navbar navbar-expand-md navbar-dark background-geral">
        <a class="navbar-brand text-light ml-3" href="home.php"><img class="img-responsive" src="img/logo.png" width="150"></a>
        <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#barranavegacao">
        <span class="navbar-toggler-icon"></span>
        </button>
               
        <div class="collapse navbar-collapse mr-3" id="barranavegacao">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item pr-1">
             <a class="nav-link text-light" href="home.php">
              <i class="fas fa-hospital"></i> Home</a>
            </li>

            <li class="nav-item pr-1">
             <div class="dropdown">
              <a style="cursor: pointer;" class="nav-link text-light" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <i class="fas fa-recycle mr-1"></i>Recebimento
              </a>
             <div class="dropdown-menu bg-light" aria-labelledby="dropdownMenuButton">
              <a  class="dropdown-item text-primary" href="material_interno.php">Materiais Internos
              </a>
              <a class="dropdown-item text-primary" href="material_externo.php">Materiais Externos</a>
              </div>
            </li>

            <li class="nav-item pr-1">
             <div class="dropdown">
              <a style="cursor: pointer;" class="nav-link text-light" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <i class="fas fa-layer-group"></i></i>
              Processamento
              </a>
             <div class="dropdown-menu bg-light" aria-labelledby="dropdownMenuButton">
              <a  class="dropdown-item text-primary" href="processado_interno.php">Processados Internos
              </a>
              <a class="dropdown-item text-primary" href="processado_externo.php">Processados Externos</a>
              </div>
            </li>

            <li class="nav-item pr-1">
             <div class="dropdown">
              <a style="cursor: pointer;" class="nav-link text-light" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <i class="fas fa-sign-out-alt"></i></i>
              Saída/materiais
              </a>
             <div class="dropdown-menu bg-light" aria-labelledby="dropdownMenuButton">
              <a  class="dropdown-item text-primary" href="saido_interno.php">Materiais Internos
              </a>
              <a class="dropdown-item text-primary" href="saido_externo.php">Materiais Externos</a>
              </div>
            </li>

            <li class="nav-item pr-1">
             <div class="dropdown">
              <a style="cursor: pointer;" class="nav-link text-light" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-syringe mr-1"></i>Materiais
              </a>
             <div class="dropdown-menu bg-light" aria-labelledby="dropdownMenuButton">
            <a  class="dropdown-item text-primary" href="materiaisativos.php">Materiais ativos
            </a>
            <a class="dropdown-item text-primary" href="materiaisinativos.php">Materiais inativos</a>
              </div>
            </li>

            <li class="nav-item pr-1">
             <a class="nav-link text-light" href="contato.php">
              <i class="fas fa-at"></i> Contato</a>
            </li>
  
            <li class="nav-item pr-1">
              <div class="dropdown">
              <a style="cursor: pointer;" class="nav-link text-light" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i> <?= ucfirst($_SESSION['nome']) ?>
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

    <section>
       <h3 class="text-center text-primary mt-5 mb-5">Usuarios cadastrados</h3>
        <div class="container mb-5" id="cont"> 
         <!--= feedback de cadastro feito com sucesso=-->
      <?php if(isset($_GET['cadastrado'])){ ?>
            <div class="alert alert-primary alert-dismissible">
              <button class="close" type="button" data-dismiss="alert">
              &times;
              </button>
              <span class="">Usuario Cadastrado com sucesso!</span>
            </div>
      <?php } ?>
      <!--= ======-->  
          <div class="container top-table">

        <?php if($_SESSION['perfil'] == 'admin'){ ?>
              <a class="btn btn-primary" href="cad_usuario.php"><i class="fas fa-user"></i> Novo Usuario</a>
        <?php } ?>

            </div>
           <div class="table-responsive" id="cont">
            <table class="table table-light table-striped table-hover text-secondary tabela-materiais table-bordered" id="tabela-materias">
              <thead class="text-light head-table">
                <tr>
                  <th scope="col">Nome do Usuario</th>
                  <th scope="col">E-mail</th>
                  <th scope="col">Situação</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
        <?php foreach ($lista as $key => $dados){ ?>
                <tr class="">
                  <td scope="col"><?= ucfirst($dados['nome']) ?></td>
                  <td scope="col"><?= $dados['email'] ?></td> 
                  <td scope="col"><?= ucfirst($dados['situacao']) ?></td> 

                  <td scope="col">
          <?php if($_SESSION['perfil'] == 'admin'){ ?>          

          <?php if($dados['situacao'] == 'ativo'){ ?>  
                    <!--desativar-->
                    <button onclick="desativaUsuario(<?= $dados['id'] ?>,'<?= $_SESSION['id_hospital'] ?>')" class="btn btn-danger"><i class="far fa-times-circle"></i></button>
          <?php }else{ ?>         
                    <!--ativar-->
                    <button onclick="ativaUsuario(<?= $dados['id'] ?>,'<?= $_SESSION['id_hospital'] ?>')" class="btn btn-success"><i class="far fa-check-square"></i></button>
          <?php } } ?>            
                  </td>
                  
                </tr>
        <?php } ?>
              </tbody>
            </table>
            <div class="container" id="bottom-table">
            </div>
          </div>
          </div>
    </section>




    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script type="text/javascript" src="js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>