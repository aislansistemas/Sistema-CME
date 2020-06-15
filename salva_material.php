<?php
session_start();

require_once "Database/Conexao.php";
require_once "Models/Material.php";
require_once "Services/MaterialService.php";

if(isset($_POST['id'], $_POST['posicao'], $_POST['local'])){
    
    $materialService = new MaterialService(new Material(), new Conexao());

    $dataArray = [];

    if($_POST['local'] == 'material_interno'){

        foreach ($_POST['id'] as $key => $value) {
        
            // Verificar se existe o material no banco de dados:
            $material = $materialService->getById((int) $value['id']);
            if($material){
                $data['id'] = (int) $value['id'];
                $data['id_recebido_material'] = (int) $value['id_recebido_material'];
                $data['nome'] = $material['descricao'];
    
                array_push($dataArray, $data);
            }
        }

        $_SESSION['materiais_pre_processar'] = $dataArray;
        
        if($_SESSION['materiais_pre_processar'][0]['id'] > 0){
            echo json_encode(['success' => true]);
            exit;

        }else{
            echo json_encode(['success' => false]);
            exit;

        }

    }else if($_POST['local'] == 'cadastrorecebidos_interno'){

        $_SESSION['recebido_interno1_entregue'] = $_POST['entregue'];
        $_SESSION['recebido_interno1_lavado'] = $_POST['lavado'];

        // Verificar se existe o material no banco de dados:
        $material = $materialService->getById((int) $_POST['id']);

        $arrayMaterialExistente = array_filter($_SESSION['materiais_enviados'], function($a) { return ($a['id'] == $_POST['id']); });

        if($arrayMaterialExistente){
            $_SESSION['materiais_enviados'][array_keys($arrayMaterialExistente)[0]]['qtd'] = $_POST['qtd'];

            echo json_encode($_SESSION['materiais_enviados']);
            exit;
        }

        if($material){
            $data['id'] = (int) $_POST['id'];
            $data['qtd'] = (int) $_POST['qtd'];
            $data['nome'] = $material['descricao'];

            array_push($dataArray, $data);
        }

        if($_SESSION['materiais_enviados']){
            array_push($_SESSION['materiais_enviados'], $data);
        }else{
            $_SESSION['materiais_enviados'] = $dataArray;
        }

        echo json_encode($_SESSION['materiais_enviados']);
        exit;

    }else if($_POST['local'] == 'material_processando_interno'){


        foreach ($_POST['id'] as $key => $value) {
      
            // Verificar se existe o material no banco de dados:
            $material = $materialService->getById((int) $value['id']);

            if($material){
                $data['id'] = (int) $value['id'];
                $data['qtd'] = (int) $value['qtd'];
                $data['id_processado_material'] = (int) $value['id_processado_material'];
                $data['nome'] = $material['descricao'];
    
                array_push($dataArray, $data);
            }
        }

        $_SESSION['materiais_saida_enviados'] = $dataArray;

        if($_SESSION['materiais_saida_enviados'][0]['id'] > 0){
            echo json_encode(['success' => true]);
        }else{
            echo json_encode(['success' => false]);
        }
        exit;

    }else if($_POST['local'] == 'cadastro_saida_interno') {
        $_SESSION['materiais_saida_enviados'][$_POST['posicao']]['qtd'] = $_POST['qtd'];

        if($_SESSION['materiais_saida_enviados'][0]['id'] > 0){
            echo json_encode(['success' => true]);
        }else{
            echo json_encode(['success' => false]);
        }
        exit;
    }else {
        $_SESSION['materiais_enviados'][$_POST['posicao']]['qtd'] = $_POST['qtd'];
    }


    if($_SESSION['materiais_enviados'][0]['id'] > 0){
        echo json_encode(['success' => true]);
    }else{
        echo json_encode(['success' => false]);
    }

    
}else{
    echo json_encode(['success' => false]);
}