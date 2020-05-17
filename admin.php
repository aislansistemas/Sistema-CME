<?php  
    session_start();
    if(!isset($_SESSION) || $_SESSION == null || !isset($_SESSION['email_master']) || $_SESSION['email_master'] != 'm4saude@gmail.com'){
    header('Location: index.php');
    }
       require 'Database/Conexao.php';
       require 'Models/Hospital.php';
       require 'Services/HospitalService.php';

       $conexao= new Conexao();
       $hospital = new Hospital();
       $hop_service = new HospitalService($hospital,$conexao);
       $dados=$hop_service->BuscaHospitais();
?>      
<!DOCTYPE html>
<html>
<head>
	<title>AMD2Saúde</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="icon" type="image/png" href="img/logo-pequena.png"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <!-- Estilo customizado css -->
    <!-- HTML5Shiv -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <![endif]-->
</head>
<body>
	 <header>        
      <nav class="navbar navbar-expand-md navbar-dark background-geral">
        <a class="navbar-brand text-light ml-3"><img class="img-responsive" src="img/logo.png" width="150"></a>
        <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#barranavegacao">
        <span class="navbar-toggler-icon"></span>
        </button>
               
        <div class="collapse navbar-collapse mr-3" id="barranavegacao">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item pr-1">
             <a class="nav-link text-light" href="admin.php">
              <i class="fas fa-hospital"></i> Hospitais</a>
            </li>   
            <li class="nav-item pr-1">
              <div class="dropdown">
              <a style="cursor: pointer;" class="nav-link text-light" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i> <?= $_SESSION['email_master'] ?>
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
  <div class="container mb-5" id="cont">
    <h3 class="text-center text-primary mt-5 mb-4">Hospitais Cadastrados</h3>

    <!--= feedback de hospital desativado=-->
      <?php if(isset($_GET['inativado'])){ ?>
            <div class="alert alert-primary alert-dismissible text-center">
              <button class="close" type="button" data-dismiss="alert">
              &times;
              </button>
              <span class="">Hospital <?= $_GET['hospital'] ?> Desabilitado com sucesso!</span>
            </div>
        <?php } ?>
    <!--= ======-->
    <!--= feedback de cadastro feito com sucesso=-->
      <?php if(isset($_GET['ativado'])){ ?>
            <div class="alert alert-primary alert-dismissible text-center">
              <button class="close" type="button" data-dismiss="alert">
              &times;
              </button>
              <span class="">Hospital <?= $_GET['hospital'] ?> abilitado com sucesso!</span>
            </div>
        <?php } ?>
    <!--= ======-->
    <!--= feedback de cadastro feito com sucesso=-->
      <?php if(isset($_GET['editado'])){ ?>
            <div class="alert alert-primary alert-dismissible text-center">
              <button class="close" type="button" data-dismiss="alert">
              &times;
              </button>
              <span class="">Hospital Atualizado com sucesso!</span>
            </div>
        <?php } ?>
    <!--= ======-->
      <div class="container" style="background: rgba(150,150,150,0.2);border-radius: 8px 8px 0px 0px">
            <div class="row p-1 pt-2">
            <a class="btn btn-primary ml-2 mb-2" style="text-decoration: none;color:white;font-weight: bold;" href="cad_hospital.php">
                <i class="fas fa-plus"></i> NOVO
              </a>
            </div>
      </div>
    <div class="table-responsive">
      <table class="table table-bordered" id="tabela-materias">
        <thead class="head-table text-light">
          <tr>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col">Logo</th>
            <th scope="col">Empresa/Hospital</th>
            <th scope="col">E-mail</th>
            <th scope="col">Senha</th>
            <th scope="col">CNPJ</th>
            <th scope="col">Telefone/Cel</th>
            <th scope="col">Endereço</th>
            <th scope="col">Cidade</th>
            <th scope="col">Estado</th>
          </tr>
        </thead>
        <tbody>

  <?php foreach ($dados as $key => $dado) { ?>         
          <tr>
  <?php if($dado['situacao'] == 'ativo'){ ?>      
            <td><button onclick="desativaHospital(<?= $dado['id'] ?>)" class="btn btn-danger"><i class="far fa-times-circle"></i></button></td>
  <?php }else{ ?>        
            <!--ativar-->
          <td>
           <button onclick="ativaHospital(<?= $dado['id'] ?>)" class="btn btn-success"><i class="far fa-check-square"></i></button>
           </td>
  <?php } ?>
            <td>
              <a href="edit_hospital.php?id=<?= $dado['id'] ?>&logo=upload/<?= $dado['logo'] ?>&nome=<?= $dado['nome'] ?>&email=<?= $dado['email'] ?>&senha=<?= $dado['senha'] ?>&cnpj=<?= $dado['cnpj'] ?>&telefone=<?= $dado['telefone'] ?>&endereco=<?= $dado['endereco'] ?>&cidade=<?= $dado['cidade'] ?>&estado=<?= $dado['estado'] ?>" class="btn btn-primary">
                <i class="far fa-edit"></i>
              </a>
            </td>

            <td><img width="130" height="130" src="upload/<?= $dado['logo'] ?>"></td>
            <td><?= $dado['nome'] ?></td>
            <td><?= $dado['email'] ?></td>
            <td><?= $dado['senha'] ?></td>
            <td><?= $dado['cnpj'] ?></td>
            <td><?= $dado['telefone'] ?></td>
            <td><?= $dado['endereco'] ?></td>
            <td><?= $dado['cidade'] ?></td>
            <td><?= $dado['estado'] ?></td>
          </tr>
   <?php } ?>
           
        </tbody>
      </table>
    </div>
    </div>
</section>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script type="text/javascript" src="js/edit_hospital.js"></script>
    <script type="text/javascript" src="js/hospitais.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>