<?php
	session_start();
if(isset($_GET['acao_interno'])){
	print_r($_SESSION['materiais_enviados']);
	unset($_SESSION['materiais_enviados'][$_GET['key']]);

	}else if(isset($_GET['acao_externo'])){
		unset($_SESSION['materiais_enviados_externo'][$_GET['key']]);
		
	}else if(isset($_GET['acao_processados'])){
		print_r($_SESSION['materiais_enviados']);
		unset($_SESSION['materiais_enviados'][$_GET['key']]);

	}else if(isset($_GET['acao_saida_interno'])){
		print_r($_SESSION['materiais_saida_enviados']);
		unset($_SESSION['materiais_saida_enviados'][$_GET['key']]);

	}else if(isset($_GET['acao_saida_externo'])){
		print_r($_SESSION['materiais_saida_enviados']);
		unset($_SESSION['materiais_saida_enviados'][$_GET['key']]);

	}else if(isset($_GET['busca'])){
		require_once "Database/Conexao.php";
		require_once "Models/Material.php";
		require_once "Services/MaterialService.php";

		$conexao = new Conexao();
    	$material = new Material();
    	$material->__set('descricao',$_GET['material']);
    	$material->__set('id_hospital',$_GET['id_hospital']);
    	$material_service = new MaterialService($material, $conexao);
    	$retorno=$material_service->buscaMateriasAtivos();

    	/*$estrutura='<ul id="ul">';

    	foreach ($retorno as $key => $dados) {
    	$li=$dados['id'];
    		$estrutura.='<li class="li" id="'.$li.'" onclick="insere('.$dados['id'].')">'.$dados['descricao'].'</li>
    				';
    	}
    	$estrutura.='</ul>';
		*/
    	echo json_encode($retorno);
    	/*
    	$estrutura='<select class="form-control" id="material-id">';
    	foreach ($retorno as $key => $dados) {
    		$estrutura.='<option value="'.$dados['id'].'">'.$dados['descricao'].'</option>
    				';
    	}
    	$estrutura.='</select>';

    	echo $estrutura;*/
	}
?>