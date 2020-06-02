<?php
	require_once "../Database/Conexao.php";
	require_once "../Models/Usuario.php";
	require_once "../Services/UsuarioService.php";
	session_start();

	if(isset($_GET['acao']) && $_GET['acao'] == 'login'){
		
		////
			if($_POST['email'] != null && $_POST['senha'] != null){
				
			    $conexao=new Conexao();
				$usuario=new Usuario();
				$usuario->__set('email',$_POST['email']);
				$usuario->__set('senha',$_POST['senha']);
				$usuario_service=new UsuarioService($usuario,$conexao);
				$retorno=$usuario_service->Login();	
				//print_r($retorno);
				//echo count($retorno);

				$emMaster="m4saude@gmail.com";
				$seMaster="P@cs2020";
				if($_POST['email'] == $emMaster && $_POST['senha'] == $seMaster){
					$_SESSION['email_master']=$emMaster;
					header('Location: ../admin.php');
				}else{
					
					if(count($retorno) == 1 && count($retorno) > 0){
						//print_r($retorno[0]);
						$_SESSION['id_usuario'] = $retorno[0]['id'];
						$_SESSION['nome'] = $retorno[0]['nome'];
						$_SESSION['email'] = $retorno[0]['email'];
						$_SESSION['id_hospital'] = $retorno[0]['id_hospital'];
						$_SESSION['perfil'] = $retorno[0]['perfil'];
						print_r($_SESSION);
						header('Location: ../home.php');
					}else if(count($retorno) >= 2 && count($retorno) > 0){
						$_SESSION['email'] = $retorno[0]['email'];
						$_SESSION['senha'] = $retorno[0]['senha'];
						
						header('Location: ../select_hospital.php');
					}else if(count($retorno) == 0){
						header('Location: ../index.php?invalido');
					}

				}

			}

	}else if(isset($_GET['acao']) && $_GET['acao'] == 'registrar'){
		if(isset($_POST) && $_POST != null){
			$conexao = new Conexao();
			$usuario = new Usuario();	
			$usuario->__set('nome',$_POST['nome']);
			$usuario->__set('email',$_POST['email']);
			$usuario->__set('senha',$_POST['senha']);
			$usuario->__set('id_hospital',$_POST['hospital']);
			$usuario_service = new UsuarioService($usuario,$conexao);
			$dados=$usuario_service->BuscaEmailIdHospital();
			print_r($dados);
			if($dados['email'] != $_POST['email'] && $dados['id_hospital'] != $_POST['hospital']){				

				$usuario_service->cadastrarUsuario();
				header('Location: ../index.php?criado');
			}else{
				header('Location: ../cadastro.php?existente');
			}

		}else{
			header('Location: ../cadastro.php?erro');
		}
	}else if(isset($_GET['acao']) && $_GET['acao'] == 'sair'){
		session_destroy();
		header('Location: ../index.php');
	}else if(isset($_GET['acao']) && $_GET['acao'] == 'desativaUsuario'){
		$conexao = new Conexao();
		$usuario = new Usuario();
		$usuario->__set('id',$_POST['id']);
		$usuario->__set('id_hospital',$_POST['id_hospital']);
		$usuario_service = new UsuarioService($usuario,$conexao);
		$usuario_service->desativaUsuario();
		header('Location: ../usuarios.php?desativado');
	}else if(isset($_GET['acao']) && $_GET['acao'] == 'ativaUsuario'){
		$conexao = new Conexao();
		$usuario = new Usuario();
		$usuario->__set('id',$_POST['id']);
		$usuario->__set('id_hospital',$_POST['id_hospital']);
		$usuario_service = new UsuarioService($usuario,$conexao);
		$usuario_service->ativaUsuario();
		header('Location: ../usuarios.php?ativado');
	}else if(isset($_GET['acao']) && $_GET['acao'] == 'cadastroAdmin'){
		$conexao = new Conexao();
		$usuario = new Usuario();
		$usuario->__set('id_hospital',$_SESSION['id_hospital']);
		$usuario->__set('nome',$_POST['nome']);
		$usuario->__set('email',$_POST['email']);
		$usuario->__set('senha',$_POST['senha']);
		$usuario->__set('perfil',$_POST['perfil']);
		$usuario_service = new UsuarioService($usuario,$conexao);
		$dados=$usuario_service->buscarEmailUsuario();

		if($dados['email'] != $_POST['email']){						
			$usuario_service->CadastrarUsuarioAdmin();
			header('Location: ../usuarios.php?cadastrado');
		}else{
			header('Location: ../cad_usuario.php?existente');
		}
		
	}else if(isset($_GET['acao']) && $_GET['acao'] == 'editarPerfil'){
		echo $_SESSION['id_hospital'];
		print_r($_POST);
		$conexao = new Conexao();
		$usuario = new Usuario();
		$usuario->__set('id_hospital',$_SESSION['id_hospital']);
		$usuario->__set('perfil',$_POST['perfil']);
		$usuario->__set('id',$_POST['id']);
		$usuario_service = new UsuarioService($usuario,$conexao);
		$dados=$usuario_service->EditaPerfilUsuario();
		header('Location: ../usuarios.php?editado&nome='.$_POST['nome']);
	}else if(isset($_GET['acao']) && $_GET['acao'] == 'escolheHospital'){
		//print_r($_GET);
		$conexao = new Conexao();
		$usuario = new Usuario();
		$usuario->__set('id_hospital',$_GET['id_hospital']);
		$usuario->__set('email',$_GET['email']);
		$usuario->__set('senha',$_GET['senha']);
		$usuario_service = new UsuarioService($usuario,$conexao);
		$dados = $usuario_service->BuscaUsuarioPorEmailSenhaIdHospital();
		$_SESSION['id_usuario'] = $dados['id'];
		$_SESSION['nome'] = $dados['nome'];
		$_SESSION['email'] = $dados['email'];
		$_SESSION['id_hospital'] = $dados['id_hospital'];
		$_SESSION['perfil'] = $dados['perfil'];
		header('Location: ../home.php');

	}

?>