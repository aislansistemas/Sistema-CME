<?php
	//classe de apostas que representa a tabela de usuarios no banco de dados
	class MaterialRecebido
	{
		private $id;
		private $id_hospital;
		private $quem_entregou;
		private $quem_recebeu;
		private $quem_lavou;
		private $data;

		public function __get($atributo){
			return $this->$atributo;
		}
		public function __set($atributo,$valor){
			return $this->$atributo=$valor;
		}
	}
?>