<?php
	session_start();
    require_once __DIR__ . '/vendor/autoload.php';
	require_once "bibliotecas/fpdf.php";
	require_once "Database/Conexao.php";
	require_once "Models/Kit_processado_externo.php";
	require_once "Models/Hospital.php";
	require_once "Services/HospitalService.php";
    require_once "Services/Kit_processado_externo_service.php";
    require_once "Models/Kit_material_interno.php";
    require_once "Services/Kit_material_interno_service.php";
    require_once "Models/Kit_material_externo.php";
    require_once "Services/Kit_material_externo_service.php";
    require_once 'Models/Kit_saido_interno.php';
    require_once 'Services/Kit_saido_interno_service.php';
    require_once 'Models/Kit_saido_externo.php';
    require_once 'Services/Kit_saido_externo_service.php';
    require_once "Models/kit_processado_interno.php";
    require_once "Services/kit_processado_interno_service.php";

    $pagina=0;
    $limit=20;
    date_default_timezone_set('America/Sao_Paulo');
    $conexao = new Conexao();
    ////
    $hospital = new Hospital();
    $hospital->__set('id',$_SESSION['id_hospital']);
    $hospital_service = new HospitalService($hospital,$conexao);
    $dados=$hospital_service->BuscaHospitaisPorId();
    ////
if(isset($_GET['proce_externo'])){

	$kit_extn_proce = new Kit_Processado_externo();
	$kit_extn_proce->__set('id_hospital',$_SESSION['id_hospital']);
	$kit_extn_service = new Kit_proce_externo_service($kit_extn_proce,$conexao);
	$lista=$kit_extn_service->listaKitProcessandoExterno($pagina,$limit);
	

$html = "
<style>
	h1{
		color: rgba(0, 216, 169, 1);
		text-align:center;	
		font-family: trebuchet ms, helvetic,sans-serif;
	}
    table, th, td {
        border: 1px solid #E8E8E8;
        border-collapse: collapse;
        padding: 5px;
        border-radius:10px !important;
       	font-family: trebuchet ms, helvetic,sans-serif;
    }               
    table tr:nth-child(odd) {
      background-color: #eee;
    }  
    table tr:nth-child(even) {
      background-color: #fff;
    }   
    table thead th {
      background-color: rgba(0, 216, 169, 1);
    } 
    table tfoot td {
      background-color: #ccc;
    } 
    th{
    	color:white;
    }
    

</style> 
<p>
	<img width='150' src='img/logo.png'>
	<h1>Materiais Processados Externos</h1>
    <div style='margin-left:0px;margin-bottom:10px'>
        <small>Data: ".$DtSaida=date('d/m/Y')."</small>
    </div>
</p>
<table align='center'>
    <thead>
        <tr>
            <th>Id</th>
            <th>Material</th>
            <th>Processado por</th>
            <th>Lote</th>
            <th scope='col'>Início do ciclo</th>
            <th scope='col'>Fim do ciclo</th>
            <th scope='col'>Nº Ciclo</th>
            <th scope='col'>Pressão</th>
            <th scope='col'>Temp.Interna</th>
            <th scope='col'>Horario que atingiu 134º</th>
            <th scope='col'>Data</th> 
            <th scope='col'>Hora</th>  
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan='3' align='center'>".$dados['nome']."</td>
        </tr>
    </tfoot>>    
    <tbody>";
        
 	foreach($lista as $key => $dado){ 
        $html.="<tr><td>".$dado['id_processando_material']."</td>";
        $html.="<td>".$dado['material']."</td>";
        $html.="<td>".$dado['responsavel_por']."</td>";
        $html.="<td>".$dado['lote']."</td>";
        $html.="<td>".$dado['inicio_ciclo']."</td>";
        $html.="<td>".$dado['fim_ciclo']."</td>";
        $html.="<td>".$dado['numero_do_ciclo']."</td>";
        $html.="<td>".$dado['pressao']."</td>";
        $html.="<td>".$dado['temperatura_interna']."</td>";
        $html.="<td>".$dado['horario_134']."</td>";
        $html.="<td>".$dado['data_processado']."</td></tr>";
        $html.="<td>".$dado['hora']."</td></tr>";
    } 
         
    $html.=" </tbody>
</table>
";

$mpdf=new \Mpdf\Mpdf();
$mpdf->SetDisplayMode('fullpage');
$css = file_get_contents("css/estilo.css");
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html);
$mpdf->Output();

}else if(isset($_GET['receb_interno'])){

    $kit_interno = new Kit_Material_interno();
    $kit_interno->__set('id_hospital',$_SESSION['id_hospital']);
    $kit_interno_service = new Kit_mat_inter_service($kit_interno,$conexao);
    $lista=$kit_interno_service->listaKitInterno($pagina,$limit);

    $html = "
<style>
    h1{
        color: rgba(0, 216, 169, 1);
        text-align:center;  
        font-family: trebuchet ms, helvetic,sans-serif;
    }
    table, th, td {
        border: 1px solid #E8E8E8;
        border-collapse: collapse;
        padding: 5px;
        border-radius:10px !important;
        font-family: trebuchet ms, helvetic,sans-serif;
    }               
    table tr:nth-child(odd) {
      background-color: #eee;
    }  
    table tr:nth-child(even) {
      background-color: #fff;
    }   
    table thead th {
      background-color: rgba(0, 216, 169, 1);
    } 
    table tfoot td {
      background-color: #ccc;
    } 
    th{
        color:white;
    }img{
        margin-left:50px;
    }

</style> 
<p>
    <img width='150' src='img/logo.png'>
    <h1>Materiais Recebidos Internos</h1>
   
</p>
<div style='margin-left:55px;margin-bottom:10px'>
 <small>Data: ".$DtSaida=date('d/m/Y')."</small>
</div>
<table align='center'>
    <thead>
        <tr>
            <th>Id</th>
            <th>Material</th>
            <th scope='col'>Entregue por</th>
            <th scope='col'>Recebido por</th>
            <th scope='col'>Lavado por</th>
            <th scope='col'>Data</th>
            <th scope='col'>Hora</th>  
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan='3' align='center'>".$dados['nome']."</td>
        </tr>
    </tfoot>>    
    <tbody>";
        
    foreach($lista as $key => $dado){ 
        $html.="<tr><td>".$dado['id_material']."</td>";
        $html.="<td>".$dado['descricao']."</td>";
        $html.="<td>".$dado['quem_entregou']."</td>";
        $html.="<td>".$dado['quem_recebeu']."</td>";
        $html.="<td>".$dado['quem_lavou']."</td>";
        $html.="<td>".$dado['data_recebido']."</td>";
        $html.="<td>".$dado['hora']."</td>";
    } 
         
    $html.=" </tbody>
</table>
";

$mpdf=new \Mpdf\Mpdf();
$mpdf->SetDisplayMode('fullpage');
$css = file_get_contents("css/estilo.css");
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html);
$mpdf->Output();

}else if(isset($_GET['receb_externo'])){

    $kit_externo = new Kit_Material_externo();
    $kit_externo->__set('id_hospital',$_SESSION['id_hospital']);
    $kit_externo_service = new Kit_mat_extern_service($kit_externo,$conexao);
    $lista = $kit_externo_service->listaMateriaisExternos($pagina,$limit);

    $html = "
<style>
    h1{
        color: rgba(0, 216, 169, 1);
        text-align:center;  
        font-family: trebuchet ms, helvetic,sans-serif;
    }
    table, th, td {
        border: 1px solid #E8E8E8;
        border-collapse: collapse;
        padding: 5px;
        border-radius:10px !important;
        font-family: trebuchet ms, helvetic,sans-serif;
    }               
    table tr:nth-child(odd) {
      background-color: #eee;
    }  
    table tr:nth-child(even) {
      background-color: #fff;
    }   
    table thead th {
      background-color: rgba(0, 216, 169, 1);
    } 
    table tfoot td {
      background-color: #ccc;
    } 
    th{
        color:white;
    }

</style> 
<p>
    <img width='150' src='img/logo.png'>
    <h1>Materiais Recebidos Externos</h1>
   
</p>
<div style='margin-left:7px;margin-bottom:10px'>
 <small>Data: ".$DtSaida=date('d/m/Y')."</small>
</div>
<table align='center'>
    <thead>
        <tr>
            <th>Id</th>
            <th>Material</th>
            <th>Quantidade</th>
            <th scope='col'>Entregue por</th>
            <th scope='col'>Recebido por</th>
            <th scope='col'>Lavado por</th>
            <th scope='col'>Data</th>
            <th scope='col'>Hora</th>  
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan='3' align='center'>".$dados['nome']."</td>
        </tr>
    </tfoot>>    
    <tbody>";
        
    foreach($lista as $key => $dado){ 
        $html.="<tr><td>".$dado['id_kit']."</td>";
        $html.="<td>".$dado['material']."</td>";
        $html.="<td>".$dado['quantidade']."</td>";
        $html.="<td>".$dado['quem_entregou']."</td>";
        $html.="<td>".$dado['quem_recebeu']."</td>";
        $html.="<td>".$dado['quem_lavou']."</td>";
        $html.="<td>".$dado['data_recebido']."</td>";
        $html.="<td>".$dado['hora']."</td>";
    } 
         
    $html.=" </tbody>
</table>
";

$mpdf=new \Mpdf\Mpdf();
$mpdf->SetDisplayMode('fullpage');
$css = file_get_contents("css/estilo.css");
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html);
$mpdf->Output();

}else if(isset($_GET['saido_interno'])){

    $kit_interno = new Kit_saido_interno();
    $kit_interno->__set('id_hospital',$_SESSION['id_hospital']);
    $kit_interno_service = new Kit_saido_interno_service($kit_interno,$conexao);
    $lista=$kit_interno_service->listaKitSaidaInterno($pagina,$limit);

    $html = "
<style>
    h1{
        color: rgba(0, 216, 169, 1);
        text-align:center;  
        font-family: trebuchet ms, helvetic,sans-serif;
    }
    table, th, td {
        border: 1px solid #E8E8E8;
        border-collapse: collapse;
        padding: 5px;
        border-radius:10px !important;
        font-family: trebuchet ms, helvetic,sans-serif;
    }               
    table tr:nth-child(odd) {
      background-color: #eee;
    }  
    table tr:nth-child(even) {
      background-color: #fff;
    }   
    table thead th {
      background-color: rgba(0, 216, 169, 1);
    } 
    table tfoot td {
      background-color: #ccc;
    } 
    th{
        color:white;
    }img{
        margin-left:30px;
    }

</style> 
<p>
    <img width='150' src='img/logo.png'>
    <h1>Materiais internos liberados do Sistema</h1>
   
</p>
<div style='margin-left:27px;margin-bottom:10px'>
 <small>Data: ".$DtSaida=date('d/m/Y')."</small>
</div>
<table align='center'>
    <thead>
        <tr>
            <th scope='col'>Id</th>
            <th scope='col'>Material</th>
            <th scope='col'>Saida para</th>
            <th scope='col'>NºRegistro</th>
            <th scope='col'>Paciente</th>
            <th scope='col'>Reponsável pela saida</th>
            <th scope='col'>Data</th>
            <th scope='col'>Hora</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan='3' align='center'>".$dados['nome']."</td>
        </tr>
    </tfoot>>    
    <tbody>";
        
    foreach($lista as $key => $dado){ 
        $html.="<tr><td>".$dado['id_material']."</td>";
        $html.="<td>".$dado['descricao']."</td>";
        $html.="<td>".$dado['saida_para']."</td>";
        $html.="<td>".$dado['registro']."</td>";
        $html.="<td>".$dado['paciente_empresa_setor']."</td>";
        $html.="<td>".$dado['responsavel']."</td>";
        $html.="<td>".$dado['data_saido']."</td>";
        $html.="<td>".$dado['hora']."</td>";
    } 
         
    $html.=" </tbody>
</table>
";

$mpdf=new \Mpdf\Mpdf();
$mpdf->SetDisplayMode('fullpage');
$css = file_get_contents("css/estilo.css");
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html);
$mpdf->Output();

}else if(isset($_GET['saido_externo'])){

    $kit_interno = new Kit_saido_externo();
    $kit_interno->__set('id_hospital',$_SESSION['id_hospital']);
    $kit_interno_service = new Kit_saido_externo_service($kit_interno,$conexao);
    $lista=$kit_interno_service->listaKitSaidaExterno($pagina,$limit);

    $html = "
<style>
    h1{
        color: rgba(0, 216, 169, 1);
        text-align:center;  
        font-family: trebuchet ms, helvetic,sans-serif;
    }
    table, th, td {
        border: 1px solid #E8E8E8;
        border-collapse: collapse;
        padding: 5px;
        border-radius:10px !important;
        font-family: trebuchet ms, helvetic,sans-serif;
    }               
    table tr:nth-child(odd) {
      background-color: #eee;
    }  
    table tr:nth-child(even) {
      background-color: #fff;
    }   
    table thead th {
      background-color: rgba(0, 216, 169, 1);
    } 
    table tfoot td {
      background-color: #ccc;
    } 
    th{
        color:white;
    }img{
        margin-left:0px;
    }

</style> 
<p>
    <img width='150' src='img/logo.png'>
    <h1>Materiais externos liberados do Sistema</h1>  
</p>
<div style='margin-left:0px;margin-bottom:10px'>
 <small>Data: ".$DtSaida=date('d/m/Y')."</small>
</div>
<table align='center'>
    <thead>
        <tr>
            <th scope='col'>Id</th>
            <th scope='col'>Material</th>
            <th scope='col'>Quantidade</th>
            <th scope='col'>Saida para</th>
            <th scope='col'>NºRegistro</th>
            <th scope='col'>Paciente</th>
            <th scope='col'>Reponsável pela saida</th>
            <th scope='col'>Data</th>
            <th scope='col'>Hora</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan='3' align='center'>".$dados['nome']."</td>
        </tr>
    </tfoot>>    
    <tbody>";
        
    foreach($lista as $key => $dado){ 
        $html.="<tr><td>".$dado['id_mat']."</td>";
        $html.="<td>".$dado['descricao']."</td>";
        $html.="<td>".$dado['quantidade']."</td>";
        $html.="<td>".$dado['saida_para']."</td>";
        $html.="<td>".$dado['registro']."</td>";
        $html.="<td>".$dado['paciente_empresa_setor']."</td>";
        $html.="<td>".$dado['responsavel']."</td>";
        $html.="<td>".$dado['data_saido']."</td>";
        $html.="<td>".$dado['hora']."</td>";
    } 
         
    $html.=" </tbody>
</table>
";

$mpdf=new \Mpdf\Mpdf();
$mpdf->SetDisplayMode('fullpage');
$css = file_get_contents("css/estilo.css");
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html);
$mpdf->Output();

}else if(isset($_GET['proce_interno'])){

    $kit_interno = new Kit_Processado_Interno();
    $kit_interno->__set('id_hospital',$_SESSION['id_hospital']);
    $kit_interno_service = new Kit_proce_interno_service($kit_interno,$conexao);
    $lista=$kit_interno_service->listaKitProcessandoInterno($pagina,$limit);

    $html = "
<style>
    h1{
        color: rgba(0, 216, 169, 1);
        text-align:center;  
        font-family: trebuchet ms, helvetic,sans-serif;
    }
    table, th, td {
        border: 1px solid #E8E8E8;
        border-collapse: collapse;
        padding: 5px;
        border-radius:10px !important;
        font-family: trebuchet ms, helvetic,sans-serif;
    }               
    table tr:nth-child(odd) {
      background-color: #eee;
    }  
    table tr:nth-child(even) {
      background-color: #fff;
    }   
    table thead th {
      background-color: rgba(0, 216, 169, 1);
    } 
    table tfoot td {
      background-color: #ccc;
    } 
    th{
        color:white;
    }img{
        margin-left:0px;
    }

</style> 
<p>
    <img width='150' src='img/logo.png'>
    <h1>Materiais processados Internos</h1>  
</p>
<div style='margin-left:0px;margin-bottom:10px'>
 <small>Data: ".$DtSaida=date('d/m/Y')."</small>
</div>
<table align='center'>
    <thead>
        <tr>
            <th scope='col'>Id</th>
            <th scope='col'>Material</th>
            <th scope='col'>Processado por</th>
            <th scope='col'>Lote</th>
            <th scope='col'>Início do ciclo</th>
            <th scope='col'>Fim do ciclo</th>
            <th scope='col'>Nº Ciclo</th>
            <th scope='col'>Pressão</th>
            <th scope='col'>Temp.Interna</th>
            <th scope='col'>Horario que atingiu 134º</th>
            <th scope='col'>Data</th>
            <th scope='col'>Hora</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan='3' align='center'>".$dados['nome']."</td>
        </tr>
    </tfoot>>    
    <tbody>";
        
    foreach($lista as $key => $dado){ 
        $html.="<tr><td>".$dado['id_material']."</td>";
        $html.="<td>".$dado['descricao']."</td>";
        $html.="<td>".$dado['responsavel_por']."</td>";
        $html.="<td>".$dado['lote']."</td>";
        $html.="<td>".$dado['inicio_ciclo']."</td>";
        $html.="<td>".$dado['fim_ciclo']."</td>";
        $html.="<td>".$dado['numero_do_ciclo']."</td>";
        $html.="<td>".$dado['pressao']."</td>";
        $html.="<td>".$dado['temperatura_interna']."</td>";
        $html.="<td>".$dado['horario_134']."</td>";
        $html.="<td>".$dado['data_processado']."</td>";
        $html.="<td>".$dado['hora']."</td>";
    } 
         
    $html.=" </tbody>
</table>
";

$mpdf=new \Mpdf\Mpdf();
$mpdf->SetDisplayMode('fullpage');
$css = file_get_contents("css/estilo.css");
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html);
$mpdf->Output();

}

	
?>