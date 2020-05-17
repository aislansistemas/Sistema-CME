<?php
session_start();
if (!isset($_SESSION) || $_SESSION == null) {
    header('Location: index.php');
}
require_once "Database/Conexao.php";
require_once "Models/Material.php";
require_once "Services/MaterialService.php";

//unset($_SESSION['materiais_enviados']);

//var_dump($_SESSION);
//
//exit;

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
            Registro Interno de Materiais Recebidos
        </h4>

            <form action="Controllers/MaterialRecebidoController.php?acao=cadastrar_interno" method="POST">

                <div class="row mb-4">
                    <div class="col-md-4">                
                        <label class="text-dark">Entregue por:</label>
                        <input class="form-control mb-1" type="text" name="quem_entregou" required=""
                               placeholder="Nome">
                    </div>
                    <div class="col-md-4">
                        <label class="text-dark">Recebido por:</label>
                        <input class="form-control" type="text" name="quem_recebeu" placeholder="Nome" value="<?= $_SESSION['nome'] ?>" readonly="">
                    </div>
                    <div class="col-md-4">
                        <label class="text-dark">Lavado por:</label>
                        <input class="form-control" type="text" name="quem_lavou" placeholder="Nome">
                    </div>

                </div>
                <div class="row mb-2">
            
                    <div class="col-md-6">
                        <label class="text-dark">Material</label>
                        <input type="hidden" name="material-id" id="material-id" value="">
                        <input type="hidden" name="id_hospital" id="id_hospital" value="<?= $_SESSION['id_hospital'] ?>">
                        <div class="input-group">
                            <input autocomplete="off"  class="form-control" type="text" name="material" id="pesse" placeholder="material...">
                            <div class="input-group-prepend">
                                <button class="btn btn-primary input-sumit" type="button" id="add-button">Adicionar</button>
                            </div>
                            <input type="hidden" name="quantidade" value="1" id="material-qtd">
                        </div>
                            <div id="recebe" class="bg-light">

                            </div>  
 
                    </div>
                </div>

                <div class="row" id="tabela-materiais-adicionados" <?php if(!isset($_SESSION['materiais_enviados'])){ echo 'style="display: none;"';}?>>
                    <div class="col-md-12">
                        <label>Materiais Adicionados no Recebimento</label>
                        <table class="table table-light" id="tabela-materias">
                            <thead class="text-dark">
                         
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Item</th>
                                <th scope="col">Ações</th>
                            </tr>
                            </thead>
                            <tbody>

                            
                            <?php if(isset($_SESSION['materiais_enviados']) && count($_SESSION['materiais_enviados']) > 0){ ?>
                            <?php foreach($_SESSION['materiais_enviados'] as $key => $material){ ?>
                                <tr data-id="<?php echo $material['id']; ?>">
                                    <td class="material-id"><?php echo $material['id']; ?></td>
                                    <td class="material-nome"><?php echo $material['nome']; ?></td>
                                    <td>
                                    <a class="btn btn-danger text-light" onclick="limpar(<?= $key ?>,<?= $material['id'] ?>)"><i class="far fa-times-circle"></i></a>
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

<script>

function inserirLiInput(id){
    var material = document.getElementById("material_"+id);

    var inputPesse = document.getElementById("pesse");
    inputPesse.value = '';
    inputPesse.value = material.children[0].text;

    var inputMaterialId = document.getElementById("material-id");
    inputMaterialId.value = '';
    inputMaterialId.value = material.children[0].dataset.id;

    var recebe = document.getElementById("recebe");
    recebe.style.display = "none";

}

document.documentElement.onclick = function(event){

    var recebe = document.getElementById("recebe");
    recebe.style.display = "none";
}



    $(document).ready(function(){

        ///----------------------------------------///
            //*busca por evento de teclado
               $('#pesse').keyup((e) => {  
                    e.preventDefault()
                    
                   
                    var materialnome = $('#pesse').val();
                    var id_hospital = $('#id_hospital').val();
                    var recebe = document.getElementById("recebe");
                    recebe.style.display = "block";

                if(materialnome.length > 3){ 
                    //console.log(dadoform.buscar)         
                    //ajax
                    $.ajax({
                        method: 'GET',
                        url: 'teste.php?busca',
                        async: false,
                        data: {
                            material: materialnome,
                            id_hospital: id_hospital
                        }, //x-www-form-urlencoded
                        dataType: 'json',
                        success: dados => {
                            var lista = '';
                            $.each(dados, function (index, data){
                                lista += '<ul onclick="inserirLiInput(' + data.id + ')" id="material_' + data.id + '">';
                                lista += '<a data-id="' + data.id + '" >Id: '+data.id+' - '+data.descricao+'</a>'
                                lista += '</ul>';
                                //lista += '<hr />'

                            });

                            $("#recebe").html(lista);
                            /*console.log(dados) 
                            var lista = '';
                            lista += '<ul data-id="' + dados.id + '">';
                            lista += '<li class="material-nome">' + dados.descricao + '</li>';
                            lista += '</ul>';*/

                        // Adicionar a linha no grid:
                        //$('#recebe').append(lista);
                        },
                        error: erro => { console.log(erro) }
                    })
                }
            })

        ///-------------------------------------////

        $('#add-button').click(function(e){
            e.preventDefault();

            var materialId = $('#material-id').val();
            var materialQtd = $('#material-qtd').val();
            // Chamada em ajax pra enviar os dados e salvar na sessão:

            $.ajax({
                url: 'salva_material.php',
                method: 'POST',
                async: false,
                data: {
                    id: materialId,
                    qtd: materialQtd,
                    local: 'cadastrorecebidos_interno',
                    posicao: 'null'
                },
                dataType: 'json',
                success: function(response){

                    var linha = '';

                    $('#tabela-materias tbody tr').remove();

                    $.each(response, function (index, dataMaterial){

                        linha += '<tr data-id="' + dataMaterial.id + '">';
                        linha += '<td>'+dataMaterial.id+'</td>';
                        linha += '<td class="material-nome">' + dataMaterial.nome + '</td>';
                //        linha += '<td class="material-qt">' + dataMaterial.qtd + '</td>';
                        linha += '<td><a class="btn btn-danger text-light" onclick="limpar('+index+','+dataMaterial.id+')"><i class="far fa-times-circle"></i></a></td>';
                        linha += '</tr>';

                    });

                    // Adicionar a linha no grid:

                    $('#tabela-materias tbody').append(linha);
                
                    $('#tabela-materiais-adicionados').show();

                    // Reset inputs:

                    $('#pesse').val('');
                    $('#material-id').val(0);
                    //$('#material-qtd').val('');
                }

            });
            //
            
            ///
        });
    });

</script>

</body>
</html>