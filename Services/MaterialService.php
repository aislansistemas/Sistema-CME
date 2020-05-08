<?php 
	
	//classe contém as regras de negocio referente ao modelo de usuario
	class MaterialService{

		public $material;
		public $conexao;

		public function __construct(Material $material,Conexao $conexao){
			$this->material=$material;
			$this->conexao=$conexao->conectar();
		}
		public function selecionaMateriasAtivos(){
			$query="select * from tb_materiais 
			where id_hospital = :id_hospital and situacao = 'ativo' ";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->material->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function cadastraMaterial(){
			$query="insert into tb_materiais(descricao,id_hospital)
			values(:descricao, :id_hospital)";
			$insert=$this->conexao->prepare($query);
			$insert->bindValue(':descricao',$this->material->__get('descricao'));
			$insert->bindValue(':id_hospital',$this->material->__get('id_hospital'));
			$insert->execute();
		}
		public function totalMateriaisAtivos(){
			$query="select count(*) as total from tb_materiais 
			where id_hospital = :id_hospital and situacao = 'ativo' ";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->material->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetch();
		}

		public function listarMateriasAtivos($pagina,$limit){
			$query="select * from tb_materiais 
			where id_hospital = :id_hospital and situacao = 'ativo' order by id asc limit ".$pagina.",".$limit."";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->material->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function buscaMateriasAtivos(){
			$query="select * from tb_materiais 
			where id_hospital = :id_hospital and situacao = 'ativo' and descricao like :descricao  and status_material = 'disponivel'";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$_SESSION['id_hospital']);
			$stmt->bindValue(':descricao','%'.$this->material->__get('descricao').'%');
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function listarMateriasInativos($pagina,$limit){
			$query="select * from tb_materiais 
			where id_hospital = :id_hospital and situacao = 'inativo' order by id asc limit ".$pagina.",".$limit."";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->material->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function totalMateriaisInativos(){
			$query="select count(*) as total from tb_materiais 
			where id_hospital = :id_hospital and situacao = 'inativo' ";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->material->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetch();
		}

		public function editar(){
			$query="update tb_materiais set descricao= :descricao where id = :id and id_hospital = :id_hospital";
			$insert=$this->conexao->prepare($query);
			$insert->bindValue(':id',$this->material->__get('id'));
			$insert->bindValue(':descricao',$this->material->__get('descricao'));
			$insert->bindValue(':id_hospital',$this->material->__get('id_hospital'));
			$insert->execute();
		}

		public function editarStatus(){
			$query="update tb_materiais set status_material = :status_material where id = :id and id_hospital = :id_hospital";
			$insert=$this->conexao->prepare($query);
			$insert->bindValue(':id',$this->material->__get('id'));
			$insert->bindValue(':id_hospital',$this->material->__get('id_hospital'));
			$insert->bindValue(':status_material',$this->material->__get('status_material'));
			$insert->execute();
		}

		public function desativar(){
			$query="update tb_materiais set situacao = 'inativo' where id = :id and id_hospital = :id_hospital";
			$insert=$this->conexao->prepare($query);
			$insert->bindValue(':id',$this->material->__get('id'));
			$insert->bindValue(':id_hospital',$this->material->__get('id_hospital'));
			$insert->execute();
		}
		public function ativar(){
			$query="update tb_materiais set situacao = 'ativo' where id = :id and id_hospital = :id_hospital";
			$insert=$this->conexao->prepare($query);
			$insert->bindValue(':id',$this->material->__get('id'));
			$insert->bindValue(':id_hospital',$this->material->__get('id_hospital'));
			$insert->execute();
		}

		public function getById($id)
        {
            $query = "SELECT descricao from tb_materiais WHERE id = :id and situacao = 'ativo' ";

            $select = $this->conexao->prepare($query);
            $select->bindValue(':id', $id);
            $select->execute();

            $resultSet = $select->fetchAll(PDO::FETCH_ASSOC);

            if($select->rowCount() > 0){
                return $resultSet[0];
            }else{
                return false;
            }
        }
				
		
	}
?>