<?php
	
	class Kit_Processado_externo
	{
		private $id;
		private $id_processado;
		private $id_hospital;
		private $id_material;
		private $id_kit_recebido;
		private $quantidade;
		private $status;
		private $id_processado_material;

		public function __get($atributo){
			return $this->$atributo;
		}
		public function __set($atributo,$valor){
			return $this->$atributo=$valor;
		}
	}
?>