<?php
  session_start();
  if(!isset($_SESSION) || $_SESSION == null){
    header('Location: index.php');
  }
  require 'Database/Conexao.php';
  require 'Models/Kit_saido_interno.php';
  require 'Services/Kit_saido_interno_service.php';

  $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
  $limit = 20;
  $conexao = new Conexao();
  $kit_interno = new Kit_saido_interno();
  if(isset($_GET['data_1']) && $_GET['data_1'] != null 
    && isset($_GET['data_2']) && $_GET['data_2'] != null ){
    $data1=$_GET['data_1'];
    $data2=$_GET['data_2'];
    ////
    $kit_interno->__set('id_hospital',$_SESSION['id_hospital']);
    $kit_interno_service = new Kit_saido_interno_service($kit_interno,$conexao);
    $lista=$kit_interno_service->buscaMaterialSaidaInterno($data1,$data2,($pagina - 1)*$pagina,$limit);
    $total=$kit_interno_service->totalMateriaisSaidaInternos();
    $qtdPag = ceil($total['total']/$limit);

    ////
  }else{    
    ///
    $kit_interno->__set('id_hospital',$_SESSION['id_hospital']);
    $kit_interno_service = new Kit_saido_interno_service($kit_interno,$conexao);
    $lista=$kit_interno_service->listaKitSaidaInterno(($pagina - 1)*$pagina,$limit);
    $total=$kit_interno_service->totalMateriaisSaidaInternos();
    $qtdPag = ceil($total['total']/$limit);
    ///
  }
  date_default_timezone_set('America/Sao_Paulo');
  $DtSaida=date('d/m/Y');
  $data_formatada = DateTime::createFromFormat('d/m/Y', $DtSaida);
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
        <h4 style="margin-top: 60px" class="text-center mb-4 text-primary" id="titulo-pagina">Materiais internos liberados do Sistema</h4>
        
        <div class="container mb-5" id="cont"> 
      <!--= feedback de cadastro feito com sucesso=-->
      <?php if(isset($_GET['cadastrado'])){ ?>
            <div class="alert alert-success alert-dismissible text-center">
              <button class="close" type="button" data-dismiss="alert">
              &times;
              </button>
              <span class="">Saída do material feita com sucesso!</span>
            </div>
        <?php } ?>
      <!--= ======-->
      <!--= feedback de cadastro feito com sucesso=-->
      <?php if(isset($_GET['deletado'])){ ?>
            <div class="alert alert-success alert-dismissible text-center">
              <button class="close" type="button" data-dismiss="alert">
              &times;
              </button>
              <span class="">Material deletado com sucesso!</span>
            </div>
        <?php } ?>
      <!--= ======-->
            <div class="container" style="background: rgba(150,150,150,0.2);border-radius: 8px 8px 0px 0px">
              <div class="row p-1 pt-2">
              <div class="col-md-10">
                <form action="saido_interno.php" method="GET">
                  <h5 class="text-primary pb-1">Pesquisar por Data</h5>
                <div class="row">
                  <div class="col-md-4">
                  <label for="data_1">Primeira Data:</label>
                  <input class="form-control mb-2" type="date" name="data_1" id="data_1" value="<?php echo $data_formatada->format('Y-m-d'); ?>">
                  </div>
                  <div class="col-md-4">
                    <label for="data_2">Segunda Data:</label>
                  <div class="input-group">
                     <input class="form-control mb-2" type="date" name="data_2" placeholder="Pesquisar..." id="data_2" value="<?php echo $data_formatada->format('Y-m-d'); ?>">
                   <div class="input-group-prepend" >
                     <button style="border-radius: 0px 5px 5px 0px;" class="btn btn-primary mb-2" type="submit">
                       <i class="fas fa-search"></i>
                     </button>
                   </div>
                  
                  </div> 
                  </div>
                  <div class="col-md-2">
                     <a href="gera_pdf.php?saido_interno" class="btn btn-danger text-light mb-2" style="margin-top: 30px">RELATÓRIO</a> 
                  </div>
                </div>
                </form> 

              </div>
            </div>
            </div>

           <div class="table-responsive">
            <table class="table table-light table-striped table-hover text-secondary tabela-materiais table-bordered" id="tabela-materias">
              <thead class="text-light head-table">
                <tr>
        <?php if($_SESSION['perfil'] == 'admin'){ ?>          
                  <th scope="col">Delete</th>
        <?php } ?>          
                  <th scope="col">Id</th>
                  <th scope="col">Material</th>
                  <th scope="col">Saida para</th>
                  <th scope="col">NºRegistro</th>
                  <th scope="col">Paciente</th>
                  <th scope="col">Reponsável pela saida</th>
                  <th scope="col">Data</th>
                  <th scope="col">Hora</th>
                </tr>
              </thead>
              <tbody>

        <?php foreach ($lista as $key => $dados){?>
                <tr class="">
          <?php if($_SESSION['perfil'] == 'admin'){ ?> 
                    <td>
                      <button onclick="deletaSaidointerno(<?= $dados['id_mat'] ?>,<?= $_SESSION['id_hospital'] ?>,<?= $dados['id_kit_processado'] ?>,<?= $dados['id_material'] ?>)" class="btn btn-danger">
                      <i class="far fa-times-circle"></i>
                      </button>
                    </td>
           <?php } ?> 

                    <td><?= $dados['id_material'] ?></td>  
                    <td><?= $dados['descricao'] ?></td>     
                    <td><?= $dados['saida_para'] ?></td>  
                    <td><?= $dados['registro'] ?></td>  
                    <td><?= $dados['paciente_empresa_setor'] ?></td>
                    <td><?= $dados['responsavel'] ?></td>  
                    <td><?= $dados['data_saido'] ?></td>
                    <td><?= $dados['hora'] ?></td>
                </tr>
        <?php } ?> 
              </tbody>
            </table>
            <div class="container p-2 pt-3 pb-2" id="div-table-bottom">
              <!----- links de paginação ------->
            <?php
                  if ($qtdPag > 1 && $pagina <= $qtdPag) {
                      for ($i = 1; $i <= $qtdPag; $i++) {

                        if ($i == $pagina) {

                             echo $i;
                        } else {
                        ?>
                         <a class="btn btn-outline-secondary btn-sm" href="saido_interno.php?pagina=<?= $i ?>"> <?= $i ?></a>
           <?php       }
                            }
                    } ?> 
              <!------- fim do bloco de paginação -------->
             </div>
           </div>

        </div>
    </section>


    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script type="text/javascript" src="js/deletar_material.js"></script>
    <script type="text/javascript" src="js/deletar_material.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>