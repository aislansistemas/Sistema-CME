<?php
	//classe de apostas que representa a tabela de usuarios no banco de dados
	class Hospital
	{
		private $id;
		private $logo;
		private $logo_caminho;
		private $nome;
		private $email;
		private $senha;
		private $cnpj;
		private $telefone;
		private $endereco;
		private $cidade;
		private $estado;

		public function __get($atributo){
			return $this->$atributo;
		}
		public function __set($atributo,$valor){
			return $this->$atributo=$valor;
		}
	}
?>