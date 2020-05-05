<?php
	
	class Saida_material
	{
		private $id;
		private $id_hospital;
		private $data_hora;
		private $saida_para;
		private $registro;
		private $paciente_empresa_setor;
		private $responsavel;

		public function __get($atributo){
			return $this->$atributo;
		}
		public function __set($atributo,$valor){
			return $this->$atributo=$valor;
		}
	}
?>