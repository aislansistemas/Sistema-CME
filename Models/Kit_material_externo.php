<?php
	
	class Kit_Material_externo
	{
		private $id;
		private $id_recebido;
		private $id_hospital;
		private $material;
		private $quantidade;
		
		public function __get($atributo){
			return $this->$atributo;
		}
		public function __set($atributo,$valor){
			return $this->$atributo=$valor;
		}
	}
?>