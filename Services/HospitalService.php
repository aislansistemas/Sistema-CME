<?php
	
	class HospitalService{

		public $hospital;
		public $conexao;

		public function __construct(Hospital $hospital,Conexao $conexao){
			$this->hospital=$hospital;
			$this->conexao=$conexao->conectar();
		}	
		public function GetLastID(){
			$query="select * from tb_hospitais order by id desc limit 1";
			$dados=$this->conexao->prepare($query);
			$dados->execute();
			return $dados->fetch();
		}	

		public function CadastraHospital(){
			$query="insert into tb_hospitais (logo, logo_caminho,nome,email,senha,cnpj,telefone,endereco,cidade,estado) values (:logo, :logo_caminho, :nome, :email, :senha, :cnpj, :telefone, :endereco, :cidade, :estado)";
			$dados=$this->conexao->prepare($query);
			$dados->bindValue(':logo',$this->hospital->__get('logo'));
			$dados->bindValue(':logo_caminho',$this->hospital->__get('logo_caminho'));
			$dados->bindValue(':nome',$this->hospital->__get('nome'));
			$dados->bindValue(':email',$this->hospital->__get('email'));
			$dados->bindValue(':senha',$this->hospital->__get('senha'));
			$dados->bindValue(':cnpj',$this->hospital->__get('cnpj'));
			$dados->bindValue(':telefone',$this->hospital->__get('telefone'));
			$dados->bindValue(':endereco',$this->hospital->__get('endereco'));
			$dados->bindValue(':cidade',$this->hospital->__get('cidade'));
			$dados->bindValue(':estado',$this->hospital->__get('estado'));
			$dados->execute();	
		}

		public function BuscaHospitais(){
			$query="select * from tb_hospitais where situacao = 'ativo'";
			$dados=$this->conexao->prepare($query);
			$dados->execute();
			return $dados->fetchAll(PDO::FETCH_ASSOC);
		}	

		public function BuscaTodosHospitais(){
			$query="select * from tb_hospitais";
			$dados=$this->conexao->prepare($query);
			$dados->execute();
			return $dados->fetchAll(PDO::FETCH_ASSOC);
		}

		public function BuscaHospitaisPorId(){
			$query="select * from tb_hospitais where id= :id_hospital";
			$dados=$this->conexao->prepare($query);
			$dados->bindValue(':id_hospital',$this->hospital->__get('id'));
			$dados->execute();
			return $dados->fetch();
		}	

		public function InativaHospital(){
			$query="update tb_hospitais set situacao = 'inativo' where id = :id ";
			$dados=$this->conexao->prepare($query);
			$dados->bindValue(':id',$this->hospital->__get('id'));
			$dados->execute();	
		}

		public function ativaHospital(){
			$query="update tb_hospitais set situacao = 'ativo' where id = :id ";
			$dados=$this->conexao->prepare($query);
			$dados->bindValue(':id',$this->hospital->__get('id'));
			$dados->execute();	
		}

		public function BuscaHospitalPorEmail(){
			$query="select * from tb_hospitais where email = :email";
			$dados=$this->conexao->prepare($query);
			$dados->bindValue(':email',$this->hospital->__get('email'));
			$dados->execute();
			return $dados->fetch();
		}

		public function EditarSemImagem(){
			$query="update tb_hospitais set nome = :nome, email = :email, senha = :senha, cnpj = :cnpj, telefone = :telefone, endereco = :endereco ,cidade = :cidade, estado = :estado where id = :id ";
			$dados=$this->conexao->prepare($query);
			$dados->bindValue(':nome',$this->hospital->__get('nome'));
			$dados->bindValue(':email',$this->hospital->__get('email'));
			$dados->bindValue(':senha',$this->hospital->__get('senha'));
			$dados->bindValue(':cnpj',$this->hospital->__get('cnpj'));
			$dados->bindValue(':telefone',$this->hospital->__get('telefone'));
			$dados->bindValue(':endereco',$this->hospital->__get('endereco'));
			$dados->bindValue(':cidade',$this->hospital->__get('cidade'));
			$dados->bindValue(':estado',$this->hospital->__get('estado'));
			$dados->bindValue(':id',$this->hospital->__get('id'));
			$dados->execute();
		}

		public function EditarComImagem(){
			$query="update tb_hospitais set logo = :logo, logo_caminho = :logo_caminho, nome = :nome, email = :email, senha = :senha, cnpj = :cnpj, telefone = :telefone, endereco = :endereco ,cidade = :cidade, estado = :estado where id = :id ";
			$dados=$this->conexao->prepare($query);
			$dados->bindValue(':logo',$this->hospital->__get('logo'));
			$dados->bindValue(':logo_caminho',$this->hospital->__get('logo_caminho'));
			$dados->bindValue(':nome',$this->hospital->__get('nome'));
			$dados->bindValue(':email',$this->hospital->__get('email'));
			$dados->bindValue(':senha',$this->hospital->__get('senha'));
			$dados->bindValue(':cnpj',$this->hospital->__get('cnpj'));
			$dados->bindValue(':telefone',$this->hospital->__get('telefone'));
			$dados->bindValue(':endereco',$this->hospital->__get('endereco'));
			$dados->bindValue(':cidade',$this->hospital->__get('cidade'));
			$dados->bindValue(':estado',$this->hospital->__get('estado'));
			$dados->bindValue(':id',$this->hospital->__get('id'));
			$dados->execute();
		}


	}
?>