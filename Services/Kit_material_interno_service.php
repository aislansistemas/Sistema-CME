<?php
	//classe contém as regras de negocio referente ao modelo de usuario
	class Kit_mat_inter_service{

		public $kit_mat_inter;
		public $conexao;

		public function __construct(Kit_Material_interno $kit_mat_inter,Conexao $conexao){
			$this->kit_mat_inter=$kit_mat_inter;
			$this->conexao=$conexao->conectar();
		}	
		public function salvaKitInterno(){
			$query="insert into tb_kit_material_recebido_interno
			(id_recebido,id_hospital,id_material,quantidade)
			values(:id_recebido, :id_hospital, :id_material, :quantidade)";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_recebido',$this->kit_mat_inter->__get('id_recebido'));
			$stmt->bindValue(':id_hospital',$this->kit_mat_inter->__get('id_hospital'));
			$stmt->bindValue(':id_material',$this->kit_mat_inter->__get('id_material'));
			$stmt->bindValue(':quantidade',$this->kit_mat_inter->__get('quantidade'));
			$stmt->execute();
		}
		public function alterarQtdKitInterno(){
			$query="update tb_kit_material_recebido_interno SET `quantidade` = :quantidade, `status` = :status WHERE (`id` = :id and `id_hospital` = :id_hospital);";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id',$this->kit_mat_inter->__get('id'));
			$stmt->bindValue(':id_hospital',$this->kit_mat_inter->__get('id_hospital'));
			$stmt->bindValue(':quantidade',$this->kit_mat_inter->__get('quantidade'));
			$stmt->bindValue(':status',$this->kit_mat_inter->__get('status'));
			$stmt->execute();
		}
		public function listaKitInterno($pagina,$limit){
			$query="select *,kit.id as id_kit,DATE_FORMAT(mr.data,'%d/%m/%Y') as data_recebido from tb_kit_material_recebido_interno as kit, tb_materiais as m, tb_materiais_recebidos as mr where kit.id_material=m.id and kit.id_recebido=mr.id and kit.id_hospital= :id_hospital and kit.status = 'recebido' order by kit.id desc limit ".$pagina.",".$limit."";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->kit_mat_inter->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		public function getMaterialInterno(){
			$query="select *,kit.id as id_kit,DATE_FORMAT(mr.data,'%d/%m/%Y') as data_recebido from tb_kit_material_recebido_interno as kit, tb_materiais as m, tb_materiais_recebidos as mr where kit.id_material=m.id and kit.id_recebido=mr.id and kit.id_hospital= :id_hospital and status= 'recebido' and kit.id = :id";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->kit_mat_inter->__get('id_hospital'));
			$stmt->bindValue(':id',$this->kit_mat_inter->__get('id'));
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		///metodo de buscar material pela descricao
		public function buscaMaterialInterno($material,$tipobusca,$pagina,$limit){

			
			$query="select *,kit.id as id_kit,DATE_FORMAT(mr.data, '%d/%m/%Y') as data_recebido FROM tb_kit_material_recebido_interno as kit inner join tb_materiais as m inner JOIN tb_materiais_recebidos as mr on(kit.id_material = m.id and kit.id_recebido = mr.id and ".$tipobusca." like :material and kit.status = 'recebido' and kit.id_hospital= :id_hospital) ORDER by data_recebido desc limit ".$pagina.",".$limit."";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':material','%'.$material.'%');
			$stmt->bindValue(':id_hospital',$this->kit_mat_inter->__get('id_hospital'));
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		///
		public function totalMateriaisInternos(){
			$query="select count(*) as total from tb_kit_material_recebido_interno where id_hospital= :id_hospital and status = 'recebido' ";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->kit_mat_inter->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetch();
		}
		
	}
?>