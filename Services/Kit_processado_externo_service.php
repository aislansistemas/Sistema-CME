<?php
	
	class Kit_proce_externo_service{

		public $kit_proce_externo;
		public $conexao;

		public function __construct(Kit_Processado_externo $kit_proce_externo,Conexao $conexao){
			$this->kit_proce_externo=$kit_proce_externo;
			$this->conexao=$conexao->conectar();
		}	
		public function cadastraKitProcessado(){
			$query="insert into tb_kit_material_processado_externo
			(id_processado,id_hospital,material,quantidade, `status`)
			values(:id_processado, :id_hospital, :material, :quantidade, :status)";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_processado',$this->kit_proce_externo->__get('id_processado'));
			$stmt->bindValue(':id_hospital',$this->kit_proce_externo->__get('id_hospital'));
			$stmt->bindValue(':material',$this->kit_proce_externo->__get('material'));
			$stmt->bindValue(':quantidade',$this->kit_proce_externo->__get('quantidade'));
			$stmt->bindValue(':status',$this->kit_proce_externo->__get('status'));
			$stmt->execute();
		}
		public function alterarKitProcessadoStatus(){
			$query="update tb_kit_material_processado_externo SET `status` = :status WHERE (`id` = :id_processado_material);";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_processado_material',$this->kit_proce_externo->__get('id_processado_material'));
			$stmt->bindValue(':status',$this->kit_proce_externo->__get('status'));
			$stmt->execute();
		}
		public function listaKitProcessandoExterno($pagina,$limit){
			$query="select *, DATE_FORMAT(b.data,'%d/%m/%Y') as data_processado, a.id as id_processando_material from tb_kit_material_processado_externo a INNER JOIN tb_materiais_processados b ON b.id = a.id_processado WHERE a.id_hospital= :id_hospital and a.status = 'processado' order by a.id desc limit ".$pagina.",".$limit."";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->kit_proce_externo->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		///metodo de buscar material pela descricao
		public function buscaMaterialProcessandoExterno($material,$tipobusca,$pagina,$limit){
			$query="select *, DATE_FORMAT(b.data,'%d/%m/%Y') as data_processado, a.id as id_processando_material from tb_kit_material_processado_externo a INNER JOIN tb_materiais_processados b ON b.id = a.id_processado WHERE a.id_hospital= :id_hospital and a.status = 'processado' and ".$tipobusca." like :material ORDER by data_processado desc limit ".$pagina.",".$limit."";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':material','%'.$material.'%');
			$stmt->bindValue(':id_hospital',$this->kit_proce_externo->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		///
		public function totalMateriaisProcessandoExternos(){
			$query="select count(*) as total from tb_kit_material_processado_externo where id_hospital= :id_hospital and status = 'processado' ";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->kit_proce_externo->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetch();
		}
		public function TotalProceExterno(){
			$query="select count(*) as total_proce_externo
			from tb_kit_material_processado_externo where id_hospital = :id_hospital and status = 'processado' ";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->kit_proce_externo->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetch();
		}
									
	}
?>