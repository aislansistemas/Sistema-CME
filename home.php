<?php
  session_start();
  if(!isset($_SESSION) || $_SESSION == null){
    header('Location: index.php');
  }
  require 'Database/Conexao.php';
  require 'Models/Hospital.php';
  require 'Models/Usuario.php';
  require 'Models/Material.php';
  require 'Models/Kit_material_interno.php';
  require 'Models/Kit_material_externo.php';
  require 'Models/kit_processado_interno.php';
  require 'Models/Kit_processado_externo.php';
  require 'Services/HospitalService.php';
  require 'Services/UsuarioService.php';
  require 'Services/MaterialService.php';
  require 'Services/Kit_material_interno_service.php';
  require 'Services/Kit_material_externo_service.php';
  require 'Services/Kit_processado_externo_service.php';
  require 'Services/kit_processado_interno_service.php';

  /////----metodo de busca por hospital---////
  $conexao = new Conexao();
  $hospital = new Hospital();
  $hospital->__set('id',$_SESSION['id_hospital']);
  $hospital_service = new HospitalService($hospital,$conexao);
  $dados=$hospital_service->BuscaHospitaisPorId();
  /////-------///
  $kit_interno = new Kit_Material_interno();
  $kit_interno->__set('id_hospital',$_SESSION['id_hospital']);
  $kit_interno_service = new Kit_mat_inter_service($kit_interno,$conexao);
  $total_recebido_interno=$kit_interno_service->totalMateriaisInternos();
  //////////------//////
  $kit_externo = new Kit_Material_externo();
  $kit_externo->__set('id_hospital',$_SESSION['id_hospital']);
  $kit_externo_service = new Kit_mat_extern_service($kit_externo,$conexao);
  $total_recebido_externo=$kit_externo_service->totalMateriaisExternos();
  /////////------/////
  $usuario = new Usuario();
  $usuario->__set('id_hospital',$_SESSION['id_hospital']);
  $usuario_service = new UsuarioService($usuario,$conexao);
  $total_usuarios = $usuario_service->TotalUsuarios();
  ///////----------//////////
  $mat_proce_interno = new Kit_Processado_Interno();
  $mat_proce_interno->__set('id_hospital',$_SESSION['id_hospital']);
  $mat_proce_interno_service = new Kit_proce_interno_service($mat_proce_interno,$conexao);
  $total_proce_interno = $mat_proce_interno_service->TotalProceInterno();
  ///////----------------///////////
  $mat_proce_externo = new Kit_Processado_externo();
  $mat_proce_externo->__set('id_hospital',$_SESSION['id_hospital']);
  $mat_proce_externo_service = new Kit_proce_externo_service($mat_proce_externo,$conexao);
  $total_proce_externo = $mat_proce_externo_service->TotalProceExterno();
  ////////////-------------//////////
  $material = new Material();
  $material->__set('id_hospital',$_SESSION['id_hospital']);
  $material_service = new MaterialService($material,$conexao);
  $total_ativos = $material_service->totalMateriaisAtivos();
  $total_inativos = $material_service->totalMateriaisInativos();
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
      <div class="container" >

        <div class="row mt-5">
          <div class="col-md-12 cabeçalho-home pt-2 pb-2 pl-5">
            <h4 class="text-light"><i class="fas fa-hospital pr-4"></i>
              <?= $dados['nome'] ?></h4>
          </div>       
        </div>
        <div class="row" id="cont-home">
          <div class="item item1">
            <div class="paragrafo">
              <h4 class="pl-2"><?= $total_recebido_interno['total'] ?></h4>
              <p class="pl-2 pr-2">Total de materiais internos recebidos</p>
              <a style="text-decoration: none" href="material_interno.php">
                <div class="div-visualiza">   
                    Ver <i class="fas fa-arrow-alt-circle-right"></i>   
                </div>
              </a>
            </div>
            <i class="fas fa-recycle text-dark fa-4x ico"></i>
          </div>

          <div class="item item4">
            <div class="paragrafo">
              <h4 class="pl-2"><?= $total_recebido_externo['total'] ?></h4>
              <p class="pl-2 pr-2">Total de materiais Externos recebidos</p>
              <a style="text-decoration: none" href="material_externo.php">
                <div class="div-visualiza">
                   Ver <i class="fas fa-arrow-alt-circle-right"></i>
                </div>
              </a>
            </div>
            <i class="fas fa-recycle text-dark fa-4x ico"></i>
          </div>

          <div class="item item2">
            <div class="paragrafo">
              <h4 class="pl-2"><?= $total_proce_interno['total_proce_interno'] ?></h4>
              <p class="pl-2 pr-2">Total de materiais Processados Internos</p>
              <a style="text-decoration: none" href="processado_interno.php">
              <div class="div-visualiza">
                 Ver <i class="fas fa-arrow-alt-circle-right"></i>
              </div>
               </a>
            </div>
            <i class="fas fa-layer-group text-dark fa-4x ico"></i>
          </div>

          <div class="item item5">
            <div class="paragrafo">
              <h4 class="pl-2"><?= $total_proce_externo['total_proce_externo'] ?></h4>
              <p class="pl-2 pr-2">Total de materiais Processados Externos</p>
              <a style="text-decoration: none" href="processado_externo.php">
                <div class="div-visualiza">
                   Ver <i class="fas fa-arrow-alt-circle-right"></i>
                </div>
              </a>
            </div>
            <i class="fas fa-layer-group text-dark fa-4x ico"></i>
          </div>

          <div class="item item3">
            <div class="paragrafo">
              <h4 class="pl-2"><?= $total_usuarios['total_usuarios'] ?></h4>
              <p class="pl-2 pr-2">Usuarios cadastrados <spam style="color:rgba(231, 30, 49, 0.8);">++++</spam></p>
              <a style="text-decoration: none" href="usuarios.php">
              <div class="div-visualiza">
                 Ver <i class="fas fa-arrow-alt-circle-right"></i>
              </div>
              </a>
            </div>
            <i class="fas fa-user text-dark fa-4x ico"></i>
          </div>

  <!---- exibe se o usuario for admin ---->    
    <?php if($_SESSION['perfil'] == 'admin'){ ?>  
          <div class="item item3">
            <div class="paragrafo">
              <h4 class="pl-2">+</h4>
              <p class="pl-2 pr-2">Cadastrar Novo Usuario <spam style="color:rgba(231, 30, 49, 0.8);">++++</spam></p>
              <a style="text-decoration: none" href="cad_usuario.php">
              <div class="div-visualiza">
                 Novo <i class="fas fa-plus"></i>
              </div>
              </a>
            </div>
            <i class="fas fa-user text-dark fa-4x ico"></i>
          </div>
    <?php } ?>
  <!------- ------------------------->   

          <div class="item item6">
            <div class="paragrafo">
              <h4 class="pl-2"><?= $total_ativos['total'] ?></h4>
              <p class="pl-2 pr-2">Total de materiais Ativos <spam style="color:rgba(231, 30, 49, 0.8);">++++</spam></p>
              <a style="text-decoration: none" href="materiaisativos.php">
                <div class="div-visualiza">
                   Ver <i class="fas fa-arrow-alt-circle-right"></i>
                </div>
              </a>
            </div>
            <i class="fas fa-syringe text-dark fa-4x ico"></i>
          </div>

          <div class="item item7">
            <div class="paragrafo">
              <h4 class="pl-2"><?= $total_inativos['total'] ?></h4>
              <p class="pl-2 pr-2">Total de materiais Inativos <spam style="color:rgba(231, 30, 49, 0.8);">++++</spam></p>
              <a style="text-decoration: none" href="materiaisinativos.php">
                <div class="div-visualiza">
                   Ver <i class="fas fa-arrow-alt-circle-right"></i>
                </div>
              </a>
            </div>
            <i class="fas fa-syringe text-dark fa-4x ico"></i>
          </div>


        </div>

      </div>
    </section>



    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>