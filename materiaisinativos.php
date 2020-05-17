<?php
    session_start();
    if(!isset($_SESSION) || $_SESSION == null){
    header('Location: index.php');
    }
    require_once "Database/Conexao.php";
    require_once "Models/Material.php";
    require_once "Services/MaterialService.php";


    if(isset($_GET['pagina'])){
      $pagina=$_GET['pagina'];     
    }else{
      $pagina=0;
    }
    $limit=20;
    $conexao = new Conexao();
    $material = new Material();
    $material->__set('id_hospital',$_SESSION['id_hospital']);
    $material_service = new MaterialService($material,$conexao);
    $lista = $material_service->listarMateriasInativos($pagina,$limit);
    $total=$material_service->totalMateriaisInativos();
    $qtdPag = ceil($total['total']/$limit);
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
        <h4 style="margin-top: 60px" class="text-center mb-4 text-primary">Materiais Inativos</h4>
        <div class="container mb-5" id="cont"> 
            <div class="container" style="background: rgba(150,150,150,0.2);border-radius: 8px 8px 0px 0px">
              <div class="row p-1 pt-2">
              <a class="btn btn-primary ml-2 mb-2" style="text-decoration: none;color:white;font-weight: bold;" href="inserematerial.php">
                  <i class="fas fa-plus"></i> NOVO
                </a>
              </div>
            </div>

           <div class="table-responsive mb-4">
            <table class="table table-light table-striped table-hover text-secondary tabela-materiais table-bordered" id="tabela-materias">
              <thead class="text-light head-table">
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Descrição</th>
                  <th scope="col">Situação</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>

        <?php foreach ($lista as $key => $dado){ ?>
                <tr class="">
                  <td><?= $dado['id'] ?></td>
                  <td><?= $dado['descricao'] ?></td>
                  <td><?= $dado['situacao'] ?></td>
                  <td><button onclick="ativar(<?= $dado['id'] ?>,'<?= $_SESSION['id_hospital'] ?>')" class="btn btn-success"><i class="far fa-check-square"></i></button></td>
                </tr>
        <?php } ?>
              </tbody>
            </table>
             <div class="container p-2 pt-3 pb-2" id="div-table-bottom">
                <!----- links de paginação ------->
                
                <a class="btn btn-secondary btn-sm ml-2" href="materiaisinativos.php?pagina=0">PRIMEIRA</a>
                <?php 
                 if($qtdPag > 1 && $pagina<= $qtdPag){ 
                   for($i=1; $i <= $qtdPag; $i++){ 
                        
                       if($i == $pagina){
                            
                           echo $i;
                       }else{
                 ?>    
                  <a class="btn btn-secondary btn-sm" href="materiaisinativos.php?pagina=<?= $i ?>"> <?= $i ?></a>
              <?php       }
                  }
           
                 } ?>
                <a class="btn btn-secondary btn-sm" href="materiaisinativos.php?pagina=<?= $qtdPag ?>">ÚLTIMA</a> 
              <!------- fim do bloco de paginação -------->
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