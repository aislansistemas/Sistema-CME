<?php
	require_once "../Database/Conexao.php";
	require_once "../Models/Materiais_processados.php";
	require_once "../Models/kit_processado_interno.php";
	require_once "../Models/Kit_processado_externo.php";
	require_once "../Services/MaterialProcessadoService.php";
	require_once "../Services/kit_processado_interno_service.php";
	require_once "../Services/Kit_processado_externo_service.php";

	require_once "../Models/Kit_material_interno.php";
	require_once "../Models/Kit_material_externo.php";
	require_once "../Services/Kit_material_interno_service.php";
	require_once "../Services/Kit_material_externo_service.php";
	
	session_start();

	$conexao = new Conexao();

	if(isset($_GET['acao']) && $_GET['acao'] == 'cadastro_interno'){
	
		$_SESSION['registroProcessadosValores'] = $_POST;
		
		foreach ($_SESSION['materiais_enviados'] as $key => $dados) {
			$kit_recebido = new Kit_Material_interno();
			$kit_recebido->__set('id_hospital',$_SESSION['id_hospital']);
			$kit_recebido->__set('id',$dados['id_recebido_material']);
			$kit_recebido_service = new Kit_mat_inter_service($kit_recebido,$conexao);
			$getMaterialRecbido=$kit_recebido_service->getMaterialInterno();

			if($dados['qtd'] > $getMaterialRecbido[0]['quantidade']){
				$_SESSION['erroProcessadosQtd'] = "O item ". $getMaterialRecbido[0]['descricao'] ." ultrapassou quantidade permitida.";
				header('Location: ../cadastro_proce_interno.php');
				exit;
			}
			if($dados['qtd'] == 0){
				$_SESSION['erroProcessadosQtd'] = "O item ". $getMaterialRecbido[0]['descricao'] ." está zerado.";
				header('Location: ../cadastro_proce_interno.php');
				exit;
			}
		}

		$mat_proce = new MaterialProcessado();
		$mat_proce->__set('id_hospital',$_SESSION['id_hospital']);
		$mat_proce->__set('responsavel_por',$_SESSION['nome']);
		$mat_proce->__set('lote',$_POST['lote']);
		$mat_proce->__set('inicio_ciclo',$_POST['inicio_ciclo']);
		$mat_proce->__set('fim_ciclo',$_POST['fim_ciclo']);
		$mat_proce->__set('numero_do_ciclo',$_POST['numero_do_ciclo']);
		$mat_proce->__set('pressao',$_POST['pressao']);
		$mat_proce->__set('temperatura_interna',$_POST['temperatura_interna']);
		$mat_proce->__set('horario_134',$_POST['horario_134']);
		$mat_proce_service = new MaterialProcessadoService($mat_proce,$conexao);
		$mat_proce_service->registroProcessados();
		$result=$mat_proce_service->obterUltimoCadastro();
		foreach ($_SESSION['materiais_enviados'] as $key => $dados) {
			$kit_proce = new Kit_Processado_Interno();
			$kit_proce->__set('id_processado',$result['id']);
			$kit_proce->__set('id_hospital',$_SESSION['id_hospital']);
			$kit_proce->__set('id_material',$dados['id']);
			$kit_proce->__set('quantidade',$dados['qtd']);
			$kit_proce->__set('status',"processado");
			$kit_proce_service = new Kit_proce_interno_service($kit_proce,$conexao);
			$kit_proce_service->cadastraKitProcessado();

			$kit_recebido_get = new Kit_Material_interno();
			$kit_recebido_get->__set('id_hospital',$_SESSION['id_hospital']);
			$kit_recebido_get->__set('id',$dados['id_recebido_material']);
			$kit_recebido_get_service = new Kit_mat_inter_service($kit_recebido_get,$conexao);
			$getMaterialRecbido=$kit_recebido_get_service->getMaterialInterno();

			if($getMaterialRecbido[0]['id_kit'] == $dados['id_recebido_material']){
				$novoQtd = $getMaterialRecbido[0]['quantidade'] - $dados['qtd'];

				$kit_recebido_alterar = new Kit_Material_interno();
				$kit_recebido_alterar->__set('id_hospital',$_SESSION['id_hospital']);
				$kit_recebido_alterar->__set('id',$dados['id_recebido_material']);
				$kit_recebido_alterar->__set('quantidade',$novoQtd);
				$kit_recebido_alterar->__set('status',($novoQtd == 0 ? 'finalizado' : 'recebido'));
				$kit_recebido_alterar_service = new Kit_mat_inter_service($kit_recebido_alterar,$conexao);
				$kit_recebido_alterar_service->alterarQtdKitInterno();
			}
		}
		unset($_SESSION['materiais_enviados']);
		unset($_SESSION['registroProcessadosValores']);
		unset($_SESSION['erroProcessadosQtd']);
		header('Location: ../processado_interno.php?cadastrado');
	}else if(isset($_GET['acao']) && $_GET['acao'] == 'cadastro_externo'){
		$mat_proce = new MaterialProcessado();
		$mat_proce->__set('id_hospital',$_SESSION['id_hospital']);
		$mat_proce->__set('responsavel_por',$_SESSION['nome']);
		$mat_proce->__set('lote',$_POST['lote']);
		$mat_proce->__set('inicio_ciclo',$_POST['inicio_ciclo']);
		$mat_proce->__set('fim_ciclo',$_POST['fim_ciclo']);
		$mat_proce->__set('numero_do_ciclo',$_POST['numero_do_ciclo']);
		$mat_proce->__set('pressao',$_POST['pressao']);
		$mat_proce->__set('temperatura_interna',$_POST['temperatura_interna']);
		$mat_proce->__set('horario_134',$_POST['horario_134']);
		$mat_proce_service = new MaterialProcessadoService($mat_proce,$conexao);
		$mat_proce_service->registroProcessados();
		$result=$mat_proce_service->obterUltimoCadastro();
		foreach ($_SESSION['materiais_enviados_externo'] as $key => $dados) {
			$kit_proce = new Kit_Processado_externo();
			$kit_proce->__set('id_processado',$result['id']);
			$kit_proce->__set('id_hospital',$_SESSION['id_hospital']);
			$kit_proce->__set('material',$dados['nome']);
			$kit_proce->__set('quantidade',$dados['qtd']);
			$kit_proce->__set('status',"processado");
			$kit_proce_service = new Kit_proce_externo_service($kit_proce,$conexao);
			$kit_proce_service->cadastraKitProcessado();

			//alterando status do materiais recebido externo
			$kit_recebido_alterar = new Kit_Material_externo();
			$kit_recebido_alterar->__set('id_hospital',$_SESSION['id_hospital']);
			$kit_recebido_alterar->__set('id',$dados['id_recebido_material']);
			$kit_recebido_alterar->__set('status', 'finalizado');
			$kit_recebido_alterar_service = new Kit_mat_extern_service($kit_recebido_alterar,$conexao);
			$kit_recebido_alterar_service->alterarQtdKitExterno();
			
		}
		unset($_SESSION['materiais_enviados_externo']);
		header('Location: ../processado_externo.php?cadastrado');
	}
?>