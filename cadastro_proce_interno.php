<?php
  session_start();
  if(!isset($_SESSION) || $_SESSION == null){
    header('Location: index.php');
  }
  //print_r($_SESSION);
    require_once "Database/Conexao.php";
    require_once "Models/Material.php";
    require_once "Services/MaterialService.php";

    $conexao = new Conexao();
    $material = new Material();
    $material->__set('id_hospital',$_SESSION['id_hospital']);
    $material_service = new MaterialService($material,$conexao);
    $lista = $material_service->selecionaMateriasAtivos();
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
        <h4 class="text-center text-light mt-5">
            Registro de Materiais Processados Internos
          </h4>
          <?php if(isset($_SESSION['erroProcessadosQtd'])){ ?>
            <div class="alert alert-success alert-dismissible">
              <button class="close" type="button" data-dismiss="alert">
              &times;
              </button>
              <span class=""><?php echo $_SESSION['erroProcessadosQtd'] ?></span>
            </div>
          <?php } ?>
          <form action="Controllers/MaterialProcessadoController.php?acao=cadastro_interno" method="POST">
            <div class="row pt-5 mb-2">
              <input type="hidden" name="id_hospital" value="<?= $_SESSION['id_hospital'] ?>">
              
              <div class="col-md-4">
                <label >Lote</label>
                <input class="form-control" type="text" name="lote" value="<?php if(isset($_SESSION['registroProcessadosValores']['lote'])){ ?> <?= $_SESSION['registroProcessadosValores']['lote'] ?><?php } ?>"  required="" placeholder="Nº Seq.Automático">
              </div>
              <div class="col-md-4">
                <label>Início do ciclo</label>
                <input class="form-control" type="time" name="inicio_ciclo" value="<?= $_SESSION['registroProcessadosValores']['inicio_ciclo'] ?>" required="">
              </div>
              <div class="col-md-4">
                <label>Fim do ciclo</label>
                <input class="form-control" type="time" name="fim_ciclo" value="<?= $_SESSION['registroProcessadosValores']['fim_ciclo'] ?>" required="">
              </div>
              </div>
            <div class="row mb-4">
              <div class="col-md-3">
                <label>NºCiclo</label>
                <input class="form-control" type="number" name="numero_do_ciclo" value="<?= $_SESSION['registroProcessadosValores']['numero_do_ciclo'] ?>" required="" placeholder="55">
              </div>
              <div class="col-md-2">
                <label>Pressão</label>
                <input class="form-control" type="text" name="pressao" value="<?php if(isset($_SESSION['registroProcessadosValores']['pressao'])){ ?> <?= $_SESSION['registroProcessadosValores']['pressao'] ?> <?php } ?>" required="" placeholder="2,5">
              </div>

              <div class="col-md-3">
                <label>Temp.Interna</label>
                <input class="form-control" type="text" name="temperatura_interna" value="<?php if(isset($_SESSION['registroProcessadosValores']['temperatura_interna'])){ ?> <?= $_SESSION['registroProcessadosValores']['temperatura_interna'] ?> <?php } ?>" required="" placeholder="134">
              </div>
              <div class="col-md-4">
                <label>Horário que atingiu os 134º</label>
                <input class="form-control" type="time" name="horario_134" value="<?= $_SESSION['registroProcessadosValores']['horario_134'] ?>" required="">
              </div>
            </div>
                <div class="row" id="tabela-materiais-adicionados" <?php if(!isset($_SESSION['materiais_enviados'])){ echo 'style="display: none;"';}?>>
                    <div class="col-md-12">
                        <label>Materiais Adicionados no Processamento</label>
                        <table class="table table-light" id="tabela-materias">
                            <thead class="text-dark">
                            <tr>
                                <th scope="col">Item</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Ações</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if(isset($_SESSION['materiais_enviados']) && count($_SESSION['materiais_enviados']) > 0){ ?>

                            <?php foreach($_SESSION['materiais_enviados'] as $key =>$material){ ?>

                                <tr data-id="<?php echo $material['id']; ?>">
                                    <td class="material-nome"><?php echo $material['nome']; ?></td>
                                    <td class="material-qt"><input class="form-control qtd-material" id="qtd-material-<?php echo $material['id']; ?>" onKeyup="changeQtdMeterial(<?php echo $material['id']; ?>,<?php echo $key; ?>)" style="width: 200px" type="text" required="" value="<?php echo $material['qtd']; ?>" placeholder="Informe quantidade"></td>
                                    <td>
                                        <a class="btn btn-danger text-light" onclick="limparProcessados(<?= $key ?>, <?= $material['id'] ?>,'<?= $material['nome'] ?>',<?= $material['qtd'] ?>)"><i class="far fa-times-circle"></i></a>
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

<script>
function changeQtdMeterial(mterialId, posicao){

  var qtdMeterial = document.getElementById("qtd-material-"+mterialId).value;

   // Chamada em ajax pra enviar os dados e salvar na sessão:
  $.ajax({
    url: 'salva_material.php',
    method: 'POST',
    async: false,
    data: {
        id: mterialId,
        qtd: qtdMeterial,
        posicao: posicao,
        local: 'cadastro_proce_interno'
    },
    dataType: 'json',
    success: function(response){
    }
  });

}
</script>
</body>
</html>