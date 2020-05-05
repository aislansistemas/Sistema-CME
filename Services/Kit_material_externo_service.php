<?php
	
	class Kit_mat_extern_service{

		public $kit_mat_extern;
		public $conexao;

		public function __construct(Kit_Material_externo $kit_mat_extern,Conexao $conexao){
			$this->kit_mat_extern=$kit_mat_extern;
			$this->conexao=$conexao->conectar();
		}
		public function salvaKitExterno(){
			$query="insert into tb_kit_material_recebido_externo
			(id_recebido,id_hospital,material,quantidade)
			values(:id_recebido, :id_hospital, :material, :quantidade)";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_recebido',$this->kit_mat_extern->__get('id_recebido'));
			$stmt->bindValue(':id_hospital',$this->kit_mat_extern->__get('id_hospital'));
			$stmt->bindValue(':material',$this->kit_mat_extern->__get('material'));
			$stmt->bindValue(':quantidade',$this->kit_mat_extern->__get('quantidade'));
			$stmt->execute();
		}
		public function alterarQtdKitExterno(){
			$query="update tb_kit_material_recebido_externo SET `status` = :status WHERE (`id` = :id and `id_hospital` = :id_hospital);";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id',$this->kit_mat_extern->__get('id'));
			$stmt->bindValue(':id_hospital',$this->kit_mat_extern->__get('id_hospital'));
			$stmt->bindValue(':status',$this->kit_mat_extern->__get('status'));
			$stmt->execute();
		}
		public function listaMateriaisExternos($pagina,$limit){
			$query="select *,kit.id as id_kit,DATE_FORMAT(mr.data,'%d/%m/%Y') as data_recebido from tb_kit_material_recebido_externo as kit, tb_materiais_recebidos as mr where  kit.id_recebido=mr.id and kit.id_hospital= :id_hospital and status = 'recebido' order by kit.id desc limit ".$pagina.",".$limit."";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->kit_mat_extern->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}	
		////
		public function buscaMaterialExterno($material,$tipobusca,$pagina,$limit){
			$query="select *,kit.id as id_kit,DATE_FORMAT(mr.data, '%d/%m/%Y') as data_recebido FROM tb_kit_material_recebido_externo as kit inner JOIN tb_materiais_recebidos as mr on(kit.id_recebido = mr.id and ".$tipobusca." like :material and  kit.quantidade > 0 and kit.status = 'recebido' and kit.id_hospital= :id_hospital) ORDER by data_recebido desc limit ".$pagina.",".$limit."";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':material','%'.$material.'%');
			$stmt->bindValue(':id_hospital',$this->kit_mat_extern->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		////
		public function totalMateriaisExternos(){
			$query="select count(*) as total from tb_kit_material_recebido_externo where id_hospital= :id_hospital and status = 'recebido' ";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->kit_mat_extern->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetch();
		}
		
		
	}
?>