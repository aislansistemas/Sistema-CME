<?php
	
	class Kit_saido_interno_service{

		public $kit_saido_interno;
		public $conexao;

		public function __construct(Kit_saido_interno $kit_saido_interno,Conexao $conexao){
			$this->kit_saido_interno=$kit_saido_interno;
			$this->conexao=$conexao->conectar();
		}	
		public function salvaKitSaidaInterno(){
			$query="insert into tb_kit_material_saido_interno
			(id_saida,id_hospital,id_material,quantidade,id_kit_processado)
			values(:id_saida, :id_hospital, :id_material, :quantidade, :id_kit_processado)";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_saida',$this->kit_saido_interno->__get('id_saida'));
			$stmt->bindValue(':id_hospital',$this->kit_saido_interno->__get('id_hospital'));
			$stmt->bindValue(':id_material',$this->kit_saido_interno->__get('id_material'));
			$stmt->bindValue(':id_kit_processado',$this->kit_saido_interno->__get('id_kit_processado'));
			$stmt->bindValue(':quantidade',$this->kit_saido_interno->__get('quantidade'));
			$stmt->execute();
		}
		public function listaKitSaidaInterno($pagina,$limit){
			$query="select *,a.id as id_mat, DATE_FORMAT(c.data,'%d/%m/%Y') as data_saido from tb_kit_material_saido_interno a INNER JOIN tb_materiais b ON b.id = a.id_material INNER JOIN tb_saida_material c ON c.id = a.id_saida WHERE a.id_hospital= :id_hospital and status= 'saido' and c.data BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() order by a.id desc limit ".$pagina.",".$limit."";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->kit_saido_interno->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		///metodo de buscar material pela descricao
		public function buscaMaterialSaidaInterno($data1,$data2,$pagina,$limit){

			$query="select *,a.id as id_mat, DATE_FORMAT(c.data,'%d/%m/%Y') as data_saido from tb_kit_material_saido_interno a INNER JOIN tb_materiais b ON b.id = a.id_material INNER JOIN tb_saida_material c ON c.id = a.id_saida WHERE a.id_hospital= :id_hospital and c.data between :data1 and :data2 and status= 'saido' ORDER by data_saido desc limit ".$pagina.",".$limit."";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':data1',$data1);
			$stmt->bindValue(':data2',$data2);
			$stmt->bindValue(':id_hospital',$this->kit_saido_interno->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		///
		public function totalMateriaisSaidaInternos(){
			$query="select count(*) as total from tb_kit_material_saido_interno where status = 'saido' and id_hospital= :id_hospital";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->kit_saido_interno->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetch();
		}

		public function DeleteSaidoInterno(){
			$query="delete from tb_kit_material_saido_interno where id = :id and id_hospital = :id_hospital";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id',$this->kit_saido_interno->__get('id'));
			$stmt->bindValue(':id_hospital',$this->kit_saido_interno->__get('id_hospital'));
			$stmt->execute();
		}
							
	}
?>