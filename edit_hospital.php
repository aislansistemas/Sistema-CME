<?php  
    session_start();
    if(!isset($_SESSION) || $_SESSION == null || !isset($_SESSION['email_master']) || $_SESSION['email_master'] != 'm4saude@gmail.com' || !isset($_GET) || $_GET == null){
    header('Location: index.php');
    }
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
<body style="background: rgba(0, 216, 169, 1);">
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
    <div class="container mb-5" id="container-form">
       <div class="row mb-5" id="row-cad-hospital">
          <div class="col-md-10 bg-light mx-auto mt-4 pt-4">
            <h3 class="text-center pb-5">Atualizar Dados</h3>
        <form action="Controllers/HospitalController.php?acao=editar" method="POST" enctype="multipart/form-data">

          <input type="hidden" name="id" value="<?= $_GET['id'] ?>">

        <div class="row">
          <div class="col-md-6">
              <label for="logo">Logo (*Opcional)</label>
              <input class="form-control" type="file" name="logo" id="logo">
          </div>
          <div class="col-md-6">
              <label for="nome">Empresa/Hospital</label>
              <input class="form-control" type="text" name="nome" id="nome" value="<?= $_GET['nome'] ?>" required="">
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
              <label for="email">E-mail</label>
              <input class="form-control" type="text" name="email" id="email" value="<?= $_GET['email'] ?>" required="">
          </div>
          <div class="col-md-6">
              <label for="senha">Senha</label>
              <input class="form-control" type="text" name="senha" id="senha" required="" value="<?= $_GET['senha'] ?>">
          </div>
        </div>


          <div class="row">  
            <div class="col-md-3">
              <label for="cnpj">CNPJ</label>
              <input class="form-control cnpj" type="text" name="cnpj" id="cnpj" required="" data-mask="00.000.000/0000-00" value="<?= $_GET['cnpj'] ?>">
            </div>
            <div class="col-md-3">
              <label for="telefone">Telefone/Cel</label>
              <input class="form-control" type="text" name="telefone" id="telefone" required="" data-mask="(99)99999-9999" value="<?= $_GET['telefone'] ?>">
            </div>
            <div class="col-md-6">
              <label for="endereco">Endereço</label>
              <input class="form-control" type="text" name="endereco" id="endereco" value="<?= $_GET['endereco'] ?>" required="">
            </div>
          </div>
          

          <div class="row">  
            <div class="col-md-6">
              <label for="cidade">Cidade</label>
              <input class="form-control" type="text" name="cidade" id="cidade" value="<?= $_GET['cidade'] ?>" required="">
            </div>
            <div class="col-md-6">
              <label for="estado">Estado</label>
              <select class="form-control" type="text" name="estado" id="estado" required="" >
                <option value="<?= $_GET['estado'] ?>"><?= $_GET['estado'] ?></option>
                <option value="Acre">Acre</option>
                  <option value="Alagoas">Alagoas</option>
                  <option value="Amapá">Amapá</option>
                  <option value="Amazonas">Amazonas</option>
                  <option value="Bahia">Bahia</option>
                  <option value="Ceará">Ceará</option>
                  <option value="Distrito Federal">Distrito Federal</option>
                  <option value="Espírito Santo">Espírito Santo</option>
                  <option value="Goiás">Goiás</option>
                  <option value="Maranhão">Maranhão</option>
                  <option value="Mato Grosso">Mato Grosso</option>
                  <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                  <option value="Minas Gerais">Minas Gerais</option>
                  <option value="Pará">Pará</option>
                  <option value="Paraíba">Paraíba</option>
                  <option value="Paraná">Paraná</option>
                  <option value="Pernambuco">Pernambuco</option>
                  <option value="Piauí">Piauí</option>
                  <option value="Rio de Janeiro">Rio de Janeiro</option>
                  <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                  <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                  <option value="Rondônia">Rondônia</option>
                  <option value="Santa Catarina">Santa Catarina</option>
                  <option value="São Paulo">São Paulo</option>
                  <option value="Sergipe">Sergipe</option>
                  <option value="Tocantins">Tocantins</option>
              </select>
            </div>
          </div>
              <button class="btn btn-primary mt-3 mb-4" name="upload">ATUALIZAR</button>
            </form>
          </div>
        </div>
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