<?php
	
	class Kit_saido_externo_service{

		public $kit_saido_externo;
		public $conexao;

		public function __construct(Kit_saido_externo $kit_saido_externo,Conexao $conexao){
			$this->kit_saido_externo=$kit_saido_externo;
			$this->conexao=$conexao->conectar();
		}	
		public function salvaKitSaidaExterno(){
			$query="insert into tb_kit_material_saido_externo
			(id_saida,id_hospital,material,quantidade)
			values(:id_saida, :id_hospital, :material, :quantidade)";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_saida',$this->kit_saido_externo->__get('id_saida'));
			$stmt->bindValue(':id_hospital',$this->kit_saido_externo->__get('id_hospital'));
			$stmt->bindValue(':material',$this->kit_saido_externo->__get('material'));
			$stmt->bindValue(':quantidade',$this->kit_saido_externo->__get('quantidade'));
			$stmt->execute();
		}
		public function listaKitSaidaExterno($pagina,$limit){
			$query="select *,a.id as id_mat, DATE_FORMAT(b.data,'%d/%m/%Y') as data_saido from tb_kit_material_saido_externo a INNER JOIN tb_saida_material b ON b.id = a.id_saida WHERE a.id_hospital= :id_hospital and status= 'saido' and b.data BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() order by a.id desc limit ".$pagina.",".$limit."";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->kit_saido_externo->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		///metodo de buscar material pela descricao
		public function buscaMaterialSaidaExterno($data1,$data2,$pagina,$limit){
			$query="select *,a.id as id_mat, DATE_FORMAT(b.data,'%d/%m/%Y') as data_saido from tb_kit_material_saido_externo a INNER JOIN tb_saida_material b ON b.id = a.id_saida WHERE a.id_hospital= :id_hospital and b.data between :data1 and :data2 and status= 'saido' ORDER by data_saido desc limit ".$pagina.",".$limit."";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':data1',$data1);
			$stmt->bindValue(':data2',$data2);
			$stmt->bindValue(':id_hospital',$this->kit_saido_externo->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		///
		public function totalMateriaisSaidaExternos(){
			$query="select count(*) as total from tb_kit_material_saido_externo where status = 'saido' and id_hospital= :id_hospital";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->kit_saido_externo->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetch();
		}							
	}
?>