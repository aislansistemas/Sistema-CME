<?php
	
	require_once "../Database/Conexao.php";
	require_once "../Models/Saida_material.php";
	require_once "../Models/Kit_saido_interno.php";
	require_once "../Models/Kit_saido_externo.php";
	require_once "../Services/Saida_material_service.php";
	require_once "../Services/Kit_saido_interno_service.php";
	require_once "../Services/Kit_saido_externo_service.php";

	require_once "../Models/kit_processado_interno.php";
	require_once "../Models/Kit_processado_externo.php";
	require_once "../Services/kit_processado_interno_service.php";
	require_once "../Services/Kit_processado_externo_service.php";

	session_start();

	$conexao = new Conexao();

	if(isset($_GET['saido_interno'])){

		$_SESSION['registroSaidaValores'] = $_POST;
		
		foreach ($_SESSION['materiais_saida_enviados'] as $key => $dados) {
			$kit_proce = new Kit_Processado_Interno();
			$kit_proce->__set('id_processado_material',$dados['id_processado_material']);
			$kit_proce->__set('id_hospital',$_SESSION['id_hospital']);
			$kit_proce_service = new Kit_proce_interno_service($kit_proce,$conexao);
			$getMaterialProcesado=$kit_proce_service->getKitProcessandoInterno();

	

			if($dados['qtd'] > $getMaterialProcesado[0]['quantidade']){
				$_SESSION['erroSaidaQtd'] = "O item ". $getMaterialRecbido[0]['descricao'] ." ultrapassou quantidade permitida.";
				header('Location: ../cadastro_saido_interno.php');
				exit;
			}
			if($dados['qtd'] == 0){
				$_SESSION['erroSaidaQtd'] = "O item ". $getMaterialRecbido[0]['descricao'] ." está zerado.";
				header('Location: ../cadastro_saido_interno.php');
				exit;
			}
		}

		$mat_saida = new Saida_material();
		$mat_saida->__set('id_hospital',$_SESSION['id_hospital']);
		$mat_saida->__set('saida_para',$_POST['saida_para']);
		$mat_saida->__set('registro',$_POST['registro']);
		$mat_saida->__set('paciente_empresa_setor',$_POST['paciente_empresa_setor']);
		$mat_saida->__set('responsavel',$_POST['responsavel']);
		$mat_saida_service = new Saida_material_service($mat_saida,$conexao);
		$mat_saida_service->registroSaida();
		$result=$mat_saida_service->obterUltimoCadastro();
		foreach ($_SESSION['materiais_saida_enviados'] as $key => $dados) {
			$kit_saida = new Kit_saido_interno();
			$kit_saida->__set('id_saida',$result['id']);
			$kit_saida->__set('id_hospital',$_SESSION['id_hospital']);
			$kit_saida->__set('id_material',$dados['id']);
			$kit_saida->__set('quantidade',$dados['qtd']);
			$kit_saida_service = new Kit_saido_interno_service($kit_saida,$conexao);
			$kit_saida_service->salvaKitSaidaInterno();

			$kit_proce = new Kit_Processado_Interno();
			$kit_proce->__set('id_processado_material',$dados['id_processado_material']);
			$kit_proce->__set('id_hospital',$_SESSION['id_hospital']);
			$kit_proce_service = new Kit_proce_interno_service($kit_proce,$conexao);
			$getMaterialProcesado=$kit_proce_service->getKitProcessandoInterno();

			if($getMaterialProcesado[0]['id_processando_material'] == $dados['id_processado_material']){
				$novoQtd = $getMaterialProcesado[0]['quantidade'] - $dados['qtd'];

				
				$kit_proce = new Kit_Processado_Interno();
				$kit_proce->__set('id_processado_material',$dados['id_processado_material']);
				$kit_proce->__set('id_hospital',$_SESSION['id_hospital']);
				$kit_proce->__set('quantidade',$novoQtd);
				$kit_proce->__set('status',($novoQtd == 0 ? 'finalizado' : 'processado'));
				$kit_proce_service = new Kit_proce_interno_service($kit_proce,$conexao);
				$kit_proce_service->alterarKitProcessadoStatus();
			}
		}
		unset($_SESSION['registroSaidaValores']);
		unset($_SESSION['materiais_saida_enviados']);
		header('Location: ../saido_interno.php?cadastrado');
	}else if(isset($_GET['saido_externo'])){

		//var_dump($_POST);exit;
		$conexao = new Conexao();
		$mat_saida = new Saida_material();
		$mat_saida->__set('id_hospital',$_SESSION['id_hospital']);
		$mat_saida->__set('saida_para',$_POST['saida_para']);
		$mat_saida->__set('registro',$_POST['registro']);
		$mat_saida->__set('paciente_empresa_setor',$_POST['paciente_empresa_setor']);
		$mat_saida->__set('responsavel',$_POST['responsavel']);
		$mat_saida_service = new Saida_material_service($mat_saida,$conexao);
		$mat_saida_service->registroSaida();
		$result=$mat_saida_service->obterUltimoCadastro();
		foreach ($_SESSION['materiais_saida_enviados'] as $key => $dados) {
			$kit_saida = new Kit_saido_externo();
			$kit_saida->__set('id_saida',$result['id']);
			$kit_saida->__set('id_hospital',$_SESSION['id_hospital']);
			$kit_saida->__set('material',$dados['nome']);
			$kit_saida->__set('quantidade',$dados['qtd']);
			$kit_saida_service = new Kit_saido_externo_service($kit_saida,$conexao);
			$kit_saida_service->salvaKitSaidaExterno();

			$kit_proce = new Kit_Processado_externo();
			$kit_proce->__set('id_processado_material',$dados['id_processado_material']);
			$kit_proce->__set('status',"finalizado");
			$kit_proce_service = new Kit_proce_externo_service($kit_proce,$conexao);
			$kit_proce_service->alterarKitProcessadoStatus();
		}
		unset($_SESSION['materiais_saida_enviados']);
		header('Location: ../saido_externo.php?cadastrado');
	}
	
?>