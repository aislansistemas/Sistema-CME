<?php
	require_once "../Database/Conexao.php";
	require_once "../Models/Material.php";
	require_once "../Services/MaterialService.php";

	if(isset($_GET['acao']) && $_GET['acao'] == 'criar'){

		if($_POST['descricao'] != null || $_POST['descricao'] != '' &&
			$_POST['id_hospital'] != null){	 
			print_r($_POST);
			$conexao = new Conexao();
			$material = new Material();
			$material->__set('descricao',$_POST['descricao']);
			$material->__set('id_hospital',$_POST['id_hospital']);
			$material_service = new MaterialService($material,$conexao);
			$material_service->cadastraMaterial();
			header('Location: ../materiaisativos.php?criado');
		}else{
			header('Location: ../inserematerial.php?invalido');
		}

	}else if(isset($_GET['acao']) && $_GET['acao'] == 'editarativo'){
			$conexao = new Conexao();
			$material = new Material();
			$material->__set('id',$_POST['id']);
			$material->__set('descricao',$_POST['descricao']);
			$material->__set('id_hospital',$_POST['id_hospital']);
			$material_service = new MaterialService($material,$conexao);
			$material_service->editar();
			header('Location: ../materiaisativos.php?editado');

	}else if(isset($_GET['acao']) && $_GET['acao'] == 'desativar'){
			$conexao = new Conexao();
			$material = new Material();
			$material->__set('id',$_POST['id']);
			$material->__set('id_hospital',$_POST['id_hospital']);
			$material_service = new MaterialService($material,$conexao);
			$material_service->desativar();
			header('Location: ../materiaisinativos.php?desativado');
	
	}else if(isset($_GET['acao']) && $_GET['acao'] == 'ativar'){
			$conexao = new Conexao();
			$material = new Material();
			$material->__set('id',$_POST['id']);
			$material->__set('id_hospital',$_POST['id_hospital']);
			$material_service = new MaterialService($material,$conexao);
			$material_service->ativar();
			header('Location: ../materiaisativos.php?ativado');
	}
?>