<?php
	
	class Kit_proce_interno_service{

		public $kit_proce_interno;
		public $conexao;

		public function __construct(Kit_Processado_Interno $kit_proce_interno,Conexao $conexao){
			$this->kit_proce_interno=$kit_proce_interno;
			$this->conexao=$conexao->conectar();
		}	
		public function cadastraKitProcessado(){
			$query="insert into tb_kit_material_processado_interno
			(id_processado,id_hospital,id_material,quantidade, status)
			values(:id_processado, :id_hospital, :id_material, :quantidade, :status)";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_processado',$this->kit_proce_interno->__get('id_processado'));
			$stmt->bindValue(':id_hospital',$this->kit_proce_interno->__get('id_hospital'));
			$stmt->bindValue(':id_material',$this->kit_proce_interno->__get('id_material'));
			$stmt->bindValue(':quantidade',$this->kit_proce_interno->__get('quantidade'));
			$stmt->bindValue(':status',$this->kit_proce_interno->__get('status'));
			$stmt->execute();
		}
		public function alterarKitProcessadoStatus(){
			$query="update tb_kit_material_processado_interno SET `quantidade` = :quantidade, `status` = :status WHERE (`id` = :id_processado_material and `id_hospital` = :id_hospital);";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_processado_material',$this->kit_proce_interno->__get('id_processado_material'));
			$stmt->bindValue(':id_hospital',$this->kit_proce_interno->__get('id_hospital'));
			$stmt->bindValue(':quantidade',$this->kit_proce_interno->__get('quantidade'));
			$stmt->bindValue(':status',$this->kit_proce_interno->__get('status'));
			$stmt->execute();
		}
		public function listaKitProcessandoInterno($pagina,$limit){
			$query="select *, DATE_FORMAT(c.data,'%d/%m/%Y') as data_processado, a.id as id_processando_material from tb_kit_material_processado_interno a INNER JOIN tb_materiais b ON b.id = a.id_material INNER JOIN tb_materiais_processados c ON c.id = a.id_processado WHERE a.id_hospital= :id_hospital and a.status = 'processado' order by a.id desc limit ".$pagina.",".$limit."";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->kit_proce_interno->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		public function getKitProcessandoInterno(){
			$query="select *, DATE_FORMAT(c.data,'%d/%m/%Y') as data_processado, a.id as id_processando_material from tb_kit_material_processado_interno a INNER JOIN tb_materiais b ON b.id = a.id_material INNER JOIN tb_materiais_processados c ON c.id = a.id_processado WHERE a.id_hospital= :id_hospital and a.id = :id_processado_material and a.status = 'processado' order by a.id desc";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_processado_material',$this->kit_proce_interno->__get('id_processado_material'));
			$stmt->bindValue(':id_hospital',$this->kit_proce_interno->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		///metodo de buscar material pela descricao
		public function buscaMaterialProcessandoInterno($material,$tipobusca,$pagina,$limit){
			$query="select *, DATE_FORMAT(c.data,'%d/%m/%Y') as data_processado, a.id as id_processando_material from tb_kit_material_processado_interno a INNER JOIN tb_materiais b ON b.id = a.id_material INNER JOIN tb_materiais_processados c ON c.id = a.id_processado WHERE a.id_hospital= :id_hospital and ".$tipobusca." like :material and a.status = 'processado' ORDER by data_processado desc limit ".$pagina.",".$limit."";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':material','%'.$material.'%');
			$stmt->bindValue(':id_hospital',$this->kit_proce_interno->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		///
		public function totalMateriaisProcessandoInternos(){
			$query="select count(*) as total from tb_kit_material_processado_interno where id_hospital= :id_hospital and status = 'processado' ";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->kit_proce_interno->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetch();
		}
		public function TotalProceInterno(){
			$query="select count(*) total_proce_interno 
			from tb_kit_material_processado_interno where id_hospital = :id_hospital and status = 'processado' ";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->kit_proce_interno->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetch();
		}
		
							
	}
?>