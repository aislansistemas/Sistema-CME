<?php
	
	class Kit_saido_externo
	{
		private $id;
		private $id_saida;
		private $id_hospital;	
		private $id_material;
		private $id_kit_processado;
		private $quantidade;

		public function __get($atributo){
			return $this->$atributo;
		}
		public function __set($atributo,$valor){
			return $this->$atributo=$valor;
		}
	}
?>