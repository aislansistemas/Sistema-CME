<?php
    session_start();

	require_once "../Database/Conexao.php";
	require_once "../Models/Materiais_recebidos.php";
	require_once "../Models/Kit_material_interno.php";
	require_once "../Models/Kit_material_externo.php";
	require_once "../Services/MaterialRecebidoService.php";
	require_once "../Services/Kit_material_interno_service.php";
	require_once "../Services/Kit_material_externo_service.php";

	if(isset($_GET['acao']) && $_GET['acao'] == 'cadastrar_interno'){
	    // Receber os dados:
	    //print_r($_SESSION);
		//print_r($_POST);
		$conexao = new Conexao();
		$mat_recebido = new MaterialRecebido();
		$mat_recebido->__set('id_hospital',$_SESSION['id_hospital']);
		$mat_recebido->__set('quem_entregou',$_POST['quem_entregou']);
		$mat_recebido->__set('quem_recebeu',$_POST['quem_recebeu']);
		$mat_recebido->__set('quem_lavou',$_POST['quem_lavou']);
		//$mat_recebido->__set('data',$_POST['data']);
		$mat_service = new MaterialRecebidoService($mat_recebido,$conexao);
		$mat_service->cadastroMaterialRecebido();
		$recebido=$mat_service->obterUltimoCadastro();

		foreach ($_SESSION['materiais_enviados'] as $key => $dados) {

		//	print_r($dados);
			$kit_interno= new Kit_Material_interno();
			$kit_interno->__set('id_recebido',$recebido['id']);
			$kit_interno->__set('id_hospital',$_SESSION['id_hospital']);
			$kit_interno->__set('id_material',$dados['id']);
			$kit_interno->__set('quantidade',$dados['qtd']);
			$kit_interno_service = new Kit_mat_inter_service($kit_interno,$conexao);
			$kit_interno_service->salvaKitInterno();
		}
		unset($_SESSION['materiais_enviados']);
		header('Location: ../material_interno.php?cadastrado');
		
//////
	}else if(isset($_GET['acao']) && $_GET['acao'] == 'cadastrar_externo'){

		$conexao = new Conexao();
		$mat_recebido = new MaterialRecebido();
		$mat_recebido->__set('id_hospital',$_SESSION['id_hospital']);
		$mat_recebido->__set('quem_entregou',$_POST['quem_entregou']);
		$mat_recebido->__set('quem_recebeu',$_POST['quem_recebeu']);
		$mat_recebido->__set('quem_lavou',$_POST['quem_lavou']);
		//$mat_recebido->__set('data',$_POST['data']);
		$mat_service = new MaterialRecebidoService($mat_recebido,$conexao);
		$mat_service->cadastroMaterialRecebido();
		$recebido=$mat_service->obterUltimoCadastro();

		foreach ($_SESSION['materiais_enviados_externo'] as $key => $dados) {

		//	print_r($dados);
			$kit_externo= new Kit_Material_externo();
			$kit_externo->__set('id_recebido',$recebido['id']);
			$kit_externo->__set('id_hospital',$_SESSION['id_hospital']);
			$kit_externo->__set('material',$dados['nome']);
			$kit_externo->__set('quantidade',$dados['qtd']);
			$kit_externo_service = new Kit_mat_extern_service($kit_externo,$conexao);
			$kit_externo_service->salvaKitExterno();
		}
		unset($_SESSION['materiais_enviados_externo']);
		header('Location: ../material_externo.php?cadastrado');

	}
?>