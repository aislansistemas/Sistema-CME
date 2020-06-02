<?php
    session_start();
    if(!isset($_SESSION) || $_SESSION == null){
    header('Location: index.php');
    }
    
    require_once "Database/Conexao.php";
    require_once "Models/Kit_material_interno.php";
    require_once "Services/Kit_material_interno_service.php";

    if(isset($_GET['pagina'])){
      $pagina=$_GET['pagina'];     
    }else{
      $pagina=0;
    }
    $limit=20;
    $conexao = new Conexao();
    $kit_interno = new Kit_Material_interno();
    if(isset($_GET['busca'], $_GET['tipobusca']) && $_GET['busca'] != null && $_GET['tipobusca'] != "0"){
      $material=$_GET['busca'];
      $tipobusca=$_GET['tipobusca'];

      $kit_interno->__set('id_hospital',$_SESSION['id_hospital']);
      $kit_interno_service = new Kit_mat_inter_service($kit_interno,$conexao);
      $lista=$kit_interno_service->buscaMaterialInterno($material,$tipobusca,$pagina,$limit);
      $total=$kit_interno_service->totalMateriaisInternos();
      $qtdPag = ceil($total['total']/$limit);
      ////
    }else{    
      ///
      $kit_interno->__set('id_hospital',$_SESSION['id_hospital']);
      $kit_interno_service = new Kit_mat_inter_service($kit_interno,$conexao);
      $lista=$kit_interno_service->listaKitInterno($pagina,$limit);
      $total=$kit_interno_service->totalMateriaisInternos();
      $qtdPag = ceil($total['total']/$limit);
      ///
    }

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
        <h4 style="margin-top: 60px" class="text-center mb-4 text-primary" id="titulo-pagina">Materiais Internos recebidos e lavados</h4>
      
        <div id="msg-error"></div>
      <!--= ======-->
        <div class="container mb-5" id="cont"> 
           <!--= feedback de cadastro feito com sucesso=-->
      <?php if(isset($_GET['cadastrado'])){ ?>
            <div class="alert alert-success alert-dismissible text-center">
              <button class="close" type="button" data-dismiss="alert">
              &times;
              </button>
              <span class="">Materiais registrados com sucesso!</span>
            </div>
        <?php } ?>
        <?php if(isset($_GET['tipobusca']) && $_GET['tipobusca'] == "0"){ ?>
            <div class="alert alert-danger alert-dismissible text-center">
              <button class="close" type="button" data-dismiss="alert">
              &times;
              </button>
              <span class="">Selecione um método de busca!</span>
            </div>
        <?php } ?>
         <?php if(isset($_GET['deletado'])){ ?>
            <div class="alert alert-success alert-dismissible text-center">
              <button class="close" type="button" data-dismiss="alert">
              &times;
              </button>
              <span class="">Material deletado com sucesso!</span>
            </div>
        <?php } ?>


            <div class="container" style="background: rgba(150,150,150,0.2);border-radius: 8px 8px 0px 0px">
              <div class="row p-1 pt-2">
              <div class="col-md-6">
                <a class="btn btn-primary mb-3 mr-3" onclick="limpar_recebido_geral()" style="text-decoration: none;color:white;font-weight: bold;" href="cadastrorecebidos_interno.php">
                    <i class="fas fa-plus"></i> NOVO
                </a>
                <button class="btn btn-success mb-3" id="add-button-proce"><i class="fas fa-layer-group"></i> PROCESSAR</button>
                <a href="gera_pdf.php?receb_interno" class="btn btn-danger ml-3 mb-3 text-light">RELATÓRIO</a>
              </div>
              <div class="col-md-6">
                <form action="material_interno.php" method="GET">
                  <div class="form-row">
                    <div class="input-group col-md-6">
                      <select name="tipobusca" class="form-control mb-2" id="FormControlSelectTypeSearch">
                        <option value="0" hidden>Selecione método busca</option>
                        <option value="m.descricao">Material</option>
                        <option value="mr.quem_entregou">Quem entregou</option>
                        <option value="mr.quem_recebeu">Quem recebeu</option>
                        <option value="mr.quem_lavou">Quem lavou</option>
                      </select>
                    </div>
                    <div class="input-group col-md-6">
                      <input class="form-control" type="text" name="busca" placeholder="Pesquisar...">
                    <div class="input-group-prepend">
                      <button style="border-radius: 0px 5px 5px 0px" class="btn btn-primary mb-2" type="submit">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                    </div>
                  </div>
                </form> 

              </div>
            </div>
            </div>

           <div class="table-responsive">
            <table class="table table-light table-striped text-secondary tabela-materiais  table-bordered" id="tabela-materias">
              <thead class="text-light head-table">
                <tr>
                  <th scope="col">Ação</th>

        <?php if($_SESSION['perfil'] == 'admin'){ ?>
                  <th scope="col">Deletar</th>
        <?php } ?>

                  <th scope="col">Id</th>                  
                  <th scope="col">Material</th>
                  <th scope="col">Entregue por</th>
                  <th scope="col">Recebido por</th>
                  <th scope="col">Lavado por</th>
                  <th scope="col">Data</th>
                  <th scope="col">Hora</th>  
                </tr>
              </thead>
              <tbody>
          <?php foreach ($lista as $key => $dados){  ?>
                <tr> 
       <?php if($dados['status'] == 'recebido'){  ?>
                  <td><input class="form-control" type="checkbox" value="<?= $dados['id_material'] ?>, <?= $dados['id_kit'] ?>" class="form-check-input" name="check-material-id"></td>
      <?php }else{ ?>
          <td></td>
      <?php } ?>

      <?php if($_SESSION['perfil'] == 'admin'){ ?>
                  <td>
                    <button onclick="deletaInterno(<?= $dados['id_kit'] ?>,<?= $_SESSION['id_hospital'] ?>,<?= $dados['id_material'] ?>,<?= $dados['id_recebido'] ?>)" class="btn btn-danger">
                      <i class="far fa-times-circle"></i>
                    </button>
                  </td>
      <?php } ?>

                  <td><?= $dados['id_material'] ?></td>
                  <td><?= $dados['descricao'] ?></td> 
                  <td><?= $dados['quem_entregou'] ?></td>
                  <td><?= $dados['quem_recebeu'] ?></td>
                  <td><?= $dados['quem_lavou'] ?></td>
                  <td><?= $dados['data_recebido'] ?></td> 
                  <td><?= $dados['hora'] ?></td>     
                </tr>
          <?php } ?>
              </tbody>
            </table>
            <div class="container p-2 pt-3 pb-2" id="div-table-bottom">
              <!----- links de paginação ------->
            <a class="btn btn-secondary btn-sm ml-2" href="material_interno.php?pagina=0">PRIMEIRA</a>
            <?php 
               if($qtdPag > 1 && $pagina<= $qtdPag){ 
                for($i=1; $i <= $qtdPag; $i++){ 
              
                if($i == $pagina){
                  
                 echo $i;
                }else{
             ?>    
               <a class="btn btn-secondary btn-sm" href="material_interno.php?pagina=<?= $i ?>"> <?= $i ?></a>
              <?php       }
              }
 
              } ?>
              <a class="btn btn-secondary btn-sm" href="material_interno.php?pagina=<?= $qtdPag ?>">ÚLTIMA</a> 
              <!------- fim do bloco de paginação -------->
             </div>
           </div>

        </div>
    </section>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script type="text/javascript" src="js/limpa_session.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <script>

    $(document).ready(function(){
        $('#add-button-proce').click(function(e){
          e.preventDefault();

          var materialIdId = document.getElementsByName("check-material-id");


          var materialArray = [];
          
          if(materialIdId[0].checked == false){
              var showError = document.getElementById("show-error");

              var msgError = '';
              if(Boolean(showError) == false){
                msgError += '<div class="alert alert-danger alert-dismissible" id="show-error">'
                msgError += '<button class="close" type="button" data-dismiss="alert">'
                msgError += ' &times;'
                msgError += '</button>'
                msgError += '<span class="">Para processar e necessário selecionar um material!</span>'
                msgError += '</div>'

                $('#msg-error').append(msgError);
              } 

            }

          for (var i=0;i<materialIdId.length;i++){ 
            if (materialIdId[i].checked == true){ 
              var meteriais = materialIdId[i].value.split(",");
              
              materialArray.push({"id": meteriais[0], "id_recebido_material": meteriais[1]});

            }
          }
          // Chamada em ajax pra enviar os dados e salvar na sessão:
          $.ajax({
                url: 'salva_material.php',
                method: 'POST',
                async: false,
                data: {
                    id: materialArray,
                    local: 'material_interno',
                    posicao: 'null'
                },
                dataType: 'json',
                success: function(response){
                  if(response.success === true){
                    limpar_pre_processar_geral()
                    window.location.href = "cadastro_proce_interno.php"
                    return;
                  }else{
                    var showError = document.getElementById("show-error");

                    var msgError = '';
                    if(Boolean(showError) == false){
                      msgError += '<div class="alert alert-danger alert-dismissible" id="show-error">'
                      msgError += '<button class="close" type="button" data-dismiss="alert">'
                      msgError += ' &times;'
                      msgError += '</button>'
                      msgError += '<span class="">Ocorreu algum erro, tente novamente!</span>'
                      msgError += '</div>'

                      $('#msg-error').append(msgError);
                    } 
                  }
                }
            });
        });
    });

  </script>
  
</body>
</html>