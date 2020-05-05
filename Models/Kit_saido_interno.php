<?php
	
	class Kit_saido_interno
	{
		private $id;
		private $id_saida;
		private $id_hospital;	
		private $id_material;
		private $quantidade;

		public function __get($atributo){
			return $this->$atributo;
		}
		public function __set($atributo,$valor){
			return $this->$atributo=$valor;
		}
	}
?>