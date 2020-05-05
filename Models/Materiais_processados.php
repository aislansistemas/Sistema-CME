<?php
	
	class MaterialProcessado
	{
		private $id;
		private $id_hospital;
		private $responsavel_por;
		private $lote;
		private $data;
		private $hora;
		private $inicio_ciclo;
		private $fim_ciclo;
		private $numero_do_ciclo;
		private $pressao;
		private $temperatura_interna;
		private $horario_134;

		public function __get($atributo){
			return $this->$atributo;
		}
		public function __set($atributo,$valor){
			return $this->$atributo=$valor;
		}
	}
?>