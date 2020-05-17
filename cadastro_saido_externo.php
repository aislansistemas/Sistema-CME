<?php
session_start();
if (!isset($_SESSION) || $_SESSION == null) {
    header('Location: index.php');
}

//unset($_SESSION['materiais_saida_enviados']);


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
   <title>AMD2Saúde</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="icon" type="image/png" href="img/logo-pequena.png"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <!-- Estilo customizado css -->
    <!-- HTML5Shiv -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <![endif]-->
</head>
<body class="background-geral">

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
    <div class="container">
        <h4 class="text-center text-light mt-5 mb-5">
           Saida de Materiais Externos
        </h4>

            <form action="Controllers/SaidaMaterialController.php?saido_externo" method="POST">

                <div class="row mb-4">
                    <div class="col-md-3">                
                        <label class="text-dark">Saída para:</label>
                        <select class="form-control mb-1" name="saida_para" required="">
                          <option>Selecione:</option>
                          <option value="Paciente">Paciente</option>
                          <option value="Empresa">Empresa</option>
                          <option value="Setor">Setor</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="text-dark">NºRegistro</label>
                        <input class="form-control" type="number" name="registro" placeholder="NºRegistro" required="">
                    </div>
                    <div class="col-md-3">
                        <label class="text-dark">Paciente/Empresa/Setor</label>
                        <input class="form-control" type="text" name="paciente_empresa_setor" placeholder="Nome" required="">
                    </div>
                    <div class="col-md-3">
                        <label class="text-dark">Responsavel pela Saída</label>
                        <input class="form-control" type="text" name="responsavel" value="<?= $_SESSION['nome'] ?>" placeholder="Nome" readonly="true">
                    </div>

                </div>
                <!--------------------------->
                        <div style="display: none" class="alert alert-danger alert-dismissible" id="alerta-erro">
                            <button class="close" type="button" data-dismiss="alert">
                             &times;
                            </button>
                            <span class="" id="erro"></span>
                         </div> 
                <!---------------------------------->
 

                <div class="row" id="tabela-materiais-adicionados" <?php if(!isset($_SESSION['materiais_saida_enviados'])){ echo 'style="display: none;"';}?>>
                    <div class="col-md-12">
                        <label>Materiais Adicionados no Recebimento</label>
                        <table class="table table-light" id="tabela-materias">
                            <thead class="text-dark">
                         
                            <tr>
                                <th scope="col">Item</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Ações</th>
                            </tr>
                            </thead>
                            <tbody>

                            
                            <?php if(isset($_SESSION['materiais_saida_enviados']) && count($_SESSION['materiais_saida_enviados']) > 0){ ?>
                            <?php foreach($_SESSION['materiais_saida_enviados'] as $key => $material){ ?>

                                <tr data-id="<?php echo $material['nome']; ?>">
                                    <td class="material-nome"><?php echo $material['nome']; ?></td>
                                    <td class="material-qt"><?php echo $material['qtd']; ?></td>
                                    <td>
                               
                                    <a class="btn btn-danger text-light" onclick="limparSaidaExterno(<?= $key ?>,'<?= $material['nome'] ?>')"><i class="far fa-times-circle"></i></a>
                                    </td>
                                </tr>

                            <?php }?>

                            <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>

                <input class="form-control btn btn-primary input-sumit mt-4 mb-5" type="submit" value="Finalizar Recebimento">

            </form>
    </div>
</section>

<!-- JavaScript (Opcional) -->
<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
<script type="text/javascript" src="js/busca.js"></script>
<script type="text/javascript" src="js/limpa_session.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>


</body>
</html>