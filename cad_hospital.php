<?php
  session_start();
    if(!isset($_SESSION) || $_SESSION == null || !isset($_SESSION['email_master']) || $_SESSION['email_master'] != 'm4saude@gmail.com'){
    header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sistema - CME</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
      <div class="container-fluid" id="cont-principal">
        <div class="row" id="row-cad-hospital">
          <div class="col-md-10 bg-light mx-auto mt-4 pt-4">
            <h3 class="text-center pb-2">Cadastro de Hospital</h3>
            <form action="Controllers/HospitalController.php?acao=cadastro" method="POST" enctype="multipart/form-data">
              <label for="logo">Logo</label>
              <input class="form-control" type="file" name="logo" id="logo">
              <label for="nome">Empresa/Hospital</label>
              <input class="form-control" type="text" name="nome" id="nome" required="">
              <label for="email">E-mail</label>
              <input class="form-control" type="text" name="email" id="email" required="">
              <label for="senha">Senha</label>
              <input class="form-control" type="password" name="senha" id="senha" required="">
              <label for="cnpj">CNPJ</label>
              <input class="form-control" type="text" name="cnpj" id="cnpj" required="">
              <label for="telefone">Telefone/Cel</label>
              <input class="form-control" type="text" name="telefone" id="telefone" required="">
              <label for="endereco">Endereço</label>
              <input class="form-control" type="text" name="endereco" id="endereco" required="">
              <label for="cidade">Cidade</label>
              <input class="form-control" type="text" name="cidade" id="cidade" required="">
              <label for="estado">Estado</label>
              <input class="form-control" type="text" name="estado" id="estado" required="">
              <button class="btn btn-primary mt-3 mb-3" name="upload">CADASTRAR</button>
            </form>
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