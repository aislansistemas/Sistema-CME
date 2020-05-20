<?php
	//classe contém as regras de negocio referente ao modelo de usuario
	class MaterialRecebidoService{

		public $material_recebido;
		public $conexao;

		public function __construct(MaterialRecebido $material_recebido,Conexao $conexao){
			$this->material_recebido=$material_recebido;
			$this->conexao=$conexao->conectar();
		}	
		public function cadastroMaterialRecebido(){
			$query="insert into tb_materiais_recebidos
			(id_hospital,quem_entregou,quem_recebeu,quem_lavou,data,hora) 
			values(:id_hospital, :quem_entregou, :quem_recebeu, :quem_lavou, now(),now() )";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital', $this->material_recebido->__get('id_hospital'));
			$stmt->bindValue(':quem_entregou', $this->material_recebido->__get('quem_entregou'));
			$stmt->bindValue(':quem_recebeu', $this->material_recebido->__get('quem_recebeu'));
			$stmt->bindValue(':quem_lavou', $this->material_recebido->__get('quem_lavou'));
			$stmt->execute();
		}
		public function obterUltimoCadastro(){
			$query="select * from tb_materiais_recebidos where id_hospital = :id_hospital order by id desc limit 1;";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital', $this->material_recebido->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetch();
		}

		public function listarRecebidosLavados(){
			$query="select mt.id,mt.quem_entregou,mt.quantidade,DATE_FORMAT(data,'%d/%m/%Y') as data,u.nome as usuario_nome,m.nome as material_nome from tb_materiais_recebidos as mt inner join tb_materiais as m inner join tb_usuarios as u on(mt.id_usuario_lavou = u.id and mt.id_material = m.id and mt.id_hospital = :id_hospital) order by data desc";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital', $this->material_recebido->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		
		public function DeletaMaterialrecebido(){
			$query="delete from tb_materiais_recebidos where id = :id and id_hospital = :id_hospital";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital', $this->material_recebido->__get('id_hospital'));
			$stmt->bindValue(':id', $this->material_recebido->__get('id'));
			$stmt->execute();
		}
		
	}
?>