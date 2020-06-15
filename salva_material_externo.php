<?php
session_start();

if(isset($_POST['material'], $_POST['local'])){

    $dataArray = [];

    if($_POST['local'] == 'material_externo'){

        foreach ($_POST['material'] as $key => $value) {

            $data['qtd'] = (int) $value['qtd'];
            $data['nome'] = $value['nome'];
            $data['id_recebido_material'] = $value['id_recebido_material'];
            

            array_push($dataArray, $data);
        }

        $_SESSION['materiais_pre_processar_externo'] = $dataArray;


        if($_SESSION['materiais_pre_processar_externo'][0]['nome']){
            echo json_encode(['success' => true]);
            exit;

        }else{
            echo json_encode(['success' => false]);
            exit;

        }

    }else if($_POST['local'] == 'cadastrorecebidos_externo'){

        $data['nome'] = $_POST['material'];
        $data['qtd'] = $_POST['qtd'];
        $_SESSION['recebido_externo_1_entregue'] = $_POST['entregue'];
        $_SESSION['recebido_externo_1_lavado'] = $_POST['lavado'];

        array_push($dataArray, $data);

        if($_SESSION['materiais_enviados_externo']){
            array_push($_SESSION['materiais_enviados_externo'], $data);
        }else{
            $_SESSION['materiais_enviados_externo'] = $dataArray;
        }

        echo json_encode($_SESSION['materiais_enviados_externo']);
        exit;

    }else if($_POST['local'] == 'material_processando_externo'){

        foreach ($_POST['material'] as $key => $value) {

            $data['qtd'] = (int) $value['qtd'];
            $data['id_processado_material'] = (int) $value['id_processado_material'];
            $data['nome'] = $value['nome'];

            array_push($dataArray, $data);
            
        }

        $_SESSION['materiais_saida_enviados'] = $dataArray;

        if($_SESSION['materiais_saida_enviados'][0]['nome']){
            echo json_encode(['success' => true]);
        }else{
            echo json_encode(['success' => false]);
        }
        exit;

    }

    if($_SESSION['materiais_enviados_externo'][0]['nome']){
        echo json_encode(['success' => true]);
    }else{
        echo json_encode(['success' => false]);
    }

}else{
    echo json_encode(['success' => false]);
}

?>