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

    <!-- Estilo customizado css -->
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <!-- HTML5Shiv -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <![endif]-->
</head>
<body style="background: rgba(2, 218, 168, 0.9); no-repeat;background-size: 100% 500%">

		<!--= feedback de erro de email não existente no banco de dados=-->
            <?php if(isset($_GET['inexistente'])){ ?>
                  <div class="alert alert-danger alert-dismissible">
                    <button class="close" type="button" data-dismiss="alert">
                    &times;
                    </button>
                    <span class="">Error, E-mail não encontrado!</span>
                  </div>
            <?php } ?>
        <!--= ======-->
		<div class="container">
            <div class="row d-flex justify-content-center mt-5" id="row-login">
                <div class="col-md-5">
                <div style="border-radius:10px;background: rgba(250,250,250,0.9);box-shadow:  5px 10px 20px #888888;" class="mt-5 p-5" id="div-form">
                    <div class="text-center">
                    <img width="180" class="pb-5" src="img/logo.png">
                    </div>
                    <form action="Controllers/RecuperacaoController.php?acao=recuperar" method="POST">
                        
                        <label for="email">Seu E-Mail</label>
                        <input class="form-control input-login mb-2" type="text" name="email" id="email" required="">
                        <input class="form-control inpt-buton links-from btn mb-3 mt-2" type="submit" value="ENVIAR">
                    </form>
                    <small style="font-size: 15px"><a style="text-decoration: none;" class="links-from" href="index.php">Voltar Login</a></small>
                </div> 
                </div>         
            </div>
    </div>

	<!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>