<?php

	require_once "../Database/Conexao.php";
	require_once "../Models/Hospital.php";
	require_once "../Models/Usuario.php";
	require_once "../Services/HospitalService.php";
	require_once "../Services/UsuarioService.php";

	$conexao = new Conexao();

	if(isset($_GET['acao']) && $_GET['acao'] == 'cadastro'){
		if(isset($_POST['nome']) && isset($_POST['email']) &&
			isset($_POST['senha']) && isset($_POST['cnpj']) && isset($_POST['telefone']) && isset($_POST['cidade'])){
		
		if(ISSET($_POST['upload'])){
		$file_name = $_FILES['logo']['name'];
		$file_temp = $_FILES['logo']['tmp_name'];
		$allowed_ext = array("jpg", "jpeg", "gif", "png");
		$exp = explode(".", $file_name);
		$ext = end($exp);
		$path = "../upload/".$file_name;

		if(in_array($ext, $allowed_ext)){
			if(move_uploaded_file($file_temp, $path)){

				$hospital = new Hospital();
				$hospital = new Hospital();
				$hospital->__set('logo',$file_name);
				$hospital->__set('logo_caminho',$path);
				$hospital->__set('nome',$_POST['nome']);
				$hospital->__set('email',$_POST['email']);
				$hospital->__set('senha',$_POST['senha']);
				$hospital->__set('cnpj',$_POST['cnpj']);
				$hospital->__set('telefone',$_POST['telefone']);
				$hospital->__set('endereco',$_POST['endereco']);
				$hospital->__set('cidade',$_POST['cidade']);
				$hospital->__set('estado',$_POST['estado']);
				$hospital_service = new HospitalService($hospital,$conexao);
				$hospital_service->CadastraHospital();
				$lastId=$hospital_service->GetLastID();

				$usuario = new Usuario();
				$usuario->__set('id_hospital',$lastId['id']);
				$usuario->__set('nome',$_POST['nome']);
				$usuario->__set('email',$_POST['email']);
				$usuario->__set('senha',$_POST['senha']);
				$usuario->__set('perfil',"admin");
				$usuario_service = new UsuarioService($usuario,$conexao);
				$usuario_service->CadastrarUsuarioAdmin();
				echo $lastId['id'];
				header('location: ../admin.php?criado');
			}
			}
		}
		}
	}else if(isset($_GET['acao']) && $_GET['acao'] == 'desativar'){

		$hospital = new Hospital();
		$hospital->__set('id',$_POST['id']);
		$hospital_service = new HospitalService($hospital,$conexao);
		$hospital_service->InativaHospital();
		$hospitalID = $hospital_service->BuscaHospitaisPorId();
		///
		$usuario = new Usuario();
		$usuario->__set('id_hospital',$_POST['id']);
		$usuario_service = new UsuarioService($usuario,$conexao);
		$usuario_service->inativaMuitos();
		///
		header('Location: ../admin.php?inativado&&hospital='.$hospitalID['nome']);
	}else if(isset($_GET['acao']) && $_GET['acao'] == 'ativar'){

		$hospital = new Hospital();
		$hospital->__set('id',$_POST['id']);
		$hospital_service = new HospitalService($hospital,$conexao);
		$hospital_service->ativaHospital();
		$hospitalID = $hospital_service->BuscaHospitaisPorId();
		////
		$usuario = new Usuario();
		$usuario->__set('id_hospital',$_POST['id']);
		$usuario_service = new UsuarioService($usuario,$conexao);
		$usuario_service->ativaMuitos();
		////
		header('Location: ../admin.php?ativado&&hospital='.$hospitalID['nome']);
	}
	
?>